<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
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
    <title>parent code</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root' class='container'>
    <div class='loading'></div>
</div>
<script type='module'>
    const initPage = performance.now();
    import {
        loading, 
        createNav,
        activeLink,
        createTable,
        createBtn,
        createInp,
        createDatalist,
        createHeader,
        createSearch,    
        createHeader2,
        navigation,
        searchBarMain,
        mainTbl
    } from './component/index.js';
    import {
        bom
    } from './utility/index.js';
    
    // start up web page
    const root = document.getElementById('root');
    await createNav(navigation);
    const bomDt = await bom.getData();
    activeLink('navID', ['f-or7']);
    await createSearch(searchBarMain);
    root.removeChild(document.querySelector('.loading'));
    
    console.log(bomDt);
    const endInit = performance.now();
    const dlDt = (endInit - initPage) / 1000;
    console.log('waktu inisiasi dan penarikan data : ' + dlDt);

    const start1 = performance.now();
    const parent = {};
    bomDt.forEach(dt => {
        if(!parent[dt.Parent_Item]) {
            parent[dt.Parent_Item] = [];
        } 
        if(!parent[dt.Parent_Item].includes(dt.Component_Item)) {
            parent[dt.Parent_Item].push(dt.Component_Item);
        }
    })
    const allParent = {};
    bomDt.forEach(dt=> {
        if(!allParent[dt.Parent_Item]) {
            allParent[dt.Parent_Item] = [dt.Component_Item];
        } else {allParent[dt.Parent_Item].push(dt.Component_Item); }
    })
    console.log({parent, allParent});
    const end1 = performance.now();
    const prs1 = (end1 - start1) / 1000;
    console.log('waktu proses data1 : ' + prs1);
    
    const start2 = performance.now();
    const parent2 = {};
    const parentKey = Object.keys(parent);
    parentKey.forEach(dt=>{
        parent2[dt] = parent[dt];
        let itemCek = 0;
        const a = parent2[dt];
        let len = a.length;
        let cek = false;
        let i = 0;
        while (i<len) {
            if(allParent[`${a[i]}`]) {
                allParent[`${a[i]}`].forEach(dt2=>{
                    if(!a.includes(dt2)) {
                        a.push(dt2);
                        len = a.length;
                    }
                })
            }
            i++;
        }        
    })
    console.log(parent2);
    const end2 = performance.now(); 
    const prs2 = (end2 - start2) / 1000;
    console.log('waktu proses data2 : ' + prs2);

    const start3 = performance.now();
    const map = new Map();
    parentKey.forEach(dt=>{
        parent[dt].forEach(dt2=> {
            if(map.has(dt2)) {
                const exst = map.get(dt2);
                if (!exst.parent.includes(dt)) {
                    exst.parent.push(dt);
                }
            } else {
                const data ={
                    part: dt2,
                    parent: [dt]
                }
                map.set(dt2, data);
            }
        })
    })
    const result = Array.from(map.values());
    console.log({map, result});
    const end3 = performance.now(); 
    const prs3 = (end3 - start3) / 1000;
    console.log('waktu proses data3 : ' + prs3);

    await createTable(mainTbl(result));
    const endFinal = performance.now();
    const totalTime = (endFinal - initPage) /1000;
    console.log('waktu proses : ' + totalTime);
    

</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
<script src="./utility/post.js"></script>
</body>
</html>