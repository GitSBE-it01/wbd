<?php 
require_once "config.php";
// utk proses kebanyakan dilakukan di javascript, index.php hanya membuat HTML utk wadah dari proses di javascript
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<link rel="stylesheet" href="CSS/main.css">-->
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/color.css">
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
    <!--<div class='navCard navbar tl2 mh4'>
        <div class='navli'>
            <a href="../../sbe/index.php">
                <button type='button' class='home'></button>
            </a>
        </div>
        <div class='navli'><a class="fc-w" href="index.php">Home</a></div>
        <div class='navli'><a class="fc-w" href="insert_cat.php">Insert category</a></div>
    </div>
    <div class="main mt4">
        <div class='blockA columnView'>
            <div class="loading2" id="loading1"></div>
            <input type="text" id='assetPick' class="hideOn" list='assets' placeholder='choose asset' autocomplete="off">
                <datalist id='assets'>
                </datalist>
            <button type="button" class="hideOn" id="show">submit</button>
        </div>
        <div class="loading2 hideOn" id="loading3"></div>
        <div class="hideOn container3" id='DMCresult'>
        </div>
        <div class="hideOn container3" id="VJSresult">
        </div>

  </div>

<datalist id='idWO'>
</datalist>
<datalist id='dmcOption'>
    <option value="OK"></option>
    <option value="NG"></option>
</datalist>
<datalist id='listInspect'>
</datalist>

</div>
<script type="module" src="process.js"></script>
<script type="module" src="class.js"></script>
<script type="module" src="index.js"></script>-->
</body>
</html>