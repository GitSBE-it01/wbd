<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css_fix/animation.css">
    <link rel="stylesheet" href="../assets/css_fix/color.css">
    <link rel="stylesheet" href="../assets/css_fix/font.css">
    <link rel="stylesheet" href="../assets/css_fix/layout.css">
    <link rel="stylesheet" href="../assets/css_fix/symbol.css">
    <title>pick now</title>
</head>
<body>
<div id='root' class='container bl8'></div>
<script type='module'>
    import {currentDate, debug } from '/wbd/utilities/index.js';
    import { Data } from  '/wbd/utilities/class.js';

    const start = performance.now();
    const start1 = performance.now();
    const loc = new Data('dbqad_live','loc_mstr');
    const whLoc = await loc.fetch('', 'pick_now');
    console.log('lokasi list');
    console.log(whLoc);
    const end1 = performance.now();
    const totalTime1 = (end1 - start1) /1000;
    console.log('total time1 = ' + totalTime1);
</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>