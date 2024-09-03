<?php 
require_once "../config.php";
require_once "query_update.php";
require_once "../queryList.php";
require_once "../api.php";
$cacheFolder = CACHE . 'update/';

$status = isset($_GET['status']) ? $_GET['status'] : '';
if ($status === 'success') {
    $message = 'Data successfully updated';
    echo $message;
} else {
    $message = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Update record</title>
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
<?php if ($role === 'admin' || $role === 'superuser')  {?>
<div class="fr">
	<div class="sideCard" id='side'>
	</div>

    <div class="main">
        <h2 class='topTitle'>Update Data</h2>
        <div class="middle2 main_contain"> 
            <div class='card_contain'>
            <button id="switchStock" class="switch btn_active">
                    Update Stock 
                </button>
                <button id="switchDetail" class="switch">
                    Update Jig Data
                </button>
                <button id="switchType" class="switch">
                    Update Type List
                </button>
            </div>
            <!--
                for updating stock OH and location
                -->
                <div id="location" style="display:block;">
                <form method="POST" class='card_contain'>
                    <div class="side card_contain2"> 
                        <div class="card1"><label>item jig </label></div>
                        <input type="text" class="card2" name="loc" placeholder="--  choose jig  --" id="loc" list="jig_suggest" autocomplete="off">
                            <datalist id="suggestLoc">
                                    <option value="- Choose -" selected></option>
                            </datalist>
                        <button class="card1" type="button" id="btnLoc">
                            search
                        </button>
                    </div>
                        <div class="loading" id="loading2" style="display:none;">
                            Loading . . .
                        </div>
                        <div id='locContain' class='card_contain2'>
                        </div>
                </form>
            </div>


            <!--
                for updating item detail
                -->
            <div id="dataJig" style="display:none;">
                <form method="POST" class='card_contain'>
                    <div class="side card_contain2">                      
                            <div class="card1"><label>item jig </label></div>
                            <input type="text" class="card2" name="item_jig" id="jig" placeholder="-- choose jig --" list="jig_suggest" autocomplete="off">
                        <button class="card1" type="button" id="btnJig">
                            search
                        </button>
                    </div>
                    <div class="loading" id="loading" style="display:none;">
                        Loading . . .
                    </div>
                    <div id='jigContain' class='card_contain2'>
                    </div>
                </form>
            </div>

            
            <!--
                for updating speaker usage
                -->
            <div id="type" style="display:none;">
                <form method="POST" class='card_contain'>
                    <div class="side card_contain2"> 
                        <div class="card1"><label>Speaker Type</label></div>
                        <input type="text" class="card2" name="item_type" placeholder="-- choose type --" id="typeSearch" list="suggestion"  autocomplete="off">
                            <datalist id="suggestion">
                                    <option value="- Choose -" selected></option>
                            </datalist>
                        <button class="card1" type="button" id="btnType">
                            search
                        </button>   
                    </div>
                    <div class="loading" id="loading3" style="display:none;">
                        Loading . . .
                    </div>
                    <div id='typeContain' class='card_contain2'>
                    </div>
                </form>
            </div>

		</div>
    </div>
</div>
<datalist id='dataLokasi'>
    <option value="-choose-"></option>
</datalist>
<datalist id='jig_suggest'>
    <option value="-choose-"></option>
</datalist>
<?php } else {
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/index.php");
    exit;}
    ?>
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
