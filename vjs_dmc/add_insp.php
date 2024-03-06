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
        addInspTable
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
    await createTable(addInspTable());
    const cont = document.getElementById('inputInsp');
    const div = document.createElement('div');
    div.classList.add('flex-r','mx4', 'my2');
    cont.appendChild(div);
    div.appendChild(await createBtn(basicBtn('sbmtInsp', 'enter')));
    div.appendChild(await createBtn(basicBtn('addInsp', 'button_plus')));
    div.appendChild(await createBtn(basicBtn('delInsp', 'button_minus')));
    await createTable(listInspTable(list_insp));
    root.removeChild(document.querySelector('.loading'));

    document.addEventListener('click', async function(event) {
        if(event.target.getAttribute('data-btn') === `editInsp__${valueTest}` ) {
            const value1 = document.querySelectorAll(`[data-cell*="inspection__${valueTest}__`);
            const dataArr = {category:[], inspection:[]};
            value1.forEach(vl=>{
                if(vl.value !== ''){
                    dataArr['category'].push(valueTest);
                    const value = vl.value.split("--")
                    dataArr['inspection'].push(value[1]);
                }
            })
            console.log(dataArr);
            const result = await bom.insertData(dataArr);
            console.log(result)
            if (!result.includes('fail')) {
                    alert('data successfully inserted');
                    location.reload();
                } else {
                    alert('data fail to insert');
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