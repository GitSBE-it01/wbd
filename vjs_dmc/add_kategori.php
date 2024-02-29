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
        selectCat
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
    const allAssetDt = await asset.getData();
    const dmc_vjs = await bom.getData();
    const list_insp = await list_inspect.getData();
    const list_cat = await list_category.getData();
    await createDatalist(allAsset(allAssetDt));
    await createSearch(searchBarKat);
    await columnSprt(arrKat);
    const side1 = document.getElementById('smallSide')
    for (let i=0; i<list_cat.length; i++) {
        const btn = await createBtn(selectCat(list_cat[i].mesin_cat));
        console.log(btn);
        side1.appendChild(btn);
    }
    root.removeChild(document.querySelector('.loading'));

    const listedAst = await vjs_asset.getData();
    const getSearchVal = document.getElementById('assetInput').value;
    const splitSearchVal = getSearchVal.split('--');
    const cekSearch = listedAst.filter(la => la.assetno === splitSearchVal[0]);
    if (cekSearch.length === 0) {
        const getAssetNo = splitSearchVal[2];
    }


</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
<script src="./utility/post.js"></script>
</body>
</html>