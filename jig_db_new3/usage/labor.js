import {labor_log, jig_function_query, jig_trans} from '../class.js';


const start = performance.now();
const labor = await labor_log.getData(); // labor
const trans = await jig_trans.getData(); // trans
const func = await jig_function_query.getData();
console.log({ labor, trans, func});

const listJig = {};

func.forEach(fn=> {
if(listJig[fn.item_type]) {
    listJig[fn.item_type].push(fn.item_jig);
} else {
    listJig[fn.item_type] = [fn.item_jig];
}
})

console.log(listJig);
const newLabor = [];
const fnKey = Object.keys(listJig);
labor.forEach(lb=> {
if(fnKey.includes(lb.item)) {
    listJig[lb.item].forEach(ls => {
        const data = {
            ...lb,
            jig: ls
        }
        newLabor.push(data);
    })
}
})
console.log(newLabor)

const jigUsage = new Map();

newLabor.forEach(nl => {
const filter = nl.jig +"///"+ nl.eff_date;
if(jigUsage.has(filter)) {
    const exst = jigUsage.get(filter);
    exst.qty_total += parseInt(nl.qty_total);
} else {
    const data = {
        jig: nl.jig,
        date: nl.eff_date,
        qty_total: nl.qty_total
    }
    jigUsage.set(filter, data);
}
})
const result = Array.from(jigUsage.values());
console.log(result);



const workbook = XLSX.utils.book_new();
const worksheet = XLSX.utils.json_to_sheet(result);
XLSX.utils.book_append_sheet(workbook, worksheet, 'master');
XLSX.writeFile(workbook, 'db_jig_Total.xlsx')


/*const inpArr = {
jig_code: [],
tr_date: [],
qty_jig: [],
item_jig: [],
}

cek.forEach(ck => {
inpArr['jig_code'].push(ck.code)
inpArr['tr_date'].push(ck.start_date)
inpArr['qty_jig'].push(ck.qty)
inpArr['item_jig'].push(ck.item_jig)
})

console.log(inpArr);
//const result = await jig_usage.insertData(inpArr);
//console.log(result);
;*/
const end = performance.now();
const totalTime = end - start;
console.log('total time = ' + totalTime);