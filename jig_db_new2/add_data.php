<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = explode("/",$currentURL);
  header(`location: http://$url[2]/sbe/index.php?cek=no`);
  exit(0);
}

require_once './backend/data_access/cek_role.php';
$user_log = strtoupper($_SESSION["username"]);
$prog = 'jig_db';
$role = cekUser($user_log, $prog);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css_fix/animation.css">
    <link rel="stylesheet" href="../assets/css_fix/symbol.css">
    <link rel="stylesheet" href="../assets/css_fix/default.css">
    <title>Add New Data</title>
</head>
<body>
<body>
<input type="hidden" id='role' value='<?php echo $role;?>'>
<div id='root' style='display: flex; flex-direction: row;'>
    <div class='loading'></div>
</div>
<script type='module'>
    const initPage = performance.now();
    import {
        create, dtlist,
        loading, sideNav, addDataNav, baseH2, baseH3, formBase, tableInit,//cluster
        active, //style
    } from './component/index.js';
    import {
        jsonToCsv, currentDate, activeLink2,// proses
        jig_master, log_master, jig_function, log_function, list_location// class
    } from './utility/index.js';

    const root = document.querySelector('#root');
    const loc = await list_location.dbProcess('get','');
    console.log(loc);
    await dtlist(loc, 'list_loc', 'name', 'name' );
    await sideNav();
    activeLink2('#side', active);
    root.removeChild(document.querySelector('.loading'));
    create({
        element: 'div',
        selector: '#root',
        id: 'main',
        style: `
            width: 86vw;
            height: 100vh;
            flex-direction: column;
            justify-content: flex-start;
            align-items: left;
        `
    })
    addDataNav();


//  jig master form for add new jig
    baseH2('main', 'jigMstr', 'Add New Jig');
    const form1 = [
        {text: 'Item Number Jig', mark: 'item_jig'},
        {text: 'Description Jig', mark: 'desc_jig'},
        {text: 'Jig Type', mark: 'jig_type'},
        {text: 'Material', mark: 'mat'},
    ]
    form1.forEach(dt=>{
        formBase('jigMstr', dt.mark, dt.text);
    })
//  jig location form for add new jig
    baseH3('main', 'jigLoc', 'Set Jig Location');
    formBase('jigLoc', 'qtyTotal', 'Qty Total');
    formBase('jigLoc', 'toleransi', 'Toleransi');
    const tol = document.querySelector('[data-jiginp = "qtyTotal"]');
    tol.setAttribute('disabled', true);
    const headerArr = ['Location', 'Qty Per Unit', 'Unit of Measurement']
    const dataArr = [
        {mark: 'loc'},
        {mark: 'qty_per_unit'},
        {mark: 'um'}
    ]

    let counter = 0;
    tableInit(headerArr, dataArr, 'jigLoc', 'locTbl', counter, '#6c7991', '#8c9fba');
    const locList = document.querySelectorAll('[data-cellval*="loc_"]');
    locList.forEach(dt=> {
        dt.setAttribute('list','list_loc');
    })

    create({
        element: 'button',
        selector: '#root',
        id: 'main',
        style: `
            width: 86vw;
            height: 100vh;
            flex-direction: column;
            justify-content: flex-start;
            align-items: left;
        `
    })

    
</script>
<script src="./utility/utility.js"></script>
</body>
</html>