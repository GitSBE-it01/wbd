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
    
<div id="root" class='sl9'>
</div>

<?php } else {
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/index.php");
    exit;}
?>
<script type='module'>
    /*
    ============================================================================
    display layout
    ============================================================================
    */
    // flex display div di root
    const root = document.getElementById('root');
    root.classList.add('fr')

    // create sidebar container div
    const side = document.createElement('div');
    side.classList.add('sideCard');
    side.id ="side";
    root.appendChild(side);
    // create main container div
    const main = document.createElement('div');
    main.classList.add('main');
    main.id ="main";
    root.appendChild(main);

    // role
    const role = document.getElementById('role');

    /*
    ============================================================================
    sidebar
    ============================================================================
    */
    // sidebar menu dan penanda link active di sidebar
    import { createSidebar, activeLink } from '../component/sidebar.js';
    createSidebar('side', 'sl1');
    document.addEventListener("DOMContentLoaded", function() {
        activeLink('a.link');
    });

    const title = document.createElement('div');
    title.textContent = "Update Data";
    title.classList.add('navCard', 'sl3', 'fc-w', 'fs-xl', 'pt1', 'pl3', 'fw-blk');
    main.appendChild(title);
    /*
    ============================================================================
    navbar
    ============================================================================
    */
    // navbar di main container utk unhide div dari jig database dan speaker database
    import { createNavbar } from '../component/navbar.js';
    main.appendChild(createNavbar(`
    <div class='navCard navbar sl4'>
        <div class='navli'>
            <button type="button" id="btnSec1">
                Update Stock
            </button>
        </div>
        <div class='navli'>
            <button type="button" id="btnSec2">
                Update Jig Data
            </button>
        </div>
        <div class='navli'>
            <button type="button" id="btnSec3">
                Update Type List
            </button>
        </div>
    </div>
    `));
    /*
    ============================================================================
    data section
    ============================================================================
    */
    import { search } from './component/search.js';
    await search('main', 'searchStock', 'btnStock', 'divStock');



</script>
<script type="module" src="component/stockUpdate.js"></script>
</body>
</html>
