<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/backend/index.php'; 

session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  //redirect ke halaman login sbe
  $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = explode("/",$currentURL);
  header(`location: http://$url[2]/sbe/index.php?cek=no`);
  exit(0);
}

$user_log = strtoupper($_SESSION["username"]);
$prog = 'vjs_dmc';
$db = 'dbvjs';
$role = cekUser($db,$user_log, $prog);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css_fix/animation.css">
    <link rel="stylesheet" href="../assets/css_fix/color.css">
    <link rel="stylesheet" href="../assets/css_fix/font.css">
    <link rel="stylesheet" href="../assets/css_fix/layout.css">
    <link rel="stylesheet" href="../assets/css_fix/symbol.css">
    <title>pick now</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root' class='container bl8'></div>
<script type='module'>
    import {currentDate, debug } from '/wbd/utilities/index.js';
    import { Data } from  '/wbd/utilities/class.js';

    const start = performance.now();
    const start1 = performance.now();
    const loc = new Data('dbqad_live','loc_mstr');
    const whLoc = await loc.fetch();
    console.log('lokasi list');
    console.log(whLoc['response']);
    const end1 = performance.now();
    const totalTime1 = (end1 - start1) /1000;
    console.log('total time1 = ' + totalTime1);
    
    /*
    const start2 = performance.now()
    const wobb = new Data('dbqad_live','wod_det');
    const wobbR = await wobb.fetch();
    console.log('wo bill');
    console.log(wobbR['response']);
    const end2 = performance.now();
    const totalTime2 = (end2 - start2) /1000;
    console.log('total time1 = ' + totalTime2);
    
    const start3 = performance.now()
    const inv = new Data('dbqad_live','ld_det');
    const oh = await inv.fetch();
    console.log('data inventory');
    console.log(oh['response']);
    const end3 = performance.now();
    const totalTime3 = (end3 - start3) /3000;
    console.log('total time3 = ' + totalTime3);
    
    const start4 = performance.now()
    const wo = new Data('dbqad_live','wo_mstr');
    const woR = await wo.fetch({wo_status: "R"});
    console.log('data wo master');
    console.log(woR['response']);
    const end4 = performance.now();
    const totalTime4 = (end4 - start4) /1000;
    console.log('total time4 = ' + totalTime4);

    const start5 = performance.now()
    const routing = new Data('dbqad_live','ro_det');
    const rout = await routing.fetch();
    console.log('data wo master');
    console.log(rout['response']);
    const end5 = performance.now();
    const totalTime5 = (end5 - start5) /1000;
    console.log('total time5 = ' + totalTime5);

    let ohDept = [];
    oh['response'].forEach(dt =>{
      const dept = whLoc['response'].find(obj => obj.loc_loc === dt.ld_loc);
      const dataInp = {...dt, ...dept}
      ohDept.push(dataInp)
    })

    const ohDeptFix = new Map();
    ohDept.forEach(dt =>{
      const filter = dt.loc_department + dt.ld_part + dt.ld_loc;
      if(ohDeptFix.has(filter)) {
        const exst = ohDeptFix.get(filter);
        exst.ld_qty_oh += parseFloat(dt.ld_qty_oh);
      } else {
        const data = {
          dept: dt.loc_department,
          item: dt.ld_part,
          lot: dt.ld_lot,
          qtyOh: parseFloat(dt.ld_qty_oh),
          loc: dt.ld_loc
        }
        ohDeptFix.set(filter, data);
        }
    })
    const final = Array.from(ohDeptFix.values());
    console.log('on hand per dept per item');
    console.log(final);

    let demand = [];
    wobbR['response'].forEach(dt =>{
      const detail = woR['response'].filter(obj => obj.wo_lot === dt.wod_lot);
      if(detail.length > 1) {
      }
      if(detail.length>0) {
        const data = {
          id: detail[0].wo_lot,
          item: detail[0].wo_part,
          qty_ord: parseFloat(detail[0].wo_qty_ord),
          rel_date: detail[0].wo_rel_date,
          due_date: detail[0].wo_due_date,
          status: detail[0].wo_status,
          part: dt.wod_part,
          qty_req: parseFloat(dt.wod_qty_req)
        }
        demand.push(data);
      }
    })
    console.log('wo bill for status R WO only')
    console.log(demand);

    
    demand.forEach(dt=> {
      const rt = rout['response'].filter(obj=>obj.ro_routing === dt.item);
      
    })

    const end = performance.now();
    const totalTime = (end - start) /1000;
    console.log('total time = ' + totalTime);
    const root = document.getElementById('root');


    /*
    const start5 = performance.now();
    const woComp = [];
    woR['response'].forEach(wo => {
        const mtch = wobbR['response'].find(obj2 => obj2.wod_lot === wo.wo_lot); 
        if (mtch) { 
            const all = { ...wo, ...mtch };
            woComp.push(all);
        }
    });
    console.log('data combine');
    console.log(woComp);
    const end5 = performance.now();
    const totalTime5 = (end5 - start5) /1000;
    console.log('total time5 = ' + totalTime5);



const workbook = XLSX.utils.book_new();
const worksheet1 = XLSX.utils.json_to_sheet(whLoc['response']);
//const worksheet2 = XLSX.utils.json_to_sheet(wobbR['response']);
//const worksheet3 = XLSX.utils.json_to_sheet(woComp);
XLSX.utils.book_append_sheet(workbook, worksheet1, 'loc');
//XLSX.utils.book_append_sheet(workbook, worksheet2, 'wobb');
//XLSX.utils.book_append_sheet(workbook, worksheet3, 'wo comb');
XLSX.writeFile(workbook, 'db_jig_Total.xlsx');
*/


</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>