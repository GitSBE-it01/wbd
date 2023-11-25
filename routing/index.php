<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/layout2.css">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/color.css">
    <link rel="stylesheet" href="../assets/css/table2.css">
    <link rel="stylesheet" href="../assets/css/search_btn.css">
    <title>Document</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root'></div>

<script type='module'>
    const root = document.getElementById('root');
    const role = document.getElementById('role');

    import { item_number, new_routing, old_routing } from './middleware/js/class.js';
    import { tHeader2, tblAll } from './component/table.js';
    import { loading, init } from './component/load.js';

    init('root', 'navBar', 'sl9', 'sl2');
    const main = document.getElementById('main');
    await tHeader2();
    await tblAll();

    import { dataTable } from './component/data.js';


</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>