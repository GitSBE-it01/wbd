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
    const src1 = [
        {header: 'item jig', 
            value:'item_jig', 
            typeData:'input', 
            list:'', 
            dataClass:['cl2','sl9'], 
            secondClass:['p4'], 
            headerClass:['cl2','sl1', 'fc-w']
        },
        {header: 'desc jig', 
            value:'desc_jig', 
            typeData:'text', 
            list:'', 
            dataClass:['cl2','sl9'], 
            secondClass:'', 
            headerClass:['cl2','sl3', 'fc-w']
        },
        {header: '' , 
            value:'type', 
            typeData:'hidden', 
            list:'', 
            dataClass:['cl2','sl9'], 
            secondClass:'', 
            headerClass:['cl2','sl5', 'fc-w']
        },
        {header: 'delete', 
            value:'delete', 
            typeData:'button', 
            list:'', 
            dataClass:['cl2','sl9'], 
            secondClass:'', 
            headerClass:['cl2','sl7', 'fc-w']
        }
    ]

    /*
    input : utk membuat data div dan input yg bisa terisi
    text : hanya div
    readonly : membuat div dan input yang readonly
    button : membuat button 
    hidden : membuat hidden input
    hidDiv : membuat hidden div
    */

    import { input,button,text,hidden,hidDiv,createTable,header,createTr } from './component/table.js';


    import {bom} from './middleware/js/class.js';
    const dataDB = await bom.getData();
    let dataChild = [];
    /*const data = dataDB.map((obj1) => {
        const isChildInParent = obj1.child.includes(obj1.parent);
        dataChild[obj1.parent] = [];
        if (!isChildInParent) {
            dataChild[obj1.parent].push(obj1.child);
        } else {
            const parentFilter = obj1.child;
            const data2 = dataDB.filter((obj2)=> { 
                return obj2.parent.includes(parentFilter);
            })
            data2.forEach((obj) => {
                dataChild[obj1.parent].push(obj.child);
            })
        }
        return {
            parent1: obj1.parent,
            children1: obj1.child,
        };
    });*/
    console.log(dataDB);
    dataChild['A'] = [];
    dataChild['B'] = [];
    dataChild['C'] = [];
    dataDB.forEach((obj) => {
        dataChild["A"].push(obj.parent);
        dataChild["B"].push(obj.child);

        console.log(obj.child.includes(obj.parent));
        if (!dataChild[obj.parent]) {
            dataChild[obj.parent] = [];
        } 
        
    })
    // createTable(src1, dataDB, 'item_jig', 'root', 'testTable');



</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>