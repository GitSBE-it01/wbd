<?php 
require_once "config.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <link rel="stylesheet" href="../assets/css/color.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/search_btn.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <title>homepage DMC/VJS</title>
</head>
<body>
<div class="container" id='root'>
</div>
<script type="module">

// navbar
import { createNavbar } from './component/navbar.js';
createNavbar('root');

// input utk search pilih asset mesin
import { search } from './component/search.js';
search('root');

import { dmcData } from './component/dmc.js';
document.addEventListener('click', async function() {
    return dmcData('show','root');
})




</script>
</body>
</html>