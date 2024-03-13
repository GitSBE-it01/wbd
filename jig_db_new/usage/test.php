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
<input type=hidden id='role' value="<?php if (isset($role)) {echo $role;} else {echo 'guest';}?>">

<?php if ($role === 'admin' || $role === 'superuser')  {?>
    
<div id="root" class='sl9'>
</div>

<?php } else {
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/index.php");
    exit;}
?>
<script type='module'>
    import {ng_daily, labor_log, jig_function_query, jig_usage, jig_location_query, jig_trans} from '../class.js';
    import {currentDate} from '../process.js';

const start = performance.now();
const labor = await labor_log.getData();
const loc = await jig_function_query.getData();
const trans = await jig_trans.getData();
const use = await jig_usage.getData();
const func = await jig_function_query.getData();
console.log({labor, loc, trans, func, use});

const cek =[];
labor.forEach(obj1 => {
    const cek2 = func.filter(item => item.item_type === obj1.item);
    cek2.forEach(obj2 => {
        const result = {
            ...obj1,
            item_jig: obj2.item_jig
        }
        cek.push(result);
    })
})
console.log(cek);

const checker = new Map();
cek.forEach(item => {
    const filter = item.item_jig + item.eff_date;
    if (checker.has(filter)) {
        const exst = checker.get(filter);
        exst.qty_total += item.qty_total;
    } else {
        const newItm = {
            jig: item.item_jig,
            eff_date: item.eff_date,
            wo_id: item.wo_id,
            qty_total: item.qty_total
        }
        checker.set(filter, newItm);
    }
}) 
const last = Array.from(checker.values());
console.log(last);

const codeCek = [];

/*
const workbook = XLSX.utils.book_new();
const worksheet = XLSX.utils.json_to_sheet(last);
XLSX.utils.book_append_sheet(workbook, worksheet, 'master');
XLSX.writeFile(workbook, 'db_jig_download.xlsx')
*/

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
</script>
<script src="../../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>
