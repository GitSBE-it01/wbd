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
    } from './component/index.js';
    import {
        jsonToCsv,jsonToExcel, getCustomDate,currentDate,
        wobb, wo, ld, loc, dept, pickNow, pt_mstr,pic_part,
        convertDateFormat
    } from './utility/index.js';
    
    // initiation data
    const root = document.getElementById('root');
    console.log('========================================================================================');
    console.log('step0 : inisiasi awal ')
    console.log('========================================================================================');
    const h1 = document.createElement('h1');
    h1.textContent = 'Scheduler Pick Now';
    root.appendChild(h1);
    const demand = await wobb.dbProcess('get',''); // wod_det
    const woR = await wo.dbProcess('fetch',{wo_status: 'R'}); // wo_mstr
    const cekDept = await dept.dbProcess('get','');
    const item_mstr = await pt_mstr.dbProcess('get',''); // wo_mstr
    console.log('************************************************************');
    console.log('data raw utk demand dari WOBB dan WO yang R');
    console.log('------------------------------------------------------------');
    console.log({demand, woR, cekDept, item_mstr});


    const pic = await pic_part.dbProcess('get',''); // wo_mstr
    const oh = await ld.dbProcess('get',''); // ld_det
    const cekLoc = await loc.dbProcess('get',''); //loc_mstr
    console.log('************************************************************');
    console.log('data raw utk OH dan list lokasi utk mendapatkan demand');
    console.log('------------------------------------------------------------');
    console.log({pic, oh, cekLoc});


    const delete1 = await pickNow.dbProcess('delete',{data_date: getCustomDate(-2)});
    console.log(delete1);
    
    console.log('************************************************************');
    console.log('list WO release dari data penarikkan tgl sebelumnya');
    console.log('------------------------------------------------------------');
    const cekNew = await pickNow.dbProcess('fetch',{data_date: getCustomDate(-1)});
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
            exst.detail += dt.ld_lot + "--" + dt.ld_loc + ", \n";
        } else {
            const data = {
                dept: dt.dept,
                loc: dt.ld_loc,
                item: dt.ld_part,
                qty_OH: parseFloat(dt.ld_qty_oh),
                lot: dt.ld_lot,
                reff: dt.ld_ref,
                detail: dt.ld_lot + "--" + dt.ld_loc + ", \n"
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
        if (ls_dept.includes(dt.dept) && item.includes(dt.item) && dt.dept === 'WH') {
            let data = {
                item: dt.item,
                remark: '1.on hand',
                loc__line: dt.loc,
                dept: dt.dept,
                qty: dt.qty_OH,
                lot__id: dt.lot,
                date: '2000-01-01',
                current: currentDate(),
                detail: dt.detail
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
            tempVal = 0;
            codeCek = dt.item+dt.dept;
            if(dt.remark === '1.on hand') {
                tempVal = parseFloat(dt.qty);
            } else {
                tempVal = (-1) * parseFloat(dt.qty);
            }
        } else {
            if(dt.remark === '1.on hand') {
                tempVal = tempVal + parseFloat(dt.qty);
            } else {
                tempVal = tempVal - parseFloat(dt.qty);
            }
        }
        if(tempVal < 0) {
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
    const typePick = [];

    gabCek.forEach(dt=>{
        if(!ls_pick.includes(dt.lot__id) && dt.pick === 'pick now') {
            ls_pick.push(dt.lot__id);
        }
        if(!typePick.includes(dt.item) && dt.pick === 'pick now') {
            typePick.push(dt.item);
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
        } else 
        if(typePick.includes(dt.item)) {
            result_pick.push(dt);
        } else if(dt.remark === '1.on hand') {
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
    console.log('step5 : finalizing and input data ke database');
    console.log('========================================================================================');
    const start5 = performance.now();
    console.log('************************************************************');
    console.log('proses data pick now utk input ke database');

    const finalResult = [];
    result_pick.forEach(dt=>{
        const picCek = pic.filter(item=>item.tipe === dt.item);
        const OH = oh_all.filter(item=>item.item === dt.item);
        const wo = woR.filter(item => item.wo_lot === dt.lot__id);
        const it = item_mstr.filter( item => item.pt_part === dt.item);
        const data = {
            ...dt,
            rel_date: wo && wo[0] && wo[0]['wo_rel_datex'] ? wo[0]['wo_rel_datex'] : '',
            due_date: wo && wo[0] && wo[0]['wo_due_datex']  ? wo[0]['wo_due_datex'] :'',
            rmks: wo && wo[0] && wo[0]['wo_rmks']  ? wo[0]['wo_rmks'] :'',
            desc: it && it[0] && it[0]['pt_desc1']? it[0]['pt_desc1'] : '',
            qtyOnHand: OH && OH[0] && OH[0]['qty_OH'] ? OH[0]['qty_OH'] : 0,
            all_lot: OH && OH[0] && OH[0]['lot'] ? OH[0]['lot'] : "-",
            pic: picCek ? picCek : "",
        }
        finalResult.push(data);
    })
    console.log('------------------------------------------------------------');
    finalResult.forEach(dt=>{
        if(dt['pic'].length > 0) {
            dt['picFix'] = dt['pic'][0]['optr'];
        }
    })
    console.log(finalResult);

    console.log('************************************************************');
    console.log('proses data pick now utk input ke database');

    const inputArr = [];
    for (let i=0; i<finalResult.length; i++) {
        const data ={
            data_date: currentDate(),
            item: finalResult[i]['item'],
            _desc: finalResult[i]['desc'],
            remark: finalResult[i]['remark'],
            lot__id: finalResult[i]['lot__id'],
            loc__line: finalResult[i]['loc__line'],
            dept: finalResult[i]['dept'],
            qty: finalResult[i]['qty'],
            valAcc: finalResult[i]['valAcc'],
            qty_OH: finalResult[i]['qtyOnHand'],
            lotOH: finalResult[i]['detail'] ? finalResult[i]['detail'] : '-',
            _date: finalResult[i]['date'],
            rel_dt: finalResult[i]['rel_date'],
            due_dt: finalResult[i]['due_date'],
            wo_rmks: finalResult[i]['rmks'],
            pic: finalResult[i]['picFix'] ? finalResult[i]['picFix'] : "-",
            pick: finalResult[i]['pick'],
            id_new: finalResult[i]['id_new']
        }
        inputArr.push(data);
    }
    inputArr.sort((a,b) => {
        if (a.item !== b.item) return a.item.localeCompare(b.item);
        if (a.dept !== b.dept) return a.dept.localeCompare(b.dept);
        if (a._date !== b._date) return a._date.localeCompare(b._date);
        if (a.remark !== b.remark) return a.remark.localeCompare(b.remark);
        return 0; // objects are equal
    })
    console.log('------------------------------------------------------------');
    console.log(inputArr);

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

    const endFinal = performance.now();
    const totalTime = (endFinal - initPage) /1000;
    const h2 = document.createElement('h3');
    h2.textContent = 'waktu proses total : ' + totalTime;
    root.removeChild(document.querySelector('.loading'));
    root.appendChild(report5);
    root.appendChild(h2);

/*
woR = woR
item = item_mstr
mainData = inputArr
inventory = inpu
    const workbook = XLSX.utils.book_new();
    const worksheet = XLSX.utils.json_to_sheet(inputArr);
    XLSX.utils.book_append_sheet(workbook, worksheet, 'result_pick');
    XLSX.writeFile(workbook, 'data.xlsx')
*/

</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>