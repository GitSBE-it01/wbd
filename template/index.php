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
            dataClass:'', 
            secondClass:'', 
            headerClass:['cl2','sl1', 'fc-w']
        },
        {header: 'desc jig', 
            value:'desc_jig', 
            typeData:'text', 
            list:'', 
            dataClass:'', 
            secondClass:'', 
            headerClass:['cl2','sl3', 'fc-w']
        },
        {header: '' , 
            value:'type', 
            typeData:'hidden', 
            list:'', 
            dataClass:'', 
            secondClass:'', 
            headerClass:['cl2','sl5', 'fc-w']
        },
        {header: 'delete', 
            value:'delete', 
            typeData:'button', 
            list:'', 
            dataClass:'', 
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

    const input = async(data, src, mark) => {
        const div = document.createElement('div');
        const classes = data.dataClass;
        if(classes) {
            classes.forEach(clas=>{
                div.classList.add(clas);
            });
        }
        const input = document.createElement('input');
        const classes2 = data.secondClass;
        if(classes2) {
            classes2.forEach(clas=>{
                input.classList.add(clas);
            });
        }
        input.id = data.value + "+" + mark;
        input.setAttribute('autocomplete', 'off');
        if (data.list) {
            input.setAttribute('list', data.list);
        }
        input.value = src[data.value];
        div.appendChild(input);
        return div;
    }    
    
    const button = async(data, src, mark) => {
        const div = document.createElement('div');
        const classes = data.dataClass;
        if(classes) {
            classes.forEach(clas=>{
                div.classList.add(clas);
            });
        }
        const btn = document.createElement('button');
        const classes2 = data.secondClass;
        if(classes2) {
            classes2.forEach(clas=>{
                btn.classList.add(clas);
            });
        }
        btn.id = data.value + "+" + mark;
        btn.setAttribute('type', 'button');
        btn.textContent = src[data.value];
        div.appendChild(btn);
        return div;
    }


    const text = async(data, src, mark) => {
        const div = document.createElement('div');
        const classes = data.dataClass;
        if(classes) {
            classes.forEach(clas=>{
                div.classList.add(clas);
            });
        }
        div.id = data.value + "+" + mark;
        div.textContent = src[data.value];
        return div;
    }

    const hidden = async(data, src, mark) => {
        const div = document.createElement('input');
        div.setAttribute('type', 'hidden');
        div.id = data.value + "+" + mark;
        div.value = src[data.value];
        return div;
    }

    const hidDiv = async(data, src, mark) => {
        const div = document.createElement('input');
        div.setAttribute('type', 'text');
        div.classList.add('hide');
        div.id = data.value + "+" + mark;
        return div;
    }

    const createTable = async(array, data, mark, target, idTable) => {
        const container = document.getElementById(target);
        container.appendChild(await header(idTable, array));
        const table = document.getElementById(idTable);
        for (let i=0; i<data.length; i++) {
            const idMarker = data[i][mark];
            table.appendChild(await createTr(idMarker));
            const getTr = document.getElementById(idMarker);
            for (let ii=0; ii<array.length; ii++) {
                console.log(array[ii].typeData);
                if (array[ii].typeData === 'input'){
                    const result = await input(array[ii], data[i],idMarker)
                    getTr.appendChild(result);
                } else if (array[ii].typeData === 'text'){
                    const result = await text(array[ii], data[i],idMarker)
                    getTr.appendChild(result);
                } else if (array[ii].typeData === 'hidden'){
                    const result = await hidden(array[ii], data[i],idMarker)
                    getTr.appendChild(result);
                } else if (array[ii].typeData === 'button'){
                    const result = await button(array[ii], data[i],idMarker)
                    getTr.appendChild(result);
                } else if (array[ii].typeData === 'div'){
                    const result = await div(array[ii], data[i],idMarker)
                    getTr.appendChild(result);
                } else if (array[ii].typeData === 'hidDiv'){
                    const result = await hidDiv(array[ii], data[i],idMarker)
                    getTr.appendChild(result);
                } else {
                    alert('data input wrong');
                }
            }

        }
    }

    const header = async(idTable, data) =>{
        const tableDiv = document.createElement('div');
        tableDiv.id = idTable;
        const headerTr = document.createElement('div');
        headerTr.classList.add('fr');
        for (let i=0; i<data.length; i++) {
            if (data[i].header) {
                const div = document.createElement('div');
                div.textContent = data[i].header;
                const classes = data[i].headerClass;
                classes.forEach(clas=>{
                    div.classList.add(clas);
                });
                headerTr.appendChild(div);
            }
        }
        tableDiv.appendChild(headerTr);
        return tableDiv;
    }
    
    const createTr = async(trId) => {
        const tr = document.createElement('div');
        tr.classList.add('fr');
        tr.id = trId;
        return tr;
    }



    import {jig_master_query} from '../jig_db_new/class.js';
    const dataDB = await jig_master_query.getData();
    createTable(src1, dataDB, 'item_jig', 'root', 'testTable');



</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>