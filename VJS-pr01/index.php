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
<div class="grid" id='root'>
</div>
<script type="module">
// navbar
import { createNavbar } from './component/navbar.js';
await createNavbar('root');

// input utk search pilih asset mesin
import { search } from './component/search.js';
await search('root');

import { dmcHeader } from './component/dmc.js';
import { tableHeader } from './component/table.js';
const showBtn = document.getElementById('show');
showBtn.addEventListener("click", async function() {
    await dmcHeader('root');
    const arrHead = ['inspection','standard','unit','checklist'];
    await tableHeader('detailDiv','dmcHead', arrHead);
})

</script>
</body>
</html>