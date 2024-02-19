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
    <div id='load' class='loading'></div>
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
        btnDmcEdit, 
        btnDmcSbmt, 
        dmcOk, 
        dmcNg,
        header1,
        header2
    } from './component/index.js';
    import {
        inpDMCProcess, 
        dataInput, 
        bom, 
        currentDate
    } from './utility/index.js';
    
    // start up web page
    const root = document.getElementById('root');
    await createNav(navigation);
    activeLink('navID', ['f-or7']);
    await createDatalist(assetList);
    await createSearch(searchBarMain);
    root.removeChild(document.getElementById('load'));
    

    // proses saat klik submit button di search bar
    const sbmtBtn = document.getElementById('test2');
    sbmtBtn.addEventListener('click', async function(event) {
        try{
            if (document.getElementById('dmcDivAll')) {
                    document.getElementById('dmcDivAll').remove();
                }
            const target = document.getElementById('main');
            const div = document.createElement('div');
            div.id = 'dmcDivAll';
            div.appendChild(loading('load','loading2'));
            target.appendChild(div);
            const sbmtBtn = document.getElementById('test2');
            sbmtBtn.disabled = true;
            // check apakah ada DMC yg terbentuk di hari ini utk asset yg dipilih
            const valueInp = await document.getElementById('test1').value.split('/');
            const dataDMC = await dataInput.fetchDataFilter({assetno: valueInp[0], assetkat:valueInp[1], dmc_vjs:'dmc', input_date:currentDate()});
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
                    const dmEdit = document.getElementById('dmcEdit');
                    dmEdit.disabled = true;
                    return div.removeChild(document.getElementById('load'));          
                } 
            
            // jika data DMC ada maka buat table utk show data 
            await createTable(tableDMC(dataDMC));
            const maindDMC = document.getElementById('mainDMC');
            maindDMC.appendChild(await createBtn(btnDmcEdit));
            maindDMC.appendChild(await createBtn(btnDmcSbmt));
            const btnDMCInp = document.getElementById('dmcInput');
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
            return div.removeChild(document.getElementById('load'));    
        } catch(error) {
            console.log(error);
        }
    })

    // proses saat klik submit button di DMC
    document.addEventListener('click', async function(event) {
        if (event.target.getAttribute('id') === 'dmcInput')
            try{
                const btn = document.getElementById('dmcInput');
                const cont = document.getElementById('dmcDivAll');
                const loadDMC = await loading('load', 'loading2');
                console.log(loadDMC);
                cont.appendChild(loadDMC);
                const mainDMC = document.getElementById('mainDMC');
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
                } else{
                    btn.disabled = true;
                    const data = mainDMC.querySelectorAll('[data-row]');
                    const valueSearch = document.getElementById('test1');
                    const btnEdit = document.getElementById('dmcEdit');
                    btnEdit.disabled = false;
                    inpDMCProcess(data, decision, valueSearch);
                }
                const load = document.getElementById('load');
                cont.removeChild(load);
                return;
            } catch(error) {
                console.log('error = ', error);
            }
        })

</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
<script src="./utility/post.js"></script>
</body>
</html>