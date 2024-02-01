<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/layout_fix.css">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/color.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/search_btn.css">
    <title>Document</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root' class='container'></div>
<!--
<div id='root' class="container tl8">
    <div id='navbar' class= 'navCard tl1'>


    </div>
</div>
-->

<script type='module'>
    /*
    *navigation bar :
        home 
        insert category
        history
        back to main menu
    
    * search no asset utk di input VJS - DMC nya

    *  jika blum ada data inputan di DMC di hari tersebut utk asset tersebut. maka akan membuat DMC baru
        jika sudah maka di munculkan DMC dan resultnya 

    *   sesudah DMC selesai maka muncul VJS data 
    *   data vjs bisa ditambah terus dan keluar semua data dalam sehari itu 

    */
    import {init, createNavbar, createSearch} from './component/index.js';
    init('root', 'navBar', 'tl8', 'tl2');
    createNavbar(
        'navBar',
        [
            {
                link: '../../sbe/index.php',
                type: 'btn', // if btn then create a button, if txt then create span
                text: '', //if btn then empty
                divStyle:['mx5', 'mt2', 'scale-120'],
                linkStyle: ['home']
            },
            {
                link: 'index.php',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'home',
                divStyle:['ml5','mt3', 'scale-120'],
                linkStyle: ['f-tl7', 'fs-m', 'fw-blk']
            },
        ]
    );
   

</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>