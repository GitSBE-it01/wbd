<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  //redirect ke halaman login sbe
  $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = explode("/",$currentURL);
  header(`location: http://$url[2]/sbe/index.php?cek=no`);
  exit(0);
}

/*
$user_log = strtoupper($_SESSION["username"]);
$prog = 'pick_now';
$role = cekUser('dbvjs',$user_log, $prog);
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css_fix/animation.css">
    <link rel="stylesheet" href="../assets/css_fix/color.css">
    <link rel="stylesheet" href="../assets/css_fix/custom.css">
    <link rel="stylesheet" href="../assets/css_fix/font.css">
    <link rel="stylesheet" href="../assets/css_fix/layout.css">
    <link rel="stylesheet" href="../assets/css_fix/symbol.css">
    <title>parent code</title>
</head>
<body>
<div id='root' class='container'>
    <div class='loading'></div>
</div>
<script type='module'>
    const initPage = performance.now();
    import {
        loading, 
        createNav,
        activeLink,
        createTable,
        createBtn,
        createInp,
        createDatalist,
        createHeader,
        createSearch,    
        createHeader2,
        navigation,
        sidebarHome,
        mainTbl,
        columnSprt,
        arrKat
    } from './component/index.js';
    import {
        jsonToCsv, currentDate, // proses
        pickNow  // class
    } from './utility/index.js';
    
    const root = document.getElementById('root');
    const mainData = await pickNow.fetchDataFilter({data_date: currentDate()});
    console.log(mainData);
    await createNav(navigation);
    activeLink('navID', ['f-or7']);
    await createNav(sidebarHome);
    root.removeChild(document.querySelector('.loading'));

    //section 1
    
    //section 2
    

    /*
    const input = document.getElementById('input1');
    input1.addEventListener('change', function(event) {
        const inp = event.target;
        const inpValue = inp.value.toLocaleLowerCase();
        console.log(inpValue);
        const tbl = document.getElementById('tblMain');
        const row = tbl.querySelectorAll('[data-row]');
        row.forEach(dt=>{
            if(dt.classList.contains('displayHide')) {
                dt.classList.remove('displayHide');
            }
            if(!dt.getAttribute('data-row').toLocaleLowerCase().includes(inpValue)) {
                dt.classList.add('displayHide');
            }
        })
    })

    // download excel
    const dlExc = document.getElementById('dlExcl');
    dlExc.addEventListener('click', async function(event) {
        const btn = event.target;
        btn.disabled = true;
        await jsonToCsv(allArray, 'testing.csv');

        btn.disabled = false;
    })
*/

</script>
<script type='module' src="./utility/index.js"></script>
</body>
</html>