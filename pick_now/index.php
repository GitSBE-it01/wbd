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

    /*
    const start = performance.now();
    const start1 = performance.now();
    const loc = new Data('dbqad_live','loc_mstr');
    const whLoc = await loc.fetch();
    console.log(whLoc['response']);
    const end1 = performance.now();
    const totalTime1 = (end1 - start1) /1000;
    console.log('total time1 = ' + totalTime1);
    
    const start2 = performance.now()
    const wobb = new Data('dbqad_live','wod_det');
    const wobbR = await wobb.fetch();
    console.log(wobbR['response']);
    const end2 = performance.now();
    const totalTime2 = (end2 - start2) /1000;
    console.log('total time1 = ' + totalTime2);
    
    const start3 = performance.now()
    const inv = new Data('dbqad_live','ld_det');
    const oh = await inv.fetch();
    console.log(oh['response']);
    const end3 = performance.now();
    const totalTime3 = (end3 - start3) /3000;
    console.log('total time3 = ' + totalTime3);
    */
    
    const start4 = performance.now()
    const wo = new Data('dbqad_live','wo_mstr');
    const woR = await wo.fetch({wo_status: "R"});
    console.log(woR['response']);
    const end4 = performance.now();
    const totalTime4 = (end4 - start4) /1000;
    console.log('total time4 = ' + totalTime4);
    
    // const end = performance.now();
    // const totalTime = (end - start) /1000;
    // console.log('total time = ' + totalTime);
    const root = document.getElementById('root');




</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>