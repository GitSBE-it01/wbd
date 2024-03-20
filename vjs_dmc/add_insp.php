<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/layout_fix.css">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/color.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/search_btn.css">
    <title>VJS & DMC kategori</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root' class='container'>
    <div class='loading'></div>
</div>
<script src="./utility/prep.js"></script>
<script type='module'>
    import {
        createNav,
        createSearch,
        createDatalist,
        loading,
        createTable,
        activeLink,
        createHeader,
        createBtn,
        createInp,
        navigation,
        assetList,
        searchBarMain,
        tableDMC,
        tableVJS,
        btnDmcEdit, 
        btnDmcSbmt,
        dmcOk, 
        dmcNg,
        header1,
        header2,
        header3,
        woList,
        allAsset,
        searchBarKat,
        columnSprt,
        arrKat,
        selectCat,
        tablecatList,
        slcAddBtn,
        slcDelBtn,
        inpNew,
        catData,
        insData,
        inpArrCat,
        tblAddList,
        basicBtn,
        selection,
        createHeader2,
        headerListInsp,
        listInspTable,
        inspection,
        addInspTable,
        addInspTable2,
    } from './component/index.js';
    import {
        inpDMCProcess, 
        dmc_input, 
        bom, 
        currentDate,
        initVJS,
        vjs_input,
        wo_list,
        vjs_asset,
        asset,
        list_category,
        list_inspect
    } from './utility/index.js';
    
    // start up web page
    const root = document.getElementById('root');
    await createNav(navigation);
    activeLink('navID', ['f-or7']);
    const list_insp = await list_inspect.getData();
    const main = document.getElementById('main');
    main.appendChild(await createHeader2(inspection));
    main.setAttribute('style', 'height:96%; overflow-y:hidden;')
    const contDiv = document.createElement('div');
    contDiv.id = 'inputInsp';
    main.appendChild(contDiv);
    await createTable(addInspTable());
    const div = document.createElement('div');
    div.classList.add('flex-r','mx4', 'my2');
    main.appendChild(div);
    div.appendChild(await createBtn(basicBtn('addInsp', 'button_plus')));
    div.appendChild(await createBtn(basicBtn('delInsp', 'button_minus')));
    div.appendChild(await createBtn(basicBtn('sbmtInsp', 'enter')));
    await createTable(listInspTable(list_insp));
    const listTbl = document.getElementById('listAll');
    listTbl.setAttribute('style', 'height:85%;');
    const row = listTbl.querySelectorAll('[data-row]');
    row.forEach(dt=>{
        const target = dt.querySelector('[data-cell*="insp"]');
        const value = target.getAttribute('data-cell').split('___');
        dt.setAttribute('data-row', value[1]);
    })
    const delBtn = document.querySelectorAll(`[data-cell*="delLs_"]`)
    delBtn.forEach(dt=> {
        dt.classList.add('displayHide');
    })
    root.removeChild(document.querySelector('.loading'));

    let counter = 1;
    document.addEventListener('click', async function(event) {
        if(event.target.getAttribute('data-btn') === `sbmtInsp` ) {
            const cont = document.getElementById('inputInsp');
            const data = cont.querySelectorAll('[data-cell');
            const dataArr = {
                inspection:[],
                dmc_vjs:[],
                doc:[],
                std:[],
                unit:[]
            };
            data.forEach(dt=>{
                const code = dt.getAttribute('data-cell');
                const codeFix = code.split('__');
                if(dataArr[`${codeFix[0]}`]) {
                    dataArr[`${codeFix[0]}`].push(dt.value);
                }
            })
            const result = await list_inspect.insertData(dataArr);
            if (!result.includes('fail')) {
                alert('data successfully inserted');
                location.reload();
            } else {
                alert('data fail to insert');
            }
            return;
        }

        if(event.target.getAttribute('data-btn') === `delInsp` ) {
            const value1 = document.querySelectorAll(`[data-cell*="delLs__"]`);
            value1.forEach(vl=> {
                if(vl.classList.contains('displayHide')){
                    vl.classList.remove('displayHide');
                } else {
                    vl.classList.add('displayHide');
                }
            })
            return;
        }
        if(event.target.getAttribute('data-btn') === `addInsp` ) {
            await createTable(addInspTable2(counter));
            counter++;
            return;
        }
    })
    
</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
<script src="./utility/post.js"></script>
</body>
</html>