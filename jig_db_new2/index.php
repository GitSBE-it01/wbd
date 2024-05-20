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
    <title>pick now</title>
</head>
<body>
<div id='root' class='container'>
    <div class='loading'></div>
</div>
<script type='module'>
    const initPage = performance.now();
    import {
        loading, 
        create,
        mainNav,
        sideNav, 
        pickNowHeader,
        pickNowTbl
    } from './component/index.js';
    import {
        jsonToCsv, currentDate, mainDataProcess,activeLink,// proses
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
    console.log({mainData});
    const dataProcess = await mainDataProcess(mainData);
    console.log({dataProcess});
    const itemReff = {};
    dataProcess.forEach(dt=>{
        if(itemReff[dt.depmnt]) {
            itemReff[dt.depmnt].push(dt.komponen);
        } else {
            itemReff[dt.depmnt]=[dt.komponen];
        }
    })
    let dataTbl = []
    dataProcess.forEach(dt => {
        if(dt.depmnt === deptVal) {dataTbl.push(dt)}
        if(dt.depmnt === 'WH' && itemReff[deptVal].includes(dt.komponen)) {dataTbl.push(dt)}
    });
    await pickNowHeader(deptVal);
    await pickNowTbl(dataTbl, deptVal);
    root.removeChild(document.querySelector('.loading'));
    const end = performance.now();
    const total = (end - start) / 1000;
    console.log(total);

    document.addEventListener('click', function(event) {
        if(event.target.hasAttribute('data-deptPick')) {
            const start = performance.now();
            const main2 = document.querySelector('#main2');
            const current = document.querySelectorAll(`[data-table]`);
            current.forEach(dt=>{
                if(!dt.classList.contains('displayHide')) {
                    dt.classList.add('displayHide');
                }
            })
            main2.appendChild(loading('loading'));
            deptVal = event.target.getAttribute('data-deptPick');
            const sideData = document.querySelectorAll('[data-deptPick]');
            sideData.forEach(dt=>{
                dt.classList.remove('sl8', 'fw-blk');
                if(dt.getAttribute('data-deptPick') === deptVal) {
                    dt.classList.add('sl8', 'fw-blk');
                }
            })
            const title = document.getElementById('pickNowTitle');
            title.textContent = `Pick Now Untuk ${deptVal}`;
            const after = document.querySelector(`[data-table = "pickNowTbl${deptVal}"]`);
            if(after) {
                after.classList.remove('displayHide');
            } else {
                dataTbl = [];
                dataProcess.forEach(dt => {
                    if(dt.depmnt === deptVal) {dataTbl.push(dt)}
                    if(dt.depmnt === 'WH' && itemReff[deptVal].includes(dt.komponen)) {dataTbl.push(dt)}
                });
                if(dataTbl.length >0) {
                    pickNowTbl(dataTbl, deptVal);
                } else {
                    create ({
                        element: 'div',
                        selector: '#main2',
                        table: `pickNowTbl${deptVal}`,
                        class: 'h100 w100 overY'
                    }) 
                }
            }
            main2.removeChild(document.querySelector('.loading'));
            const end = performance.now();
            console.log('total time proses pindah : ' + ((end-start)/1000) + ' second');
        }
        if(event.target.getAttribute('id')==='mainSearchBtn') {
            const searchVal = document.getElementById('mainSearchInput').value.toLowerCase();
            if(searchVal) {
                const allRow = document.querySelectorAll('[data-row]');
                allRow.forEach(dt=>{
                    const val = dt.getAttribute('data-filter').toLowerCase();
                    if(!val.includes(searchVal) && !dt.classList.contains('displayHide')) {
                        dt.classList.add('displayHide');
                    }
                })
                return;
            }  else {
                let itemCek2 ='';
                const allRow = document.querySelectorAll('[data-row]');
                allRow.forEach(dt=>{
                    dt.classList.remove('bt2-solid');
                    const itemDt = dt.querySelector('[data-cell ="komponen"]').textContent;
                    if(itemDt !== itemCek2) {
                        dt.classList.add('bt2-solid');
                        itemCek2 = itemDt;
                    }
                    const cek = dt.getAttribute('data-deptVal');
                    if(cek === deptVal || cek === 'WH') {
                        if(itemReff[deptVal] && itemReff[deptVal].includes(itemDt)) {
                            dt.classList.remove('displayHide');
                        } else if(itemReff[deptVal] && !dt.classList.contains('displayHide')){
                            dt.classList.add('displayHide');
                        }
                        if(!itemReff[deptVal] && !dt.classList.contains('displayHide')){
                            dt.classList.add('displayHide');
                        }
                    } else if(!dt.classList.contains('displayHide')){
                            dt.classList.add('displayHide');
                        }
                })
            }
        }
        if(event.target.getAttribute('id')==='dlExcel') {
            let excelData =[];
            const allRow = document.querySelectorAll('[data-row]');
            allRow.forEach(dt=>{
                const data = {
                    komponen:'komponenkomponen',
                    depmnt:'depmnt',
                    keterangan:'keterangan',
                    dt_need:'dt_need',
                    release_date:'release_date',
                    due_date:'due_date',
                    lokasi:'lokasi',
                    lot__id:'lot__id',
                    qty:'qty',
                    nasehat:'nasehat',
                    pick_now:'pick_nowpick',
                    qty_OH_all:'qty_OH_all',
                    remarks:'remarks',
                    all_lot:'all_lot',
                    pic:'pic',
                }
                const dataValue = dt.querySelectorAll('[data-cell]');
                dataValue.forEach(dt=>{
                    const key = dt.getAttribute('data-cell');
                    if(data[`${key}`]) {
                        data[`${key}`] = dt.textContent;
                    }
                })
                if(!dt.classList.contains('displayHide')) {
                    excelData.push(data);
                }
            })
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.json_to_sheet(excelData);
            XLSX.utils.book_append_sheet(workbook, worksheet, 'pick now');
            XLSX.writeFile(workbook, 'pick_now.xlsx')
        }
    })

</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>