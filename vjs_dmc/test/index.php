<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/layout_fix.css">
    <link rel="stylesheet" href="../../assets/css/animation.css">
    <link rel="stylesheet" href="../../assets/css/font.css">
    <link rel="stylesheet" href="../../assets/css/color.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
    <link rel="stylesheet" href="../../assets/css/search_btn.css">
    <title>Document</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root' class='container'></div>

<script type='module'>
    import {createNav, createSearch, createDatalist, loading, createTable, activeLink, createHeader, createBtn} from '../component/index.js';
    import {vjs_asset, dmc_vjs_log, bom} from '../middleware/js/class.js';
    import {splitCustomString, currentDate} from '../middleware/js/process.js';
const dataDMC = await dmc_vjs_log.getData();
console.log(dataDMC)

createTable(
        { // data table
            target:'root', 
            tblID: 'test', 
            dbsrc: dataDMC, 
            tblStyle: 
                {
                    contStyle: ['m4'],
                    thdStyle:['flex-r', 'fs-l', 'fw-blk', 'mb3', 'tl3', 'f-wht', 'p2'],
                    thrStyle:['f-child'],
                    trowStyle:['flex-r', 'px2'],
                    tdtStyle:['f-child', 'mb1'],
                    selStyle:['f-child', 'mb1'],
                    btnStyle:[],
                }, 
            tblData: 
                [
                    {
                        header:'deskripsi',
                        db_field:'inspection',
                        dt_type:'text',
                        mark:{
                            dbfield:'noAsset',
                            text:''
                        },
                        param:'',
                    },
                    {
                        header:'standard',
                        db_field:'std',
                        dt_type:'text',
                        mark:{
                            dbfield:'noAsset',
                            text:''
                        },
                        param:''
                    },
                    {
                        header:'unit',
                        db_field:'unit',
                        dt_type:'text',
                        mark:{
                            dbfield:'noAsset',
                            text:''
                        },
                        param:''
                    },
                    {
                        header:'OK / NG',
                        db_field:'',
                        dt_type:'select',
                        mark:{
                            dbfield:'noAsset',
                            text:'inputDt'
                        },
                        param:["-choose-",'OK','NG'] //isi dari option
                    }
                ]
        }
    );
</script>
</body>
</html>