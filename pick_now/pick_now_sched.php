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
        activeLink,
    } from './component/index.js';
    import {
        jsonToCsv,jsonToExcel, getCustomDate,
        wobb, wo, ld, loc, currentDate, dept, pickNow, on_hand, pt_mstr,
        convertDateFormat
    } from './utility/index.js';
    
    // initiation data
    const root = document.getElementById('root');
    console.log('========================================================================================');
    console.log('step0 : inisiasi awal ')
    console.log('========================================================================================');
    const demand = await wobb.dbProcess('get','', 'cache'); // wod_det
    const woR = await wo.dbProcess('fetch',{wo_status: 'R'}, 'cache'); // wo_mstr
    const item_mstr = await pt_mstr.dbProcess('get','', 'cache'); // wo_mstr
    const oh = await ld.dbProcess('get','',''); // ld_det
    const cekLoc = await loc.dbProcess('get','', 'cache'); //loc_mstr
    const cekDept = await dept.dbProcess('get','', 'cache');
    const cekNew = await pickNow.dbProcess('fetch',{data_date: getCustomDate(-1)}, 'cache');
    const delete1 = await pickNow.dbProcess('delete',{data_date: getCustomDate(-2)});
    const delete2 = await on_hand.dbProcess('delete',{data_date: getCustomDate(-1)});
    console.log({delete1, delete2}); 
    const h1 = document.createElement('h1');
    h1.textContent = 'Scheduler Pick Now';
    root.appendChild(h1);
    
    console.log('************************************************************');
    console.log('data raw utk demand dari WOBB dan WO yang R');
    console.log('------------------------------------------------------------');
    console.log({demand, woR, cekDept});


    console.log('************************************************************');
    console.log('data raw utk OH dan list lokasi utk mendapatkan demand');
    console.log('------------------------------------------------------------');
    console.log({oh, cekLoc, item_mstr});

    
    console.log('************************************************************');
    console.log('list WO release dari data penarikkan tgl sebelumnya');
    console.log('------------------------------------------------------------');
    const cekIDnewR = [];
    cekNew.forEach(dt=>{
        if(!cekNew.includes(dt.lot__id)) {
            cekIDnewR.push(dt.lot__id);
        }
    })
    console.log({cekNew, cekIDnewR});

    console.log('************************************************************');
    const endInit = performance.now();
    const dlDt = (endInit - initPage) / 1000;
    console.log('waktu inisiasi dan penarikan data : ' + dlDt);
    const report0 = document.createElement('p');
    report0.textContent = 'inisiasi dan penarikan data dari database selesai dalam waktu ' + dlDt + ' detik';
    root.appendChild(report0);

    console.log('========================================================================================');
    console.log('step1 : persiapan utk referensi data ')
    console.log('========================================================================================');
    const start1 = performance.now();
    console.log('************************************************************');
    console.log('list ID nya saja dari wo release');
    const id_R = [];
    woR.forEach(dt=>{
        if(!id_R.includes(dt.wo_lot)) {
            id_R.push(dt.wo_lot)
        }
    })
    console.log('------------------------------------------------------------');
    console.log({id_R});


    console.log('************************************************************');
    console.log('list dept');
    const ls_dept = [];
    cekDept.forEach(dt=>{
        if(!ls_dept.includes(dt.dept)) {
            ls_dept.push(dt.dept)
        }
    })
    console.log('------------------------------------------------------------');
    console.log({ls_dept});

    console.log('************************************************************');
    const end1 = performance.now();
    const prs1 = (end1 - start1) / 1000;
    console.log('waktu persiapan data reference: ' + prs1);
    console.log('------------------------------------------------------------');
    const report1 = document.createElement('p');
    report1.textContent = 'pembuatan list ID wo release dan dept selesai dalam waktu ' + prs1 + ' detik';
    root.appendChild(report1);

    console.log('========================================================================================');
    console.log('step2 : proses utk data demand dan data on hand')
    console.log('========================================================================================');
    const start2 = performance.now();
    console.log('************************************************************');
    console.log('data demand lengkap berdasarkan WO release dengan tambahan field dept. note: demand tidak perlu di akumulasi');
    const dmnd_new = [];
    demand.forEach(dt=>{
        if(id_R.includes(dt.wod_lot)){
            const data_wo = woR.find(obj=>obj.wo_lot === dt.wod_lot);
            const data = {
                ...dt,
                item: data_wo.wo_part ? data_wo.wo_part : '-',
                routing: data_wo.wo_routing ? data_wo.wo_routing : '-',
                assyLine: data_wo.wo__chr04 ? data_wo.wo__chr04 :'-',
                rel_dt: data_wo.wo_rel_date ? data_wo.wo_rel_date : 0,
                due_dt: data_wo.wo_due_date ? data_wo.wo_due_date : 0,
            }
            dmnd_new.push(data);
        }
    })

    dmnd_new.forEach(dt=>{
        const data = cekDept.find(item => item.assyLine === dt.assyLine);
        if(data) {
            dt['dept'] = data.dept;
        } else {
            dt['dept'] = '';
        }
    })
    console.log('------------------------------------------------------------');
    console.log({dmnd_new});


    console.log('************************************************************');
    console.log('data inventory detail dengan tambahan kolom departement');
    oh.forEach(dt=>{
        const data = cekLoc.find(obj => obj.loc_loc.toLowerCase() === dt.ld_loc.toLowerCase());
        if(data) {
            dt['dept'] = data.loc_department;
        }
    })
    console.log('------------------------------------------------------------');
    console.log({oh});

    console.log('************************************************************');
    console.log('akumulasi OH per dept per item number dari data oh');
    const invDet = new Map();
    oh.forEach(dt=>{
        const fltr = dt.ld_part + dt.dept;
        if(invDet.has(fltr)) {
            const exst = invDet.get(fltr);
            exst.qty_OH += parseFloat(dt.ld_qty_oh);
        } else {
            const data = {
                dept: dt.dept,
                loc: dt.ld_loc,
                item: dt.ld_part,
                qty_OH: parseFloat(dt.ld_qty_oh),
                lot: dt.ld_lot,
                reff: dt.ld_ref
            }
            invDet.set(fltr,data);
        }
    })
    const oh_all = Array.from(invDet.values());
    console.log('------------------------------------------------------------');
    console.log({oh_all});

    console.log('************************************************************');
    const end2 = performance.now();
    const prs2 = (end2 - start2) / 1000;
    console.log('waktu proses data1 : ' + prs2);
    const report2 = document.createElement('p');
    report2.textContent = 'proses data awal selesai dalam waktu ' + prs2 + ' detik';
    root.appendChild(report2);
    

    console.log('========================================================================================');
    console.log('step3 : penggabungan data demand dan on hand per departement');
    console.log('========================================================================================');
    const start3 = performance.now();
    console.log('************************************************************');
    console.log('item: list data item yg ada demand');
    const gabCek = [];
    const item = [];
    let counter = 0;
    dmnd_new.forEach(dt=>{
        const cekDate = convertDateFormat(dt.rel_dt);
        const code = dt.wod_part+dt.dept;
        let data ={
            item: dt.wod_part,
            remark: '2.demand',
            loc__line: dt.assyLine,
            dept: dt.dept,
            qty: parseFloat(dt.wod_qty_req),
            lot__id: dt.wod_lot,
            date: cekDate,
            current: currentDate(),
        }
        if(!item.includes(dt.wod_part)) {
            item.push(dt.wod_part);
        }
        gabCek.push(data);
    })
    console.log('------------------------------------------------------------');
    console.log({item});

    console.log('************************************************************');
    console.log('data gabungan demand dan OH all yg');
    oh_all.forEach(dt=>{
        if (ls_dept.includes(dt.dept) && item.includes(dt.item)) {
            let data = {
                item: dt.item,
                remark: '1.on hand',
                loc__line: dt.loc,
                dept: dt.dept,
                qty: dt.qty_OH,
                lot__id: dt.lot,
                date: currentDate(),
                current: currentDate(),
            }
            gabCek.push(data);
        }
    })
    gabCek.sort((a,b) => {
        if (a.item !== b.item) return a.item.localeCompare(b.item);
        if (a.dept !== b.dept) return a.dept.localeCompare(b.dept);
        if (a.date !== b.date) return a.date.localeCompare(b.date);
        if (a.remark !== b.remark) return a.remark.localeCompare(b.remark);
        return 0; // objects are equal
    })
    let tempVal = 0;
    let codeCek = '';
    let action = '';
    gabCek.forEach(dt=>{
        if(codeCek !== dt.item+dt.dept) {
            codeCek = dt.item+dt.dept;
            if(dt.remark === '1.on hand') {
                tempVal = dt.qty;
            } else {
                tempVal = (-1) * dt.qty;
            }
        } else {
            if(dt.remark === '1.on hand') {
                tempVal = tempVal + dt.qty;
            } else {
                tempVal = tempVal - dt.qty;
            }
        }
        if(dt.date > currentDate() && tempVal < 0) {
            action = 'pick now';
        } else { action = '';}
        dt.code =  codeCek;
        dt.valAcc = tempVal;
        dt.pick = action;
        if(cekIDnewR.includes(dt.lot__id)) {
            action = 'baru';
        } else { action = '';}
        dt.id_new = action;
    })
    console.log('------------------------------------------------------------');
    console.log({gabCek})

    console.log('************************************************************');
    const end3 = performance.now(); 
    const prs3 = (end3 - start3) / 1000;
    console.log('waktu proses data2 : ' + prs3);
    const report3 = document.createElement('p');
    report3.textContent = 'penggabungan data selesai dalam waktu ' + prs3 + ' detik';
    root.appendChild(report3);

    console.log('========================================================================================');
    console.log('step4 : final result ');
    console.log('========================================================================================');
    const start4 = performance.now();
    console.log('************************************************************');
    console.log('all id pick now');
    const ls_pick = [];

    gabCek.forEach(dt=>{
        if(!ls_pick.includes(dt.lot__id) && dt.pick === 'pick now') {
            ls_pick.push(dt.lot__id);
        }
    })
    console.log('------------------------------------------------------------');
    console.log({ls_pick});
    
    console.log('************************************************************');
    console.log('all id pick now');
    const result_pick = [];
    gabCek.forEach(dt=>{
        if(ls_pick.includes(dt.lot__id)) {
            result_pick.push(dt);
        }
    })
    console.log('------------------------------------------------------------');
    console.log({result_pick});

    const end4 = performance.now(); 
    const prs4 = (end4 - start4) / 1000;
    console.log('waktu proses data3 : ' + prs4);
    const report4 = document.createElement('p');
    report4.textContent = 'finalisasi data selesai dalam waktu ' + prs4 + ' detik';
    root.appendChild(report4);

    console.log('========================================================================================');
    console.log('step5 : input data ke database');
    console.log('========================================================================================');
    const start5 = performance.now();
    console.log('************************************************************');
    console.log('proses data pick now utk input ke database');
    //const inputArr = {
    //    data_date: [],
    //    item: [],
    //    remark: [],
    //    loc__line: [],
    //    dept: [],
    //    qty: [],
    //    lot__id: [],
    //    _date: [],
    //};
    const inputArr = [];
    for (let i=0; i<result_pick.length; i++) {
        const data ={
            data_date: currentDate(),
            item: result_pick[i]['item'],
            remark: result_pick[i]['remark'],
            loc__line: result_pick[i]['loc__line'],
            dept: result_pick[i]['dept'],
            qty: result_pick[i]['qty'],
            lot__id: result_pick[i]['lot__id'],
            _date: result_pick[i]['date'],
            pick: result_pick[i]['pick']
        }
        inputArr.push(data);
    }
    console.log('------------------------------------------------------------');
    console.log(inputArr);

    console.log('************************************************************');
    console.log('proses data On Hand utk input ke database');   
    //const inputArr2 = {
    //    data_date: [],
    //    dept: [],
    //    item: [],
    //    loc: [],
    //    lot: [],
    //    qty_OH: [],
    //    reff: [],
    //};
    const inputArr2 =[];
    oh_all.forEach(dt=>{
        if(dt.dept === 'WH') {
            const data = {
                data_date: currentDate(),
                dept: dt['dept'],
                item: dt['item'],
                loc: dt['loc'],
                lot: dt['lot'],
                qty_OH: dt['qty_OH'],
                reff: dt['reff'],
            }
            inputArr2.push(data);
        }
    })
    console.log('------------------------------------------------------------');
    console.log(inputArr2);

    console.log('************************************************************');
    const cek = await pickNow.dbProcess('fetch',{data_date: currentDate()}) ;
    const report5 = document.createElement('h3');

    if (cek.length === 0) {
        const result2 = await pickNow.dbProcess('insert',inputArr);
        if(!result2.includes('fail')) {
            report5.textContent = 'Pemasukan data pick now sebanyak ' + inputArr.length + ' data ke database selesai';
        } else {
            report5.textContent = 'Pemasukan data pick now gagal';
        }
    } else  {
        report5.textContent = 'Data pick now sudah tersedia';
    }

    const cek2 = await on_hand.dbProcess('fetch',{data_date: currentDate()}) ;
    const report6 = document.createElement('h3');
    if (cek2.length === 0) {
        const result3 = await on_hand.dbProcess('insert',inputArr2);
        if(!result3.includes('fail')) {
            report6.textContent = 'Pemasukan data on hand sebanyak ' + inputArr2.length + ' data ke database selesai';
        } else {
            report6.textContent = 'Pemasukan data on hand gagal';
        }
    } else  {
        report6.textContent = 'Data on hand sudah tersedia';
    }
    const endFinal = performance.now();
    const totalTime = (endFinal - initPage) /1000;
    const h2 = document.createElement('h3');
    h2.textContent = 'waktu proses total : ' + totalTime;
    root.removeChild(document.querySelector('.loading'));
    root.appendChild(report5);
    root.appendChild(report6);
    root.appendChild(h2);

