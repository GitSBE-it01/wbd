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
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/search_btn.css">
    <title>Document</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root'></div>


<script type='module'>
    import {asset} from './middleware/js/class.js';
    import {createTable} from './component/table.js';
    
    const src2 = await asset.getData();
    console.log(src2);

    const tblStyle = {
        contStyle: [],
        thdStyle:[],
        trowStyle:[],
        tdtStyle:[],
        selStyle:[],
        btnStyle:[],
    }

    const tblData = [
        {
            header:'no asset',
            db_field:'assetno',
            dt_type:'text',
            mark:'assetno',
            param:''
        },
        {
            header:'asset description',
            db_field:'assetname',
            dt_type:'text',
            mark:'assetno',
            param:''
        },
        {
            header:'test',
            db_field:'',
            dt_type:'select',
            mark:'assetno',
            param:["-choose-",'yes','no']
        },
        {
            header:'test2',
            db_field:'test',
            dt_type:'button',
            mark:'assetno',
            param:'submit'
        },
        {
            header:'test3',
            db_field:'byusername',
            dt_type:'hidden',
            mark:'assetno',
            param:''
        },
        {
            header:'test4',
            db_field:'hidDiv',
            dt_type:'hidDiv',
            mark:'assetno',
            param:''
        },        
        {
            header:'test5',
            db_field:'location',
            dt_type:'input',
            mark:'assetno',
            param:'list_test'
        }
    ]
        console.log(tblData);
    createTable('root','test1',src2,tblStyle, tblData);
    

</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>