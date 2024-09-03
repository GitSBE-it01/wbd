<?php 
require_once "../config.php";
require_once "../queryList.php";
require_once "../api.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Detail record</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <link rel="stylesheet" href="../assets/CSS/add_data.css">
    <link rel="stylesheet" href="../assets/CSS/update.css">
</head>
<body>
<div class="container">
	<div class="sidebar">
		<div class="nav-menu">
				<div class='nav_li'><a href="../index.php"><span class="nav-text">Home</span></a></div>
				<div class="nav_li active"><a href="index.php"><span class="nav-text active">Detail</span></a></div>
				<?php if ($role !== 'guest')  {?>
                <div class='nav_li'><a href="../update"><span class="nav-text">Update Data</span></a></div>
				<?php } ?>
				<div class='nav_li'><a href="../transaksi/"><span class="nav-text">Transaksi</span></a></div>
                <?php if ($role === 'admin' || $role === 'superuser')  {?>
				<div class='nav_li'><a href="../add_data/"><span class="nav-text">Tambah Data</span></a></div>
				<?php } ?>
                <?php if ($role === 'superuser')  {?>
                    <div class="nav_li"><a href="../user/"><span class="nav-text">User</span></a></div>
                <?php } ?>
                </div>
		</div>
		<div class="btm-menu">
            <div class='nav_li'><a href="../../../sbe/index.php?cek=no"><span class="nav-text">Main Menu</span></a></div>
		</div>
	</div>

    <div class="main">
        <div class="top">
            <h2>Search Data</h2>
                <select name="" id="">
                    <option value="">Filter</option>
                </select>
                <input type="text" class="" name="jig" placeholder="jig" id="jig" list="filter" autocomplete="off">
                    <datalist id="filter">
                            <option value="- Choose -" selected></option>
                    </datalist>
                <div>
                <button class="button-30" type="button" id="get_data">
                    search
                </button>
                <button class="button-30" type="button" id="add">
                    add filter
                </button>
                </div>
		</div>
        
        <div class="middle"> 
            <div class="loading" id="loading" style="display:none;">Loading . . .</div>
            <div id="resultTable" style="display:none;"></div>
		</div>
    </div>
</div>
<script src="../assets/JS/main.js"></script>
<script src="api.js"></script>
</body>
</html>
