<?php

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
        <title>OTB data</title>
    </head>
    <body class='w-[100vw] bg-slate-300 p-2'>
        <div id='load' class='w-screen h-screen absolute z-40 flex justify-center items-center' >
            <div id='loadscreen' class='h-full w-full absolute bg-slate-400' ></div>
            <div class='loading2' ></div>
        </div>
    <script type='module'>
        import {api_access2, api_access, getCustomDate, currentDate} from '../3.utility/index.js';
        import {result_check} from './gen.js';

        const start = performance.now();
        const body = document.querySelector('body');

        const [vc_down, vc_labor, p1_labor1, p1_labor2, p1_down, qc_down, qc_labor] = await Promise.all([
            api_access2('fetch_vc_down__cache','test','op_hist',''),
            api_access2('fetch_vc_labor__cache','test','op_hist',''),
            api_access2('fetch_p1_assy_labor1__cache','test','op_hist',''),
            api_access2('fetch_p1_assy_labor2__cache','test','op_hist',''),
            api_access2('fetch_p1_assy_down__cache','test','op_hist',''),
            api_access2('fetch_qc_down','test','op_hist',''),
            api_access2('fetch_qc_labor','test','op_hist',''),
        ])
        
        result_check([
            {data_array: vc_down, title:'vc down'},
            {data_array: vc_labor, title:'vc labor'},
            {data_array: p1_labor1, title:'data p1 labor part 1'},
            {data_array: p1_labor2, title:'data p1 labor part 2'},
            {data_array: p1_down, title:'data p1 down'},
            {data_array: qc_down, title:'data qc down'},
            {data_array: qc_labor, title:'data qc labor'},
        ]);
    
        /*
        const arrInp =[];
        for (let i=0; i<newLabor.length; i++) { 
            const a = newLabor[i];
            if (a.count === 1 ) {
                const dJig = mstr.find(item => item.item_jig === a.jig);
                const basicDt = {
                    ...a,
                    desc_jig: dJig.desc_jig,
                    data_date: currentDate('-'),
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
                            id_trans: '',
                            data_date: currentDate('-')
                        }
                        arrInp.push(data);
                    }
                }
            }
        }
        result_check([
            {data_array: arrInp, title:'data akhir utk masuk ke database'},
        ]);

    /*===================================================================
    load data to databases
    ===================================================================
        const check_last = await api_access2('fetch', 'jig_db', 'jig_usg', {data_date:currentDate("-")});
        console.log({check_last});
        if(check_last.length===0 && arrInp.length > 0) {
            const result = await api_access('insert','jig_usg', arrInp);
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
        } else {
            const h1 = document.createElement('h1');
            h1.setAttribute('class', 'text-xl font-bold');
            h1.textContent = `data sudah ada`;
            body.appendChild(h1);
        }
        /*
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.json_to_sheet(newLabor);
            const worksheet2 = XLSX.utils.json_to_sheet(arrInp);
            XLSX.utils.book_append_sheet(workbook, worksheet, 'new labor');
            XLSX.utils.book_append_sheet(workbook, worksheet2, 'array final');
            XLSX.writeFile(workbook, 'db_jig_Total.xlsx')
        */
        const load = document.querySelector('#load');
        load.classList.add('hidden');
    </script>
    <script src='../1.asset/external_library/sheetjs/xlsx.full.min.js'></script>
    </body>
    </html>
    