<?php
/*
    INSERT INTO `sb_usage_log`(`id`, `tr_date`, `jig`, `desc_jig`, `code`, `cat`, `loc`, `qty_pinjam`, `wo_id`, `type`, `qty_total`, `count_dt`, `code_count`, `qty_jig`, `qty_usage`, `codeAll`, `id_trans`) 
    SELECT `id`, `tr_date`, `jig`, `desc_jig`, `code`, `cat`, `loc`, `qty_pinjam`, `wo_id`, `type`, `qty_total`, `count_dt`, `code_count`, `qty_jig`, `qty_usage`, `codeAll`, `id_trans`
    FROM db_jig.jig_usage WHERE ID BETWEEN 1 AND 103
*/
?>

<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='../1.asset/main.css' rel='stylesheet' />
        <link href='../1.asset/output.css' rel='stylesheet' />
        <link rel='icon' href='../1.asset/symbol/new_logo_sbe.png' type='image/ico' />
        <title>Jig DB Scheduler</title>
    </head>
    <body class='w-[100vw] bg-slate-300 p-2'>
        <div id='load' class='w-screen h-screen absolute z-40 flex justify-center items-center' >
            <div id='loadscreen' class='h-full w-full absolute bg-slate-400' ></div>
            <div class='loading2' ></div>
        </div>
    <script type='module'>
        const start = performance.now();
        const body = document.querySelector('body');
        const result_check = (data) => {
            const body = document.querySelector('body');
            const separator1 = '==========================================';
            const separator2 = '----------------------------';
            data.forEach(d=>{
                const div1 = document.createElement('div');
                const ttl_div1 = document.createElement('h3');
                ttl_div1.setAttribute('class', 'text-xl font-semibold');
                if(Array.isArray(d.data_array)) {
                    ttl_div1.innerHTML = separator1+"</br>"+d.title+"</br>"+separator1+"</br>data count: "+ d.data_array.length;
                    for (let i=0; i<2; i++) {
                        const dt = d['data_array'][i];
                        let text = "</br> data ke " + i+"</br>"+separator2+"</br>";
                        if(dt !== undefined) {
                            console.log(dt);
                            if(typeof dt === 'string') {
                                text += dt+', ';
                            } else {
                                console.log('here');
                                const key = Object.keys(dt);
                                key.forEach(dd=>{
                                    text += `${dd} = ${dt[dd]}`+"</br>";
                                })
                            }
                        }
                        const div_isi = document.createElement('div');
                        div_isi.innerHTML = text+separator2+"</br>";
                        div1.appendChild(div_isi);
                    }
                    body.appendChild(ttl_div1);
                    body.appendChild(div1);
                    console.log(separator1);
                    console.log(d.title);
                    console.log(separator2);
                    console.log(d.data_array);
                    console.log(separator1);
                    return;
                }
                console.log(typeof d.data_array);
                if(!Array.isArray(d.data_array) && typeof d.data_array === 'object') {
                    const data_key = Object.keys(d.data_array);
                    ttl_div1.innerHTML = separator1+"</br>"+d.title+"</br>"+separator1+"</br>data count: "+ data_key.length;
                    for (let i=0; i<2; i++) {
                        const dt = data_key[i];
                        const key = Object.keys(dt);
                        console.log(key);
                        let text = '';
                        if(key.length === 0 ) {
                            text = "</br> data ke " + i+" = "+dt+"</br>";
                        } else {
                            text = "</br> data ke " + i+"</br>"+separator2+"</br>";
                            key.forEach(dd=>{
                                text += `${dd} = ${dt[dd]}`+"</br>";
                            })
                        }
                        const div_isi = document.createElement('div');
                        div_isi.innerHTML = text+separator2+"</br>";
                        div1.appendChild(div_isi);
                    }
                    body.appendChild(ttl_div1);
                    body.appendChild(div1);
                    console.log(separator1);
                    console.log(d.title);
                    console.log(separator2);
                    console.log(d.data_array);
                    console.log(separator1);
                    return;
                }
            })
        }
        import {api_access2, api_access, getCustomDate} from '../3.utility/index.js';
        const [yesterday, cekTrans, cek_jig_use] = [
            getCustomDate(-1,"-"),
            [],
            []
        ]
        const [otb, trans, emp, func, mstr, cek] = await Promise.all([
            api_access2('fetch_op_tran','jig_db_new', 'ng_dly', {op_tran_date:['2024-09-10', '2024-09-23']}),
            //api_access2('fetch2','jig_db_new','ng_dly', {op_tran_date: yesterday}),
            api_access2('get', 'jig_db_new','jig_trans',''),
            api_access2('get','jig_db_new','emp_code',''),
            api_access2('get','jig_db_new','jig_func',''),
            api_access2('get','jig_db_new','jig_mstr',''),
            api_access2('fetch_jig_usg_check','jig_db_new','jig_usg_test',''),
        ])
        result_check([
            {data_array: otb, title:'otb data '},
            {data_array: trans, title:'trans data '},
            {data_array: emp, title:'emp data '},
            {data_array: func, title:'func data '},
            {data_array: mstr, title:'mstr data '},
        ]);
        
    /*===================================================================
    cek code employee
    ===================================================================*/
        const codeEmp = {};
        emp.forEach(em=> {
            if(!codeEmp[em.emp_code]) {
                codeEmp[em.emp_code] = em.loc_name;
            }
        })
        result_check([
            {data_array: emp, title:'emp code data '}
        ]);

    /*===================================================================
    summary qty run labor per item number, per eff date, per id dan per operation 
    ===================================================================*/
        const newOTB = new Map();
        otb.forEach(tr=> {
            /*
            op_part =  item number id
            op_date = effective date
            op_wo_lot = id dari WO
            op_wo_op = operation
            */
            const filter = tr.op_part + tr.op_date + tr.op_wo_lot + tr.op_wo_op;
            if(newOTB.has(filter)) {
                const exst = newOTB.get(filter);
                exst.qty_run += parseInt(tr.op_qty_run); 
                exst.qty_ng += parseInt(tr.op_qty_ng); 
                exst.qty_total +=  parseInt(tr.op_qty_run) + parseInt(tr.op_qty_ng);
            } else { 
                let empLoc = '';
                if (codeEmp[tr.op_emp]) {
                    empLoc = codeEmp[tr.op_emp];
                } else {
                    empLoc = tr.op_emp
                }
                const data ={
                    type: tr.op_part,
                    eff_date: tr.op_date,
                    op: tr.op_wo_op,
                    wo_id: tr.op_wo_lot,
                    qty_run: parseInt(tr.op_qty_run),
                    qty_ng: parseInt(tr.op_qty_ng),
                    wc: tr.op_wkctr,
                    emp: empLoc,
                    qty_total: parseInt(tr.op_qty_run) + parseInt(tr.op_qty_ng),
                }
                newOTB.set(filter, data);
            }
        })
        const labor2 = Array.from(newOTB.values());
        result_check([
            {data_array: labor2, title:'labor2 summary per operation per date qty run'}
        ]);

    /*===================================================================
    dari 1 id per harinya dari semua operation di pick yang qty run total dari proses sebelumnya yang paling besar (menjadi labor4)
    ===================================================================*/
        const labor3 = new Map();
        labor2.forEach(lbr => {
            const filter = lbr.type + lbr.wo_id + lbr.op_date;
            if(labor3.has(filter)) {
                const exst = labor3.get(filter);
                if(exst.qty_total < lbr.qty_total) {
                    exst.qty_run = lbr.qty_run; 
                    exst.qty_ng = lbr.qty_ng; 
                    exst.qty_total = lbr.qty_total; 
                }
            } else { 
                const data ={
                    type: lbr.type,
                    eff_date: lbr.eff_date,
                    wo_id: lbr.wo_id,
                    qty_run: lbr.qty_run,
                    qty_ng: lbr.qty_ng,
                    wc: lbr.wc,
                    emp: lbr.emp,
                    qty_total: lbr.qty_total
                }
                labor3.set(filter, data);
            }
        })
        const labor4 = Array.from(labor3.values());
        result_check([
            {data_array: labor4, title:'labor4 ignoring operation, pick the biggest qty run total'}
        ]);

    /*===================================================================
    list jig utk 1 item number menggunakan jig apa saja
    ===================================================================*/
        const listJig = {};
        func.forEach(fn=> {
            if(listJig[fn.item_type] && !listJig[fn.item_type].includes(fn.item_jig)) {
                listJig[fn.item_type].push(fn.item_jig);
            } else {
                listJig[fn.item_type] = [fn.item_jig];
            }
        })
        console.log(listJig);
        result_check([
            {data_array: listJig, title:'list jig'}
        ]);

    /*===================================================================
    adding data utk pinjam dan kembali ke data array
    ===================================================================*/
        const newLabor = [];
        const fnKey = Object.keys(listJig);
        const id = [];
        trans.forEach(tr=> {
            if( cek.filter(obj=> obj.id_trans === tr.id && obj.cat !== 'b.use').length===0) {
                const marked1 = tr.id + 'a.pinjam';
                if(!id.includes(marked1) /*&& tr.start_date === yesterday*/) {
                    const data = {
                        tr_date: tr.start_date,
                        jig: tr.item_jig,
                        code: tr.code,
                        cat: 'a.pinjam',
                        loc: tr.loc,
                        qty_pinjam: tr.qty,
                        wo_id: '',
                        type: '',
                        qty_total: '',
                        id_trans: tr.id
                    }
                    id.push(marked1);
                    newLabor.push(data);
                }
                    
                const marked2 = tr.id + 'c.kembali';
                if(!id.includes(marked2) && tr.end_date !== null && tr.end_date !=='' && tr.end_date !== '0000-00-00') {
                    const data = {
                        tr_date: tr.end_date,
                        jig: tr.item_jig,
                        code: tr.code,
                        cat: 'c.kembali',
                        loc: tr.loc,
                        qty_pinjam: tr.qty,
                        wo_id: '',
                        type: '',
                        qty_total: '',
                        id_trans: tr.id
                    }
                    id.push(marked2);
                    newLabor.push(data);
                }
            }
        })
        result_check([
            {data_array: id, title:'cek ID'},
            {data_array: newLabor, title:'newLabor adding data transaksi pinjam kembali'},
        ]);
        
    /*===================================================================
    adding data penggunaan berdasarkan labor 
    ===================================================================*/
        labor4.forEach(lb=> {
            if(fnKey.includes(lb.type)) {
                listJig[lb.type].forEach(ls => {
                    const data = {
                        tr_date: lb.eff_date,
                        jig: ls,
                        code: '',
                        cat: 'b.use',
                        loc: lb.emp,
                        qty_pinjam:'',
                        wo_id: lb.wo_id,
                        type: lb.type,
                        qty_total: lb.qty_total,
                        id_trans: ''
                    }
                    newLabor.push(data);
                })
            }
        })

        newLabor.forEach(dt=>{
            if(dt.tr_date === null) {
                console.log(dt);
            }
        })
        newLabor.sort((a,b) => {
            if (a.jig < b.jig) return -1;
            if (a.jig > b.jig) return 1;
            if (a.loc !== b.loc) return a.loc.localeCompare(b.loc);
            if (a.tr_date !== b.tr_date) return a.tr_date.localeCompare(b.tr_date);
            if (a.cat !== b.cat) return a.cat.localeCompare(b.cat);
            return 0; // objects are equal
        })
        result_check([
            {data_array: newLabor, title:'newLabor adding data transaksi penggunaan'},
        ]);

    /*===================================================================
    adding new data in newLabor
    ===================================================================*/
        for (let i=0; i<newLabor.length; i++) {
            const a = newLabor[i];
            const codeFilter = a.jig + a.loc;
            a.count = 0;
            a.code_count = 0;
            a.qty_jig = 0;
            a.qty_usage = 0;
            a.codeAll = '';
            
            let ii = i-1;
            const b = newLabor[ii];
            let codeFilter2 = '';
            if(b) {
                codeFilter2 = b.jig + b.loc;
            }
            if( cek.filter(obj=> obj.id_trans === tr.id && obj.cat !== 'b.use').length===0) {
                if( codeFilter2 ) {
                    if(a.cat === 'a.pinjam') { 
                        a.count = 1;
                        if ( codeFilter === codeFilter2) {
                            a.codeAll = b.codeAll + a.code;
                            a.code_count += 1 + b.code_count;
                            a.qty_jig = parseFloat(a.qty_pinjam) + parseFloat(b.qty_jig);  
                        } else {
                            a.codeAll = a.code ;
                            a.code_count += 1 ;
                            a.qty_jig = parseFloat(a.qty_pinjam);  
                        }
                    }
                    if(a.cat === 'c.kembali') { 
                        a.count = 1;
                        if ( codeFilter === codeFilter2) {
                            a.codeAll = b.codeAll.replace((`${a.code}`),'');
                            a.code_count = b.code_count - 1;
                            a.qty_jig = parseFloat(b.qty_jig) - parseFloat(a.qty_pinjam); 
                        } else {
                            a.code_count = 0 ;
                            a.codeAll = '';
                            a.qty_jig = 0; 
                        }
                    } 
                    if(a.cat === 'b.use') { 
                        if ( codeFilter === codeFilter2) {
                            if (b.code_count === 0) { a.count = 0;} else {a.count = b.count;}
                            a.code_count = b.code_count;
                            a.codeAll = b.codeAll;
                            a.qty_jig = b.qty_jig;
                            if (a.count === 0) {a.code = '';} else {a.code = b.code;}
                            if (a.qty_jig === 0) {
                                a.qty_usage = 0
                            } else {
                                a.qty_usage =  Math.ceil(parseFloat(a.qty_total) / a.qty_jig);
                            }
                        }
                    }
                } 
            }
        }
        newLabor.sort((a,b) => {
            if (a.jig < b.jig) return -1;
            if (a.jig > b.jig) return 1;
            if (a.loc !== b.loc) return a.loc.localeCompare(b.loc);
            if (a.tr_date !== b.tr_date) return a.tr_date.localeCompare(b.tr_date);
            if (a.cat !== b.cat) return a.cat.localeCompare(b.cat);
            return 0; // objects are equal
        })
        result_check([
            {data_array: newLabor, title:'newLabor adding cek data berdasarkan sorting data utk cek apakah di gunakan atau tidak '},
        ]);

    /*===================================================================
    array input data akhir yg di dapat dari New Labor, yang di tandai di hitung
    ===================================================================*/
        const arrInp =[];
        for (let i=0; i<newLabor.length; i++) { 
            const a = newLabor[i];
            if (a.count === 1 ) {
                const dJig = mstr.find(item => item.item_jig === a.jig);
                const basicDt = {
                    ...a,
                    desc_jig: dJig.desc_jig,
                    count_dt: 1,
                }
                arrInp.push(basicDt);
                if (a.cat === 'b.use') {
                for (let i2=1; i2<a.code_count; i2++) {
                    const len = a.code.length;
                    const codeNew = a.codeAll.substring((len*(i2-1)),(len*i2));
                    const data = {
                        tr_date: a.tr_date,
                        jig: a.jig,
                        desc_jig: dJig.desc_jig,
                        code: codeNew,
                        cat: a.cat,
                        loc: a.loc,
                        qty_pinjam: a.qty_pinjam,
                        wo_id: a.wo_id,
                        type: a.type,
                        qty_total: a.qty_total,
                        count_dt: 1,
                        code_count: a.code_count,
                        qty_jig: a.qty_jig,
                        qty_usage: a.qty_usage,
                        codeAll: a.codeAll,
                        id_trans: ''
                    }
                    arrInp.push(data);
                }}
            }
        }
        result_check([
            {data_array: arrInp, title:'data akhir utk masuk ke database'},
        ]);

    /*===================================================================
    load data to databases
    ===================================================================
        const result = await api_access('insert','jig_usg_test', arrInp);
        const end = performance.now();
        const totalTime = (end - start) /1000;
        console.log('total time = ' + totalTime);

        const h1 = document.createElement('h1');
        h1.setAttribute('class', 'text-xl font-bold')
        body.appendChild(h1);
        if(!result.includes('fail')) {
            h1.textContent = `${arrInp.length} data successfully inserted to database after ${totalTime} seconds`;
        } else {
            h1.textContent = `something went wrong`;
            const p = document.createElement('p');
            p.innerHTML = `${result}`;
            body.appendChild(p);
        }
            */
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.json_to_sheet(newLabor);
            XLSX.utils.book_append_sheet(workbook, worksheet, 'new labor');
            XLSX.writeFile(workbook, 'db_jig_Total.xlsx')
        const load = document.querySelector('#load');
        load.classList.add('hidden');
    </script>
    <script src='../1.asset/external_library/sheetjs/xlsx.full.min.js'></script>
    </body>
    </html>
    