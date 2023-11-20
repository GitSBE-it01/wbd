<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/color.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/search_btn.css">
    <title>Document</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root'></div>

<script type='module'>
    import { routing_ori, routing_alter } from './middleware/js/class.js';
    const data = await routing_ori.getData();
    const data2 = await routing_alter.getData();
    console.log({data, data2});
</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>