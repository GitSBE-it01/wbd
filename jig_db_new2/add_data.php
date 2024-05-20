<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = explode("/",$currentURL);
  header(`location: http://$url[2]/sbe/index.php?cek=no`);
  exit(0);
}

require_once './backend/data_access/cek_role.php';
$user_log = strtoupper($_SESSION["username"]);
$prog = 'jig_db';
$role = cekUser($user_log, $prog);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css_fix/animation.css">
    <link rel="stylesheet" href="../assets/css_fix/symbol.css">
    <link rel="stylesheet" href="../assets/css_fix/default.css">
    <title>Add New Data</title>
</head>
<body>
<body>
<input type="hidden" id='role' value='<?php echo $role;?>'>
<div id='root' style='display: flex; flex-direction: row;'>
    <div class='loading'></div>
</div>
<script type='module'>
    const initPage = performance.now();
    import {
        create,
        loading, sideNav, addDataNav, formJigMstr,//cluster
        active, //style
    } from './component/index.js';
    import {
        jsonToCsv, currentDate, activeLink2,// proses
        // class
    } from './utility/index.js';

    const root = document.querySelector('#root');
    await sideNav();
    activeLink2('#side', active);
    root.removeChild(document.querySelector('.loading'));
    create({
        element: 'div',
        selector: '#root',
        id: 'main',
        style: `
            width: 86vw;
            height: 100vh;
            flex-direction: column;
            justify-content: flex-start;
            align-items: left;
        `
    })
    addDataNav();
    formJigMstr();




    
</script>
<script src="./utility/utility.js"></script>
</body>
</html>