<?php 
require_once "api.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jig Database</title>
    <link rel="stylesheet" href="assets/CSS/main.css">
	<link rel="stylesheet" href="assets/CSS/add_data.css">
	<link rel="stylesheet" href="assets/CSS/update.css">
</head>
<body>
<input type=hidden id='role' value="<?php if (isset($role)) {echo $role;} else {echo 'guest';}?>">
<div class="container">
	<div class="sidebar">
		<div class="nav-menu">
				<div class="nav_li active"><a href="index.php"><span class="nav-text active">Home</span></a></div>
				<?php if ($role === 'admin' || $role === 'superuser')  {?>
				<div class="nav_li"><a href="update/"><span class="nav-text">Update Data & Stock</span></a></div>
				<?php } ?>
				<div class="nav_li"><a href="transaksi/"><span class="nav-text">Transaction</span></a></div>
				<?php if ($role === 'admin' || $role === 'superuser')  {?>
				<div class="nav_li"><a href="add_data/"><span class="nav-text">Add New</span></a></div>
				<?php } ?>
				<?php if ($role === 'superuser')  {?>
				<div class="nav_li"><a href="user/"><span class="nav-text">User</span></a></div>
            <?php } ?>
		</div>
		<div class="btm-menu">
			<div class='nav_li'><a href="../../sbe/index.php?cek=no"><span class="nav-text">Main Menu</span></a></div>
		</div>
	</div>

	<div class="main">
		<div class="top">
			<div class='card_contain2'>	
				<button class="btn_Switch actOn" id="switchJig" type="button">
					Detail Jig Search
				</button>	
				<button class="btn_Switch" id="switchType" type="button">
					Detail Speaker  Search
				</button>	
			</div>	
			<div class='card_contain2'>	
				<div class='side hideOff active' id='jigHeader'>
					<input type="text" id="filter" class="inputinfo" placeholder="input item number or description jig" autocomplete="off" onkeydown="enterProcess(event, 'searchJig')">
					<button class="button-30" id="searchJig" type="button">
						search
					</button>
					<button type='button' id='download_xls1' class="button-30">
						dl excel
					</button>	
				</div>
				<div class='side hideOn' id='typeHeader'>
					<input type="text" id="filter2" class="inputinfo" placeholder="input item number or description speaker" autocomplete="off" onkeydown="enterProcess(event, 'searchType')">
					<!--<button class="button-30" type="button" id="addFilterType">
						add filter
					</button>-->
					<button class="button-30" id="searchType" type="button">
						search
					</button>	
					<button type='button' id='download_xls2' class="button-30">
						dl excel
					</button>
				</div>
			</div>

		</div>
		<div class="middle" > 
			<div class="loading" id="loading" style="display:none;">Loading . . .</div>
			<div class="addform hidden_add active" id="tableResult">
			</div>
			<div class="addform hidden_add" id="typeResult">
			</div>
		</div>
	</div>
</div>

<script src="assets/JS/main.js"></script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script src="index.js"></script>
</body>
</html>
