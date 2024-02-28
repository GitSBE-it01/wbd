<?php
require_once "config.php";
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
    <title>VJS & DMC</title>
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
        woList
    } from './component/index.js';
    import {
        inpDMCProcess, 
        dmc_input, 
        bom, 
        currentDate,
        initVJS,
        vjs_input,
        wo_list
    } from './utility/index.js';
    
    // start up web page
    const root = document.getElementById('root');
    await createNav(navigation);
    activeLink('navID', ['f-or7']);
    await createDatalist(assetList);
    await createSearch(searchBarMain);
    const woDT = await wo_list.fetchDataFilter({wo_status:'R'});
    await createDatalist(woList(woDT));
    root.removeChild(document.querySelector('.loading'));
    

    // proses saat klik submit button di search bar
    const sbmtBtn = document.getElementById('test2');
    sbmtBtn.addEventListener('click', async function(event) {
        try{
            localStorage.clear();
            if (document.getElementById('dmcDivAll')) {
                    document.getElementById('dmcDivAll').remove();
                }
            if (document.getElementById('dmcDiv')) {
                    document.getElementById('dmcDiv').remove();
                }
            if (document.getElementById('vjsDivAll')) {
                    document.getElementById('vjsDivAll').remove();
                }
            const target = document.getElementById('main');
            const div = document.createElement('div');
            div.id = 'dmcDivAll';
            target.appendChild(div);
            div.appendChild(await loading('loading2'));
            const sbmtBtn = document.getElementById('test2');
            sbmtBtn.disabled = true;

            // check apakah ada DMC yg terbentuk di hari ini utk asset yg dipilih
            const valueInp = await document.getElementById('test1').value.split('/');
            const dataDMC = await dmc_input.fetchDataFilter({assetno: valueInp[0], assetkat:valueInp[1], dmc_vjs:'dmc', input_date:currentDate()});

            // buat title heading utk daily maintenance
            await createHeader(header1);
            await createHeader(header2);
            // check apakah sudah ada data yg di munculkan. jika ada maka di hapus terlebih dahulu
            
            // jika data DMC blum terbuat maka buat table utk input data
            if (dataDMC.length === 0) { // setelah proses ini lgsg break
                const dmc = await bom.fetchDataFilter({category: valueInp[2], dmc_vjs: 'dmc'});
                await createTable(tableDMC(dmc));
                const maindDMC = document.getElementById('mainDMC');
                maindDMC.appendChild(await createBtn(btnDmcEdit));
                maindDMC.appendChild(await createBtn(btnDmcSbmt));
                sbmtBtn.disabled = false;
                const dmEdit = document.querySelector('[data-btn="dmcEdit"]');
                dmEdit.disabled = true;
                return div.removeChild(document.querySelector('.loading2'));          
            } 
            
            // jika data DMC ada maka buat table utk show data 
            const testingDMC = JSON.stringify(dataDMC);
            localStorage.setItem('dataDMC', testingDMC);
            await createTable(tableDMC(dataDMC));
            const maindDMC = document.getElementById('mainDMC');
            maindDMC.appendChild(await createBtn(btnDmcEdit));
            maindDMC.appendChild(await createBtn(btnDmcSbmt));
            const btnDMCInp = document.querySelector('[data-btn="dmcInput"]');
            btnDMCInp.disabled = true;
            maindDMC.classList.add('displayHide');
            const head = document.getElementById('hd2');
            if (dataDMC[0].decision === 'OK') {
                    head.appendChild(await createBtn(dmcOk))
                } else {
                    head.appendChild(await createBtn(dmcNg)
                )
            }
            sbmtBtn.disabled = false;
            const vjsDivAll = document.createElement('div');
            vjsDivAll.id = 'vjsDivAll';
            const main = document.getElementById('main');
            main.appendChild(vjsDivAll);
            await createHeader(header3);
            if (!localStorage.getItem('vjs')) {
                const vjs = await bom.fetchDataFilter({category: valueInp[2], dmc_vjs: 'vjs'});
                const vjsDt = JSON.stringify(vjs);
                localStorage.setItem('vjs', vjsDt);
            } 
            if (!localStorage.getItem('vjsData')) {
                const vjsData = await vjs_input.fetchDataFilter({assetno: valueInp[0], input_date:currentDate()});
                const vjsDt2 = JSON.stringify(vjsData);
                localStorage.setItem('vjsData', vjsDt2);
            } 

            if (JSON.parse(localStorage.getItem('vjsData')).length > 0) {
                await initVJS(JSON.parse(localStorage.getItem('vjsData')));
            } else {
                await initVJS(JSON.parse(localStorage.getItem('vjs')));
            }
            return div.removeChild(document.querySelector('.loading2'));    
        } catch(error) {
            console.log(error);
        }
    })

    
    // proses saat klik submit button di DMC
    document.addEventListener('click', async function(event) {
        if (event.target.getAttribute('id') === 'dmcInput') {
            try{
                const btn = document.querySelector('[data-btn="dmcInput"]');
                const mainDMC = document.getElementById('mainDMC');
                mainDMC.appendChild(await loading('loading2'));
                const dtRow = mainDMC.querySelectorAll('[data-row^="change"]');
                if (dtRow.length > 0 ){
                    const element = mainDMC.querySelectorAll('[data-cell^="input_value"]');
                    let isValid = true;
                    let decision = 'OK';
                    element.forEach( el=> {
                        if (el.value !== 'OK' && el.value !== 'NG') {
                            isValid = false;
                        };
                        if (el.value === 'NG') {
                            decision = 'NG';
                        } 
                    })

                    if (!isValid) {
                        alert('data harap di lengkapi');
                        return;
                    } else {
                        btn.disabled = true;
                        const data = mainDMC.querySelectorAll('[data-row]');
                        const valueSearch = document.getElementById('test1');
                        const btnEdit = document.querySelector('[data-btn="dmcEdit"]');
                        btnEdit.disabled = false;
                        await inpDMCProcess(data, decision, valueSearch);
                    }

                    if (document.getElementById('dmcDiv')) {
                        document.getElementById('dmcDiv').remove();
                    }
                    const head = document.getElementById('hd2');
                    if (decision === 'OK') {
                        head.appendChild(await createBtn(dmcOk))
                    } else {
                        head.appendChild(await createBtn(dmcNg)
                        )
                    }
                    
                    mainDMC.removeChild(document.querySelector('.loading2'));
                    const main = document.getElementById('main');
                    main.appendChild(await loading('loading2'));
                    if (document.getElementById('vjsDivAll')) {
                        document.getElementById('vjsDivAll').remove();
                    }
                    const vjsDivAll = document.createElement('div');
                    vjsDivAll.id = 'vjsDivAll';
                    main.appendChild(vjsDivAll);
                    await createHeader(header3);
                    const valueInp = await document.getElementById('test1').value.split('/');
                    if (!localStorage.getItem('vjs')) {
                        const vjs = await bom.fetchDataFilter({category: valueInp[2], dmc_vjs: 'vjs'});
                        const vjsDt = JSON.stringify(vjs);
                        localStorage.setItem('vjs', vjsDt);
                    }
                    if (!localStorage.getItem('vjsData')) {
                        const vjsData = await vjs_input.fetchDataFilter({assetno: valueInp[0], input_date:currentDate()});
                        const vjsDt2 = JSON.stringify(vjsData);
                        localStorage.setItem('vjsData', vjsDt2);
                    } 

                    if (JSON.parse(localStorage.getItem('vjsData')).length > 0) {
                        await initVJS(JSON.parse(localStorage.getItem('vjsData')));
                    } else {
                        await initVJS(JSON.parse(localStorage.getItem('vjs')));
                    }
                    main.removeChild(document.querySelector('.loading2'));
                    return;
                }
                alert('No data change');
                return;
            } catch(error) {
                console.log('error = ', error);
            }
            return;
        }

        if (event.target.getAttribute('data-btn') === 'addVJS') {
            try{
                const valueInp = await document.getElementById('test1').value.split('/');
                if (!localStorage.getItem('vjs')) {
                    const vjs = await bom.fetchDataFilter({category: valueInp[2], dmc_vjs: 'vjs'});
                    const vjsDt = JSON.stringify(vjs);
                    localStorage.setItem('vjs', vjsDt);
                }
                if (!localStorage.getItem('vjsData')) {
                    const vjsData = await vjs_input.fetchDataFilter({assetno: valueInp[0], input_date:currentDate()});
                    const vjsDt2 = JSON.stringify(vjsData);
                    localStorage.setItem('vjsData', vjsDt2);
                } 

                if (JSON.parse(localStorage.getItem('vjsData')).length > 0) {
                    await initVJS(JSON.parse(localStorage.getItem('vjsData')));
                } else {
                    await initVJS(JSON.parse(localStorage.getItem('vjs')));
                }
            } catch(error) {
                console.log(error);
            }
            return;
        }
    })


    
    document.addEventListener('click', async function(event) {
        if(event.target.getAttribute('data-btn')) {
            try{
                if (event.target.getAttribute('data-btn').includes('vjsInput')) {
                    const arrVJSInp = {
                        update: {
                            assetno:[],
                            assetkat:[],
                            inspection:[],
                            std:[],
                            unit:[],
                            input_value:[],
                            input_date:[],
                            wo_id:[],
                            dmc_vjs:[],
                            remark:[]
                        },
                        insert: {
                            id:[]
                        }
                    }
                    const val = event.target.getAttribute('data-btn');
                    const valSplit = val.split("--");
                    const val2 = document.querySelector(`[data-btn=${val}]`);
                    val2.disabled = true;
                    const edtOpen = document.querySelector(`[data-btn=vjsEdit--${valSplit[1]}`);
                    edtOpen.disabled = false;
                    const cont1 = document.getElementById(`dtVJS${valSplit[1]}`);
                    const cont2 = document.getElementById(`isiVJS${valSplit[1]}`);
                    const valueInp = await document.getElementById('test1').value.split('/');
                    const header = cont1.querySelectorAll('[data-cell]');
                    let id = '';
                    header.forEach(hd => {
                        if(hd.getAttribute('data-cell').includes('wo_id')) {
                            const v = hd.value.split(" -- ");
                            id = v[0];
                        }
                    })
                    const row = cont2.querySelectorAll('[data-row*="change"]');
                    row.forEach(rw => {
                        const dtCell = rw.querySelectorAll('[data-cell]');
                        dtCell.forEach(dt =>{
                            const v = dt.getAttribute('data-cell');
                            const splitV = v.split("___");
                            const key = splitV[0];
                            if(arrVJSInp['update'][`${key}`]) {
                                if(dt.tagName === 'INPUT') {
                                    arrVJSInp['update'][`${key}`].push(dt.value)
                                } else {
                                    arrVJSInp['update'][`${key}`].push(dt.textContent);
                                }
                            }
                            if(arrVJSInp['insert'][`${key}`]) {
                                    arrVJSInp['insert'][`${key}`].push(dt.value)
                                }
                        })
                        arrVJSInp.update.wo_id.push(id);
                        arrVJSInp.update.assetno.push(valueInp[0]);
                        arrVJSInp.update.assetkat.push(valueInp[1]);
                        arrVJSInp.update.input_date.push(currentDate());
                        arrVJSInp.update.dmc_vjs.push(`VJS${valSplit[1]}`);
                        arrVJSInp.insert.id.push()
                    })
                    const result = await vjs_input.insertData(arrVJSInp.update);
                    if (!result.includes('fail')) {
                        alert('data successfully inserted');
                    } else {
                        alert('data is not inserted');
                    }
                }
            } catch(error) {
                console.log(error);
            }
            return;
        }
    })




</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
<script src="./utility/post.js"></script>
</body>
</html>