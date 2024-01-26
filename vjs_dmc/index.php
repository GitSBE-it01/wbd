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
<div id='root'>
    <h1>HELLO WORLD</h1>
</div>

<script type='module'>
    init('sidebar')
    // navbar
    import { createNavbar } from './component/load.js';
    
    
    await createNavbar('root');

    // input utk search pilih asset mesin
    import { search } from './component/search.js';
    await search('root');

    import { tableHeader,  dmcHeader  } from './component/table.js';
    const showBtn = document.getElementById('show');
    showBtn.addEventListener("click", async function() {
        await dmcHeader('root');
        const arrHead = ['inspection','standard','unit','checklist'];
        await tableHeader('detailDiv','dmcHead', arrHead);
    })

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
    let parent =[];
    let child = [];
    let wip = [];
    let finishGood =[];

    dataDB.forEach((obj) => {
        if (!parent.includes(obj.parent)) {
            parent.push(obj.parent);
        }
        if (!child.includes(obj.child)) {
            child.push(obj.child);
        }
    })

    console.log({parent, child});
    
    parent.forEach((obj) => {
        if(!child.includes(obj)) {
            finishGood.push(obj);
        }
    })

    parent.forEach((obj)=> {
        if (!finishGood.includes(obj)){
            wip.push(obj);
        }
    })

    let BOM =[];
    parent.forEach((obj) => {
        if (!BOM[obj]) {
            BOM[obj] =[];
        }
        for (let i=0; i<dataDB.length; i++) {
            if(obj === dataDB[i].parent) {
                BOM[obj].push(dataDB[i].child);
            }
        }
    })

    console.log({BOM, wip, finishGood});

    const root = document.getElementById('root');

    parent.forEach((obj) => {
        const row = document.createElement('div');
        row.id = obj;
        row.classList.add('fr');

        const parentCol = document.createElement('div');
        parentCol.textContent = obj;
        parentCol.classList.add('sl9', 'cl2');
        row.appendChild(parentCol);
        
        const child1 = document.createElement('div');
        child1.classList.add('cl2', 'fc');
        row.appendChild(child1);
        
        const child1Dat = dataDB.filter((obj2) => obj2.parent === obj);
        child1Dat.forEach((obj3) => {
            const childData = document.createElement('div');
            childData.classList.add('tl9');
            childData.textContent = obj3.child;
            child1.appendChild(childData);
            const child2Dat = dataDB.filter((obj4) => obj4.parent === obj3);
            child2Dat.forEach((obj5)=> {
                const child2Data = document.createElement('div');
                child2Data.classList.add('tl9');
                child2Data.textContent = obj3.child;
                child1.appendChild(child2Data);
            })
        })      
        root.appendChild(row);
    })



</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>