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
    import { tHeader, tblData } from './component/table.js';
    import { loading, init } from './component/load.js';

    init('root', 'navBar', 'sl9', 'sl2');
    const main = document.getElementById('main');
    const arrHeader = ['routing code SBE4', 'routing code new', 'desc SBE4', 'WIP old', 'wc old', 'ops old', 'ops old desc', 'WIP new', 'wc new', 'ops new', 'ops new desc'];
    const arrDat = ['code_old','code_new','desc_sbe4','wip_old','wc_old','ops_old','ops_old_desc','wip_new','wc_new','ops_new','ops_new_desc'];
    const trClass = ['fr', 'th', 'fc-w', 'sl8', 'bd-black', 'ht1', 'st'];
    const trClass2 = ['fr', 'tr'];
    const thClass = ['flexCh', 'alg-mid', 'bd-black', 'upper', 'sl4', 'fc-w', 'mh1'];
    const tdClass = ['flexCh', 'ph1', 'bd-black', 'sl8'];
    const inpClass = ['input1', 'm1'];
    await tHeader('main', 'dataMain', arrHeader, trClass, thClass);

    import { dataTable } from './component/data.js';
    main.appendChild(loading('loading1', 'loading'));
    const src = await dataTable();

    await tblData('dataMain', src, arrDat,trClass2, tdClass, inpClass);
    main.removeChild(document.getElementById('loading1'));

</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>