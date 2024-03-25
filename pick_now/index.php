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
<div id='root' class='container bl8'>

</div>
<script type='module'>
    import { Data } from  '/wbd/utility/class.js';
    const bom= new Data('db_jig','jig_master');
    const debug = document.createElement('p');
    debug.classList.add('px3')
    const root = document.getElementById('root');
    root.appendChild(debug);
    const bomDt = await bom.get({type:'YG', status:'active'});
    debug.innerHTML = JSON.stringify(bomDt);
</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>