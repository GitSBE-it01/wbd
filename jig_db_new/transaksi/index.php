<?php 
require_once "../config.php";
require_once "../queryList.php";
require_once "trans.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Transaksi record</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <link rel="stylesheet" href="../assets/CSS/add_data.css">
    <link rel="stylesheet" href="../assets/CSS/update.css">
    <link rel="stylesheet" href="../../assets/css/layout.css">
    <link rel="stylesheet" href="../../assets/css/animation.css">
    <link rel="stylesheet" href="../../assets/css/font.css">
    <link rel="stylesheet" href="../../assets/css/color.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
    <link rel="stylesheet" href="../../assets/css/search_btn.css">
</head>
<body>
<input type=hidden id='role' value="<?php if (isset($role)) {echo $role;} else {echo 'guest';}?>">
<div class="fr">
	<div class="sideCard" id='side'>
	</div>

    <div class="main">
        <div class="top">
            <h2>Transaksi Harian</h2>
            <div class="side hideOff aktif">
			    <input type="text" id="filterTrans" class="inputinfo" placeholder="jig" autocomplete="off" list='jig_name' onkeydown="enterProcess(event,'search')" autocomplete='off'>
                <button type='button' id='search' class='button-30'>search</button>
            </div>
            <datalist id='jig_name'>
                <option value="-choose-">-choose-</option>
            </datalist>
		</div>
        <div class="middle"> 
            <div class="loading" id="loading" style="display:none;"></div>
            <div id="display" style="display:none;"></div>
		</div>
    </div>
    <datalist id="locS">
        <option value="-choose-"></option>
    </datalist>
</div>

<script src="../assets/JS/main.js"></script>
<script src="index.js"></script>
<script type='module'>
    import { createSidebar, activeLink } from '../component/sidebar.js';
    createSidebar('side', 'sl1');
    document.addEventListener("DOMContentLoaded", function() {
        activeLink('a.link');
    });
</script>
</body>
</html>
