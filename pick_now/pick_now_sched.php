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
    <title>scheduler pick now</title>
</head>
<body class = 'sl9'>
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
        searchBarMain,
        mainTbl,
    } from './component/index.js';
    import {
        jsonToCsv,jsonToExcel,
        wobb, wo, ld, loc, currentDate, dept, pickNow,
        convertDateFormat
    } from './utility/index.js';
    
    // initiation data
    const root = document.getElementById('root');
    const demand = await wobb.getData(); // wod_det
    const woR = await wo.fetchDataFilter({wo_status: 'R'}); // wo_mstr
    const oh = await ld.getData(); // ld_det
    const cekLoc = await loc.getData(); //loc_mstr
    const cekDept = await dept.getData();
    const h1 = document.createElement('h1');
    h1.textContent = 'Scheduler Pick Now';
    root.appendChild(h1);
    
    console.log('========================================================================================');
    console.log('step0 : inisiasi awal ')
    console.log('------------------------------------------------------------');
    console.log({demand, woR});
    console.log({oh, cekLoc});
    console.log({cekDept})
    const endInit = performance.now();
    const dlDt = (endInit - initPage) / 1000;
    console.log('waktu inisiasi dan penarikan data : ' + dlDt);
    const report1 = document.createElement('p');
    report1.textContent = 'inisiasi dan penarikan data dari database selesai dalam waktu ' + dlDt + ' detik';
    root.appendChild(report1);

    /* step 1 
        ada 2 hal yg dilakukan : 
        1 mencari data demand 
            data demand dari demand(wod_det) digabung dengan woR(wo_mstr) utk mengeluarkan semua kebutuhan dari id yg sudah Release
        2 mencari data OH 
        data OH di dapat dari oh(ld_det) digabung dengan cekLoc(loc_mstr) utk mengategorikan OH di setiap departement 
        */
    const start1 = performance.now();
    console.log('========================================================================================');
    console.log('step1 : pelengkapan data utk demand dan on hand');
    console.log('------------------------------------------------------------');
       
   // demand data 
    const wo_release = woR.filter(item => item.wo_status === 'R');
    const id_R = [];
    wo_release.forEach(dt=>{
        if(!id_R.includes(dt.wo_lot)) {
            id_R.push(dt.wo_lot)
        }
    })

    // ambil id R saja dari bill browse
    const dmnd_new = [];
    demand.forEach(dt=>{
        if(id_R.includes(dt.wod_lot)){
            const data_wo = woR.find(obj=>obj.wo_lot === dt.wod_lot);
            const data = {
                ...dt,
                item: data_wo.wo_part ? data_wo.wo_part : '-',
                assyLine: data_wo.wo__chr04 ? data_wo.wo__chr04 :'-',
                rel_dt: data_wo.wo_rel_date ? data_wo.wo_rel_date : 0,
                due_dt: data_wo.wo_due_date ? data_wo.wo_due_date : 0,
            }
            dmnd_new.push(data);
        }
    })

    // penambahan keterangan departement utk tiap assy line berdasarkan routing
    dmnd_new.forEach(dt=>{
        const data = cekDept.find(item => item.routing == dt.item);
        if(data) {
            dt['dept'] = data.assyLine;
        } else {
            dt['dept'] = '';
        }
    })

    // on hand inventory
    // penambahan departement dari lokasi di data on hand
    oh.forEach(dt=>{
        const data = cekLoc.find(obj => obj.loc_loc.toLowerCase() === dt.ld_loc.toLowerCase());
        if(data) {
            dt['dept'] = data.loc_department;
        }
    })

    // akumulasi on hand tiap item number utk di tiap departement 
    const invDet = new Map();
    oh.forEach(dt=>{
        const fltr = dt.ld_part + dt.dept;
        if(invDet.has(fltr)) {
            const exst = invDet.get(fltr);
            exst.qty_OH += parseInt(dt.ld_qty_oh);
        } else {
            const data = {
                dept: dt.dept,
                loc: dt.ld_loc,
                item: dt.ld_part,
                qty_OH: parseInt(dt.ld_qty_oh),
                lot: dt.ld_lot,
                reff: dt.ld_ref
            }
            invDet.set(fltr,data);
        }
    })

    const oh_all = Array.from(invDet.values());
    const end1 = performance.now();
    const prs1 = (end1 - start1) / 1000;
    console.log('data demand lengkap dengan permintaan di dept mana');
    console.log({dmnd_new});
    console.log('OH inventory akumulasi tiap item number di tiap departement berdasarkan lokasi OH');
    console.log({oh, invDet, oh_all});
    console.log('waktu proses data1 : ' + prs1);
    const report2 = document.createElement('p');
    report2.textContent = 'proses data awal selesai dalam waktu ' + dlDt + ' detik';
    root.appendChild(report2);
    
    // step 2 
    const start2 = performance.now();
    console.log('========================================================================================');
    console.log('step2 : penggabungan data demand dan on hand per departement');
    console.log('------------------------------------------------------------');

    const gabungan = [];
    // memasukan data demand ke object baru
    dmnd_new.forEach(dt=>{
        const cekDate = convertDateFormat(dt.rel_dt);
        const code = dt.wod_part+dt.dept;
        if(currentDate() < cekDate) {
        let data ={
            item: dt.wod_part,
            remark: '2.demand',
            loc__line: dt.assyLine,
            dept: dt.dept,
            qty: parseInt(dt.wod_qty_req),
            lot__id: dt.wod_lot,
            date: cekDate,
        }
        if(gabungan[code]) {
            gabungan[code].push(data);
        } else {
            gabungan[code] = [data];
        }}
    })

    // memasukan data on hand ke object baru, yg sudah terbentuk sebelumnya. jika tidak ada maka tidak di masukkan, karena berarti tidak ada demand hanya on hand saja. 
    oh_all.forEach(dt=>{
        const code = dt.item+dt.dept;
        let data = {
            item: dt.item,
            remark: '1.on hand',
            loc__line: dt.loc,
            dept: dt.dept,
            qty: dt.qty_OH,
            lot__id: dt.lot,
            date: currentDate()
        }
        if (gabungan[code]) {
            gabungan[code].push(data);
        }
    })

    const end2 = performance.now(); 
    const prs2 = (end2 - start2) / 1000;
    console.log('object gabungan utk tiap item number sesuai dengan demand');
    console.log({gabungan})
    console.log('waktu proses data2 : ' + prs2);
    const report3 = document.createElement('p');
    report3.textContent = 'penggabungan data selesai dalam waktu ' + dlDt + ' detik';
    root.appendChild(report3);



    // step 3 
    const start3 = performance.now();
    console.log('========================================================================================');
    console.log('step3 : ');
    console.log('------------------------------------------------------------');
    const allArray = [];
    const key = Object.keys(gabungan);
    
    key.forEach(dt=>{
        gabungan[dt].forEach(dt2=>{
            allArray.push(dt2);
        })
    })

    allArray.sort((a,b) => {
        if (a.item !== b.item) return a.item.localeCompare(b.item);
        if (a.dept !== b.dept) return a.dept.localeCompare(b.dept);
        if (a.date !== b.date) return a.date.localeCompare(b.date);
        if (a.remark !== b.remark) return a.remark.localeCompare(b.remark);
        return 0; // objects are equal
    })
    const end3 = performance.now(); 
    const prs3 = (end3 - start3) / 1000;
    console.log('data dalam 1 array');
    console.log({allArray})
    console.log('waktu proses data3 : ' + prs3);
    const report4 = document.createElement('p');
    report4.textContent = 'finalisasi data selesai dalam waktu ' + dlDt + ' detik';
    root.appendChild(report4);


    // step 4
    console.log('========================================================================================');
    console.log('step4 : ');
    console.log('------------------------------------------------------------');

    const inputArr = {
        data_date: [],
        item: [],
        remark: [],
        loc__line: [],
        dept: [],
        qty: [],
        lot__id: [],
        _date: [],
    };
    for (let i=0; i<allArray.length; i++) {
        inputArr['data_date'].push(currentDate());
        inputArr['item'].push(allArray[i]['item']);
        inputArr['remark'].push(allArray[i]['remark']);
        inputArr['loc__line'].push(allArray[i]['loc__line']);
        inputArr['dept'].push(allArray[i]['dept']);
        inputArr['qty'].push(allArray[i]['qty']);
        inputArr['lot__id'].push(allArray[i]['lot__id']);
        inputArr['_date'].push(allArray[i]['date']);
    }
    console.log(inputArr);

    const cek = await pickNow.fetchDataFilter({data_date: currentDate()}) ;
    const result1 = await pickNow.deleteData();
    const report5 = document.createElement('h3');

    if (cek.length === 0) {
        const result2 = await pickNow.insertData(inputArr);
        if(!result2.includes('fail')) {
            report5.textContent = 'Pemasukan data ke database selesai';
        } else {
            report5.textContent = 'Pemasukan data gagal';
        }
    } else  {
        report5.textContent = 'Data sudah tersedia';
    }
    const endFinal = performance.now();
    const totalTime = (endFinal - initPage) /1000;
    const h2 = document.createElement('h3');
    h2.textContent = 'waktu proses total : ' + totalTime;
    root.removeChild(document.querySelector('.loading'));
    root.appendChild(report5);
    root.appendChild(h2);




</script>
<script type='module' src="./utility/index.js"></script>
</body>
</html>