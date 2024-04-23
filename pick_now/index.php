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
        searchBarMain,
        mainTbl,
    } from './component/index.js';
    import {
        jsonToCsv,jsonToExcel,
        wobb, wo, ld, loc, currentDate, dept,
        convertDateFormat
    } from './utility/index.js';
    
    // initiation data
    const root = document.getElementById('root');
    await createNav(navigation);
    const demand = await wobb.getData();
    const woR = await wo.fetchDataFilter({wo_status: 'R'});
    const oh = await ld.getData();
    const cekLoc = await loc.getData();
    const cekDept = await dept.getData();
    activeLink('navID', ['f-or7']);
    await createSearch(searchBarMain);
    root.removeChild(document.querySelector('.loading'));
    
    console.log('hasil data :')
    console.log({demand, woR});
    console.log({oh, cekLoc});
    console.log({cekDept})
    const endInit = performance.now();
    const dlDt = (endInit - initPage) / 1000;
    console.log('waktu inisiasi dan penarikan data : ' + dlDt);

    /* step 1 
        ada 2 hal yg dilakukan : 
        1 mencari data demand 
            data demand dari demand(wod_det) digabung dengan woR(wo_mstr) utk mengeluarkan semua kebutuhan dari id yg sudah Release
        2 mencari data OH 
            data OH di dapat dari oh(ld_det) digabung dengan cekLoc(loc_mstr) utk mengategorikan OH di setiap departement 
    */
   const start1 = performance.now();
   console.log('========================================================================================');
   console.log('step1 : ');

   // demand data 
    const wo_release = woR.filter(item => item.wo_status === 'R');
    const id_R = [];
    wo_release.forEach(dt=>{
        if(!id_R.includes(dt.wo_lot)) {
            id_R.push(dt.wo_lot)
        }
    })
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

    dmnd_new.forEach(dt=>{
        const data = cekDept.find(item => item.routing == dt.item);
        if(data) {
            dt['dept'] = data.assyLine;
        } else {
            dt['dept'] = '';
        }
    })
    console.log(dmnd_new);
    // on hand inventory
    oh.forEach(dt=>{
        const data = cekLoc.find(obj => obj.loc_loc.toLowerCase() === dt.ld_loc.toLowerCase());
        if(data) {
            dt['dept'] = data.loc_department;
        }
    })

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
    console.log('demand new');
    console.log({dmnd_new});
    console.log('OH inventory');
    console.log({oh, invDet, oh_all});
    console.log('waktu proses data1 : ' + prs1);
    
    // step 2 
    const start2 = performance.now();
    console.log('========================================================================================');
    console.log('step2 : ');

    const gabungan = [];
    dmnd_new.forEach(dt=>{
        const cekDate = convertDateFormat(dt.rel_dt);
        const code = dt.item+dt.dept;
        let data ={
            item: dt.item,
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
        }
    })


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
    console.log('gabungan');
    console.log({gabungan})
    console.log('waktu proses data2 : ' + prs2);

    // step 3 
    const start3 = performance.now();
    console.log('========================================================================================');
    console.log('step3 : ');
    const allArray = [];
    const key = Object.keys(gabungan);
    console.log(key);
    
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


    // step 4
    console.log('========================================================================================');
    console.log('step4 : ');
    const endFinal = performance.now();
    const totalTime = (endFinal - initPage) /1000;
    console.log('waktu proses : ' + totalTime);
    
    // searching data on web
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
        /*
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(gabungan);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'parent');
        XLSX.writeFile(workbook, 'test.xlsx')
        */

        await jsonToCsv(allArray, 'testing.csv');
        await jsonToCsv(dmnd_new, 'testing2.csv');
        await jsonToCsv(oh_all, 'testing3.csv');
        btn.disabled = false;
    })


</script>
<!--<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>.-->
<script type='module' src="./utility/index.js"></script>
<script src="./utility/post.js"></script>
</body>
</html>