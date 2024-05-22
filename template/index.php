<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = explode("/",$currentURL);
  header(`location: http://$url[2]/sbe/index.php?cek=no`);
  exit(0);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/symbol.css">
    <title>pick now</title>
</head>
<body>
<div id='root' class='container'>

</div>



<script type='module'>
import {navbar} from './assets/index.js';

const testArr = [
    {text: 'test1', link:'#section1'},
    {text: 'test2', link:'#section2'},
    {text: 'test3', link:'#section3'},
]
await navbar('root', 'mainBar', testArr);


</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>