<?php 
require_once "../config.php";
require_once "../queryList.php";
require_once "trans.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Transaksi record</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <link rel="stylesheet" href="../assets/CSS/add_data.css">
    <link rel="stylesheet" href="../assets/CSS/update.css">
    <link rel="stylesheet" href="../../assets/css/layout.css">
    <link rel="stylesheet" href="../../assets/css/layout_fix.css">
    <link rel="stylesheet" href="../../assets/css/animation.css">
    <link rel="stylesheet" href="../../assets/css/font.css">
    <link rel="stylesheet" href="../../assets/css/color.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
    <link rel="stylesheet" href="../../assets/css/search_btn.css">
</head>
<body>
<input type=hidden id='role' value="<?php if (isset($role)) {echo $role;} else {echo 'guest';}?>">
<div id='root'>
    <div class='loading'></div>
</div>
<script src="../assets/JS/main.js"></script>
<script type='module'>
    import { createSidebar, activeLink } from '../component/sidebar.js';
    import { 
        list_location,
        jig_master_query,
        jig_location_query,
        jig_trans
     } from '../class.js';
    import {
        loading,
        createNav,
        columnSprt,
        createTable,
        createSearch,
        createInp,
        createBtn,
        createDatalist,
        createHeader,
        transSearchBar ,
        colSprt2,
        rowSprt2,
        jigList,
        locList,
        titleTrans,
        mainDt,
        mainTblTrans,
        hidDtTrans,
        hidTblTrans
    } from '../comps/index.js';
    import {currentDate} from '../process.js';

    const root = document.getElementById('root');
    const listLoc = await list_location.getData();
    const jigMstr = await jig_master_query.getData();
    await columnSprt(colSprt2);
    await columnSprt(rowSprt2);
    await createSidebar('side', 'sl1');
    await activeLink('[data-nav]');
    const top = document.getElementById('top');
    const bot = document.getElementById('bot');
    top.appendChild(await createHeader(titleTrans('Transaksi Harian')))
    await createSearch(transSearchBar());
    await createDatalist(jigList(jigMstr));
    await createDatalist(locList(listLoc));
    root.removeChild(document.querySelector('.loading'));

    bot.appendChild(await loading('loading'));
    const jigTrans = await jig_trans.fetchDataFilter({status: 'open'});
    const jigLoc = await jig_location_query.getData();
    const result = await mainDt(jigMstr, jigTrans, jigLoc);
    const result2 = await hidDtTrans(jigTrans, jigLoc);
    const cek = {};
    jigTrans.forEach(dt => {
        if(!cek[dt.item_jig]) {
            cek[dt.item_jig] = dt.code;
        } 
    })
    await createTable(mainTblTrans(result));    
    for (let i=0; i<result2.length; i++) {
        const target = `hid___${result2[i].item_jig}`;
        const id = `id___${result2[i].code}`;
        const targetCont = document.getElementById(target);
        const data = result2.filter(item => item.item_jig === result2[i].item_jig);
        if (targetCont !== null && targetCont.childNodes.length===0) {
            await createTable(hidTblTrans(data,target,id));
            const cek = document.querySelector(`[data-cell="date___${result2[i].code}"]`)
            if(cek && cek.textContent !== '') {
                const btn = document.querySelector(`[data-cell="btnInp___${result2[i].code}"]`);
                btn.classList.remove('arrow_green');
                btn.classList.add('arrow_red');
                const inp = document.querySelector(`[data-cell="loc___${result2[i].code}"]`);
                inp.disabled =true;

            }
        } 
    }   
    bot.removeChild(document.querySelector('.loading'));
    
    document.addEventListener('click', async function(event) {
        if (event.target.getAttribute('id')==='sbmtCat') {
            const inputVal = document.getElementById('filterTrans').value;
            const main = document.getElementById('mainTbl');
            const target = main.querySelectorAll('[data-cell*="item__"]');
            target.forEach(tg=> {
                const row = tg.closest('[data-row]');
                const val = tg.getAttribute('data-cell');
                const splt = val.split("___");
                row.setAttribute('data-row', splt[1]);
                if(splt[1].toLowerCase().includes(inputVal.toLowerCase())) {
                    row.classList.remove('displayHide');
                } else {
                    row.classList.add('displayHide');
                }
            })
            return;
        }
        if (event.target.getAttribute('id').includes('btnInp')) { 
            const cell = event.target;
            const row = cell.closest('[data-row]');
            const target = row.querySelectorAll(`[data-cell]`);
            let code = '';
            const arrInp = {
                    code:[],
                    loc:[],
                    qty:[],
                    start_date:[],
                    status:[],
                    item_jig:[]
            }
            target.forEach( tg=> {
                const key = tg.getAttribute('data-cell');
                const key2 = key.split('___');
                const codeInp = key2[0];
                const jig = key2[1].split('--');
                const today = currentDate();
                if (arrInp[`${codeInp}`]) {
                    if(tg.tagName === 'INPUT') {
                        const value = tg.value;
                        arrInp[`${codeInp}`].push(value);
                        arrInp.status.push('open');
                        arrInp.item_jig.push(`${jig[0]}`);
                        arrInp.start_date.push(today);
                    } else {
                        const value = tg.textContent;
                        arrInp[`${codeInp}`].push(value);
                        if (codeInp === 'code'){
                            arrInp[`${codeInp}`].push(value);
                        }
                    }
                }
            })
            let result ='';
            if (cell.classList.contains('arrow_green')) {
                result = await jig_trans.insertData(arrInp);
                if (!result.includes('fail')) {
                    cell.classList.remove('arrow_green');
                    cell.classList.add('arrow_red');
                    const target2 = row.querySelector(`[data-cell*="date___${row.id}"]`);
                    target2.textContent = currentDate();
                    const inp = row.querySelector(`[data-cell*="loc___${row.id}"]`);
                    inp.disabled = true;
                } else {
                    alert('data fail to insert');
                }
            } else if(cell.classList.contains('arrow_red')) {
                const target2 = row.querySelector(`[data-cell*="idTrans___${row.id}"]`);
                const value = target2.value;
                const data = {
                    update: {
                        end_date: [currentDate()],
                        status: ['close']
                    },
                    insert: {
                        id:[value]
                    }
                }
                result = await jig_trans.updateData(data.update, data.insert);
                if (!result.includes('fail')) {
                    cell.classList.remove('arrow_red');
                    cell.classList.add('arrow_green');
                    const target2 = row.querySelector(`[data-cell*="date___${row.id}"]`);
                    target2.textContent = '';
                    const inp = row.querySelector(`[data-cell*="loc___${row.id}"]`);
                    inp.disabled = false;
                } else {
                    alert('data fail to update');
                }
            }

            
        }
    })

    
</script>
</body>
</html>
