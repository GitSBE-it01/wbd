<?php 
require_once "../config.php";
require_once "../queryList.php";
require_once "../api.php";
require_once "addUser.php";
$cacheFolder = CACHE . 'update/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>User</title>
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
<?php if ($role === 'superuser')  {?>
<div class="fr">
	<div class="sideCard" id='side'>
	</div>
    <div class='main'>
        <div class="loading" id="loading" style="display:none;">Loading . . .</div>
        <div class='card_contain2' id='user'></div>
    </div>
    <datalist id='userList'>
    </datalist>
    <datalist id='roleList'>
        <option value="observer">observer</option>
        <option value="admin">admin</option>
        <option value="superuser">superuser</option>
    </datalist>
    <datalist id='roleList2'>
        <option value="observer">observer</option>
        <option value="admin">admin</option>
        <option value="superuser">superuser</option>
        <option value="delete">delete</option>
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
    activeLink('[data-nav]');
</script>
</body>