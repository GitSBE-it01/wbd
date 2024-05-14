<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
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
        activeLink,
        create,
        mainNav,
        sideNav, 
        tablePickNow
    } from './component/index.js';
    import {
        jsonToCsv, currentDate, // proses
        pickNow// class
    } from './utility/index.js';
    
    await mainNav();
    activeLink('navID', ['f-or7']);
    await sideNav();
    let deptVal = 'P1.ASSY';
    const defShow = document.querySelector(`[data-deptPick = "${deptVal}"]`);
    defShow.classList.add('sl8', 'fw-blk');
    const root = document.getElementById('root');
    const start = performance.now();
    const mainData = await pickNow.dbProcess('fetch',{data_date: currentDate()});
    const end = performance.now();
    const total = (end - start) / 1000;
    console.log({mainData});
    console.log(total);
    

    root.removeChild(document.querySelector('.loading'));

    tablePickNow(deptVal, );

        // const data = {
        //     komponen: '', //mainData.item
        //     release_date: '', //woR.wo_rel_datex
        //     due_date: '', //woR.wo_due_datex
        //     lokasi: '', //mainData.loc__line
        //     lot__id: '', //mainData.lot__id
        //     PM: '', //
        //     sum_of_QtyOH: '', // sum qty OH WH semua
        //     nasehat: '', // qty need
        //     id_par_desc: '', // item.pt_desc1 + pt_desc2
        //     remarks: '', // woR.wo_rmks
        //     pick_now: '', //mainData.pick
        //     qty_OH_all: '', //mainData.qty
        //     dept: '', //mainData.dept
        //     all_lot:'', //    kombinasi lot inventory 
        // }

    document.addEventListener('click', function(event) {
        const allData = document.querySelectorAll('[data-deptPick]');
        console.log(allData);
        allData.forEach(dt=>{
            dt.classList.remove('sl8', 'fw-blk');
            if(dt.value === 'deptVal') {
                dt.classList.add('sl8', 'fw-blk');
            }
        })
    })

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
</body>
</html>