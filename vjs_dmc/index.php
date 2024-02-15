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
    <title>Document</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root' class='container'>
    <div id='load' class='loading'></div>
</div>

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
        dmcNg
        } from './component/index.js';
    
    import {dataInput, bom} from './utility/class.js';
    import {splitCustomString, currentDate} from './utility/process.js';
    
    // start up web page
    const root = document.getElementById('root');
    await createNav(navigation);
    activeLink('navID', ['f-or7']);
    await createDatalist(assetList);
    await createSearch(searchBarMain);
    root.removeChild(document.getElementById('load'));
    
    // proses saat klik submit button
    const sbmtBtn = document.getElementById('test2');
    sbmtBtn.addEventListener('click', async function(event) {
        try{
            main.appendChild(loading('load','loading2'));
            const sbmtBtn = document.getElementById('test2');
            sbmtBtn.disabled = true;
            // check apakah ada DMC yg terbentuk di hari ini utk asset yg dipilih
            const valueInp = await document.getElementById('test1').value.split('/');
            const dataDMC = await dataInput.fetchDataFilter({assetno: valueInp[0], assetkat:valueInp[1], input_date:currentDate()});
            // buat title heading utk daily maintenance
            await createHeader(
                    {
                        target:'main',
                        id:'hd',
                        style: ['textCenter', 'fs-xl','fw-bld', 'm3'],
                        text:'Daily Maintenance'               
                    }
                );
            // check apakah sudah ada data yg di munculkan. jika ada maka di hapus terlebih dahulu
            if (document.getElementById('mainDMC')) {
                    document.getElementById('mainDMC').remove();
                }

            // jika data DMC blum terbuat maka buat table utk input data
            if (dataDMC.length === 0) { // setelah proses ini lgsg break
                    const dmc = await bom.fetchDataFilter({category: valueInp[2]});
                    await createTable(tableDMC(dmc));
                    main.appendChild(await createBtn(btnDmcEdit));
                    main.appendChild(await createBtn(btnDmcSbmt));
                    sbmtBtn.disabled = false;
                    return main.removeChild(document.getElementById('load'));          
                } 
            
            // jika data DMC ada maka buat table utk show data 
            await createTable(tableDMC(dataDMC));
            main.appendChild(await createBtn(btnDmcEdit));
            main.appendChild(await createBtn(btnDmcSbmt));
            const btnDMCInp = document.getElementById('dmcInput');
            btnDMCInp.disabled = true;
            const maindDMC = document.getElementById('mainDMC');
            maindDMC.classList.add('displayHide');
            if (dataDMC[0].decision === 'OK') {
                        main.appendChild(await createBtn(dmcOk))
                    } else {
                        main.appendChild(await createBtn(dmcNg)
                    )
                }
            sbmtBtn.disabled = false;
            return main.removeChild(document.getElementById('load'));    
        } catch(error) {
            console.log(error);
        }
    })
</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
</body>
</html>