/*
woR = woR
item = item_mstr
mainData = inputArr
inventory = inpu
*/


/*
    const workbook = XLSX.utils.book_new();
    const worksheet = XLSX.utils.json_to_sheet(demand);
    const worksheet2 = XLSX.utils.json_to_sheet(woR);
    const worksheet3 = XLSX.utils.json_to_sheet(oh);
    const worksheet4 = XLSX.utils.json_to_sheet(cekLoc);
    const worksheet5 = XLSX.utils.json_to_sheet(cekDept);
    const worksheet6 = XLSX.utils.json_to_sheet(dmnd_new);
    const worksheet7 = XLSX.utils.json_to_sheet(oh_all);
    const worksheet9 = XLSX.utils.json_to_sheet(gabCek);
    const worksheet10 = XLSX.utils.json_to_sheet(result_pick);
    XLSX.utils.book_append_sheet(workbook, worksheet, 'demand');
    XLSX.utils.book_append_sheet(workbook, worksheet2, 'woR');
    XLSX.utils.book_append_sheet(workbook, worksheet3, 'oh');
    XLSX.utils.book_append_sheet(workbook, worksheet4, 'cekLoc');
    XLSX.utils.book_append_sheet(workbook, worksheet5, 'cekDept');
    XLSX.utils.book_append_sheet(workbook, worksheet6, 'demandNew');
    XLSX.utils.book_append_sheet(workbook, worksheet7, 'oh_all');
    XLSX.utils.book_append_sheet(workbook, worksheet9, 'gabCek');
    XLSX.utils.book_append_sheet(workbook, worksheet10, 'result_pick');
    XLSX.writeFile(workbook, 'data.xlsx')
*/
</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>