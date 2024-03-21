<?php 
require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update record</title>
    <link rel="stylesheet" href="../../assets/css/layout.css">
    <link rel="stylesheet" href="../../assets/css/animation.css">
    <link rel="stylesheet" href="../../assets/css/font.css">
    <link rel="stylesheet" href="../../assets/css/color.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
    <link rel="stylesheet" href="../../assets/css/search_btn.css">
</head>
<body>   
<div id="root" class='sl9'>
</div>
<script type='module'>
    import {ng_daily, jig_function_query, emp_code, jig_trans, jig_master_query, jig_usage} from '../class.js';
    import {currentDate, yesterdayDate} from '../process.js';

    const root = document.getElementById('root');
    const h1 = document.createElement('h1');
    root.appendChild(h1);
const start = performance.now();
const otb = await ng_daily.fetchDataFilter({op_tran_date:yesterdayDate()}); // labor
const trans = await jig_trans.fetchDataFilter({start_date:yesterdayDate()}); 
const trans2 = await jig_trans.fetchDataFilter({end_date:yesterdayDate()}); 
const emp = await emp_code.getData(); 
const func = await jig_function_query.getData();
const mstr = await jig_master_query.getData();
trans2.forEach(dt=>{
    trans.push(dt);
})
console.log({ trans, func, otb, emp, mstr});

const codeEmp = {};
emp.forEach(em=> {
    if(!codeEmp[em.emp_code]) {
        codeEmp[em.emp_code] = em.loc_name;
    }
})

console.log('codeEmp');
console.log(codeEmp);

const newOTB = new Map();
otb.forEach(tr=> {
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
console.log('labor2 summary per operation per date qty run ');
console.log(labor2);

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
console.log('labor4 ignoring operation pick the biggest qty run total');
console.log(labor4);


const listJig = {};
func.forEach(fn=> {
    if(listJig[fn.item_type]) {
        listJig[fn.item_type].push(fn.item_jig);
    } else {
        listJig[fn.item_type] = [fn.item_jig];
    }
})
console.log('listJig');
console.log(listJig);
const newLabor = [];
const fnKey = Object.keys(listJig);

const cekDt = [];
trans.forEach(tr=> {
    const yearStart = tr.start_date.split("-");
    let yearEnd = [];
    if (tr.end_date !== null) {
        yearEnd = tr.end_date.split("-");
    }
    if(yearStart[0] === '2024') {
        const data = {
            tr_date: tr.start_date,
            jig: tr.item_jig,
            code: tr.code,
            cat: 'a.pinjam',
            loc: tr.loc,
            qty_pinjam: tr.qty,
            wo_id: '',
            type: '',
            qty_total: ''
        }
        newLabor.push(data);
    } 
    
    if(yearStart[0] !== '2024' && yearEnd[0] === '2024') {
        const data = {
            tr_date: '2024-01-01',
            jig: tr.item_jig,
            code: tr.code,
            cat: 'a.pinjam',
            loc: tr.loc,
            qty_pinjam: tr.qty,
            wo_id: '',
            type: '',
            qty_total: ''
        }
        newLabor.push(data);
    }  

    if(yearStart[0] !== '2024' && yearEnd[0] === null) {
        const data = {
            tr_date: '2024-01-01',
            jig: tr.item_jig,
            code: tr.code,
            cat: 'a.pinjam',
            loc: tr.loc,
            qty_pinjam: tr.qty,
            wo_id: '',
            type: '',
            qty_total: ''
        }
        newLabor.push(data);
    } 
    
    if(yearEnd[0] === '2024' ) {
        const data = {
            tr_date: tr.end_date,
            jig: tr.item_jig,
            code: tr.code,
            cat: 'c.kembali',
            loc: tr.loc,
            qty_pinjam: tr.qty,
            wo_id: '',
            type: '',
            qty_total: ''
        }
        newLabor.push(data);
    }
})


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
            }
            newLabor.push(data);
        })
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

