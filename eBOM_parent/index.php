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
    import { currentDate} from "../3.utility/index.js";
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
    import {api_access} from '../3.utility/index.js';
    
    // start up web page
    const root = document.getElementById('root');
    await createNav(navigation);
    const bomSrc = await bom.getData();
    const item = await api_access('fetch_item__cache','qad_item','');
    activeLink('navID', ['f-or7']);
    await createSearch(searchBarMain);
    root.removeChild(document.querySelector('.loading'));
    
    const endInit = performance.now();
    const dlDt = (endInit - initPage) / 1000;
    console.log('waktu inisiasi dan penarikan data : ' + dlDt);
    const bomDt = [];
    const today = currentDate('-');
    console.log(today);
    bomSrc.forEach(dt=>{
        if(dt['End_Effective'] === null || dt['End_Effective'] > today) {
            bomDt.push(dt);
        }
    })
    
    console.log({bomSrc,bomDt});
    const start1 = performance.now();
    const comp = [];
    bomDt.forEach(dt=>{
        const data = dt.Component_Item + " -- " + dt.Description_2 + "(" + dt.Stats +")";
        if(!comp.includes(data)) {
            comp.push(data);
        }

    })
    
    const parent = {};
    bomDt.forEach(dt => {
        const cekItem = item.find(obj=>obj.pt_part === dt.Parent_Item);
        const status = cekItem ? cekItem['pt_status'] : "OBSOLETE";
        const fltr = dt.Parent_Item + " -- " + dt.Description_1 + "(" + status +")";
        const data = dt.Component_Item + " -- " + dt.Description_2 + "(" + dt.Stats +")";
        
        if(!parent[fltr] && fltr[0] === '1') {
            parent[fltr] = [data];    
        }else if(parent[fltr] && !parent[fltr].includes(data)){
            parent[fltr].push(data);
        }
    })  

    const allParent = {};
    bomDt.forEach(dt=> {
        const cekItem = item.find(obj=>obj.pt_part === dt.Parent_Item);
        const status = cekItem ? cekItem['pt_status'] : "OBSOLETE";
        const fltr = dt.Parent_Item + " -- " + dt.Description_1 + "(" + status +")";
        const data = dt.Component_Item + " -- " + dt.Description_2 + "(" + dt.Stats +")" ;
        if(!allParent[fltr]) {
            allParent[fltr] = [data];
        } else {allParent[fltr].push(data); }
    })
    console.log({parent, allParent, comp});
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
                    exst.parent += "\n" + dt;
                }
            } else {
                const data ={
                    part: dt2,
                    parent: dt
                }
                map.set(dt2, data);
            }
        })
    })
    const result = Array.from(map.values());
    result.sort((a,b) => {return b.part.localeCompare(a.part)});
    console.log({map, result});
    const end3 = performance.now(); 
    const prs3 = (end3 - start3) / 1000;
    console.log('waktu proses data3 : ' + prs3);

    await createTable(mainTbl(result)); 
    const add = document.querySelectorAll(`[data-cell*="part"]`);
    add.forEach(dt =>{
        const value = dt.getAttribute('data-cell');
        const splt = value.split("___");
        const splt2 = splt[1].split(" -- ");
        const row = dt.closest('[data-row]');
        row.setAttribute('data-row', splt2[0]);
    })
    const endFinal = performance.now();
    const totalTime = (endFinal - initPage) /1000;
    console.log('waktu proses : ' + totalTime);
    
    const input = document.getElementById('input1');
    input1.addEventListener('change', function(event) {
        const inp = event.target;
        const inpValue = inp.value.toLocaleLowerCase();
        console.log(inpValue);
        const tbl = document.getElementById('tblMain');
        const row = tbl.querySelectorAll('[data-row]');
        row.forEach(dt=>{
            if(dt.classList.contains('displayHide')) {
                dt.classList.remove('displayHide');
            }
            if(!dt.getAttribute('data-row').toLocaleLowerCase().includes(inpValue)) {
                dt.classList.add('displayHide');
            }
        })
    })

    const dlExc = document.getElementById('dlExcl');
    dlExc.addEventListener('click', function(event) {
        const btn = event.target;
        btn.disabled = true;
        const inpt = document.getElementById('input1').value;
        const result2 = [];
        result.forEach(dt=> {
            if(dt['part'].toLocaleLowerCase().includes(inpt)) {
                result2.push(dt);
            }
        })
        console.log({result2})
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(result2);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'parent');
        XLSX.writeFile(workbook, 'cek_parent.xlsx')
        btn.disabled = false;
    })


</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
<script src="./utility/post.js"></script>
</body>
</html>