for (let i=0; i<newLabor.length; i++) {
    const a = newLabor[i];
    const codeFilter = a.jig + a.loc;
    a.count = 0;
    a.codeCount = 0;
    a.qty_jig = 0;
    a.qty_usage = 0;
    a.codeAll = '';
    
    let ii = i-1;
    const b = newLabor[ii];
    let codeFilter2 = '';
    if(b) {
        codeFilter2 = b.jig + b.loc;
    }
    if( codeFilter2 ) {
        if(a.cat === 'a.pinjam') { 
            a.count = 1;
            if ( codeFilter === codeFilter2) {
                a.codeAll = b.codeAll + a.code;
                a.codeCount += 1 + b.codeCount;
                a.qty_jig = parseFloat(a.qty_pinjam) + parseFloat(b.qty_jig);  
            } else {
                a.codeAll = a.code ;
                a.codeCount += 1 ;
                a.qty_jig = parseFloat(a.qty_pinjam);  
            }
        }
        if(a.cat === 'c.kembali') { 
            a.count = 1;
            if ( codeFilter === codeFilter2) {
                a.codeAll = b.codeAll.replace((`${a.code}`),'');
                a.codeCount = b.codeCount - 1;
                a.qty_jig = parseFloat(b.qty_jig) - parseFloat(a.qty_pinjam); 
            } else {
                a.codeCount = 0 ;
                a.codeAll = '';
                a.qty_jig = 0; 
            }
        } 
        if(a.cat === 'b.use') { 
            if ( codeFilter === codeFilter2) {
                if (b.codeCount === 0) { a.count = 0;} else {a.count = b.count;}
                a.codeCount = b.codeCount;
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
newLabor.sort((a,b) => {
    if (a.jig < b.jig) return -1;
    if (a.jig > b.jig) return 1;
    if (a.loc !== b.loc) return a.loc.localeCompare(b.loc);
    if (a.tr_date !== b.tr_date) return a.tr_date.localeCompare(b.tr_date);
    if (a.cat !== b.cat) return a.cat.localeCompare(b.cat);
    return 0; // objects are equal
})

const arrInp =[];
for (let i=0; i<newLabor.length; i++) { 
    const a = newLabor[i];
    if (a.count === 1 ) {
        const dJig = mstr.find(item => item.item_jig === a.jig);
        const basicDt = {
            ...a,
            desc_jig: dJig.desc_jig
        }
        arrInp.push(basicDt);
        if (a.cat === 'b.use') {
        for (let i2=1; i2<a.codeCount; i2++) {
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
                count: a.count,
                codeCount: a.codeCount,
                qty_jig: a.qty_jig,
                qty_usage: a.qty_usage,
                codeAll: a.codeAll,
            }
            arrInp.push(data);
        }}
    }
}

const arrInpFix = {
    tr_date: [],
    jig: [],
    desc_jig: [],
    code: [],
    cat: [],
    loc: [],
    qty_pinjam: [],
    wo_id: [],
    type: [],
    qty_total: [],
    count_dt: [],
    code_count: [],
    qty_jig: [],
    qty_usage: [],
    codeAll: [],
}
arrInp.forEach(dt => {
    arrInpFix['tr_date'].push(dt.tr_date);
    arrInpFix['jig'].push(dt.jig);
    arrInpFix['desc_jig'].push(dt.desc_jig);
    arrInpFix['code'].push(dt.code);
    arrInpFix['cat'].push(dt.cat);
    arrInpFix['loc'].push(dt.loc);
    arrInpFix['qty_pinjam'].push(dt.qty_pinjam);
    arrInpFix['wo_id'].push(dt.wo_id);
    arrInpFix['type'].push(dt.type);
    arrInpFix['qty_total'].push(dt.qty_total);
    arrInpFix['count_dt'].push(String(dt.count));
    arrInpFix['code_count'].push(String(dt.codeCount));
    arrInpFix['qty_jig'].push(dt.qty_jig);
    arrInpFix['qty_usage'].push(dt.qty_usage);
    arrInpFix['codeAll'].push(dt.codeAll);
})

console.log('array input : ');
console.log(arrInp);
console.log(arrInpFix);
const result = await jig_usage.insertData(arrInpFix);
const end = performance.now();
const totalTime = (end - start) /1000;
console.log('total time = ' + totalTime);

if(!result.includes('fail')) {
    h1.textContent = `${arrInp.length} data successfully inserted to database after ${totalTime} seconds`;
} else {
    h1.textContent = `something went wrong`;
    const p = document.createElement('p');
    p.innerHTML = `${result}`;
    root.appendChild(p);
}

/*
const workbook = XLSX.utils.book_new();
const worksheet = XLSX.utils.json_to_sheet(arrInp);
XLSX.utils.book_append_sheet(workbook, worksheet, 'labor');
XLSX.writeFile(workbook, 'db_jig_Total.xlsx')
*/


</script>
<script src="../../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>
