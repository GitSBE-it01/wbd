<?php 
require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update record</title>
    <link rel="stylesheet" href="../../assets/css/layout.css">
    <link rel="stylesheet" href="../../assets/css/layout_fix.css">
    <link rel="stylesheet" href="../../assets/css/animation.css">
    <link rel="stylesheet" href="../../assets/css/font.css">
    <link rel="stylesheet" href="../../assets/css/color.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
    <link rel="stylesheet" href="../../assets/css/search_btn.css">
</head>
<body>
<input type=hidden id='role' value="<?php if (isset($role)) {echo $role;} else {echo 'guest';}?>">

<?php if ($role === 'admin' || $role === 'superuser')  {?>
    
<div id="root" class='sl9'>
</div>

<?php } else {
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/index.php");
    exit;}
?>
<script type='module'>
    /*
    ============================================================================
    display layout
    ============================================================================
    */
    // flex display div di root
    import { loading, init} from '../component/load.js';
    const root = document.getElementById('root');
    init('root', 'side', 'sl9', 'sl1');
    // role
    const role = document.getElementById('role');
    
    /*
    ============================================================================
    sidebar
    ============================================================================
    */
   // sidebar menu dan penanda link active di sidebar
    import { createSidebar, activeLink } from '../component/sidebar.js';
    createSidebar('side', 'sl1');
    activeLink('[data-nav]');
    const main = document.getElementById('main');
    const title = document.createElement('div');
    title.textContent = "Usage History";
    title.classList.add('navCard', 'sl3', 'fc-w', 'fs-xl', 'pt1', 'pl3', 'fw-blk');
    main.appendChild(title);

    /*
    ============================================================================
    data section
    ============================================================================
    */
    import {jig_usage} from '../class.js';
    import {createTable, tableUsage} from './table.js';
    import {createSearch, createSearch2,searchBarDate, searchBarMain} from './searchBar.js';
    import {createBtn} from './button.js';

    main.appendChild(loading('load','loading2'));
    await createSearch2(searchBarDate);
    const searchDiv = document.getElementById('searchDiv');
    searchDiv.appendChild(await createBtn({
        id:'usageHist',
        mark:'usageHist',
        type:'button', // submit or button
        text:'dl excel',
        classSty:['mx4'],
        js: {
            attr:'',
            value:''
        }
    }))
    await createSearch(searchBarMain);
    main.removeChild(document.getElementById('load'));
    
    let finalData=[];
    document.addEventListener('click', async function(event) {
        if(event.target.getAttribute('id') === 'searchBtn') {
            if(document.getElementById('mainTable')) {
                document.getElementById('mainTable').remove();
            }
            main.appendChild(loading('load','loading2'));
            const from = document.getElementById('from').value;
            const too = document.getElementById('too').value;
            const data = await jig_usage.fetchRangeFilter({tr_date:[`${from}`,`${too}`]});
            data.sort((a,b)=> {return b.tr_date.localeCompare(a.tr_date)});
            for (let i=0; i<data.length; i++) {
                const fltr = data[i]['jig'] + " -- " + 
                data[i]['tr_date'] + " -- " + 
                data[i]['code'] + " -- " + 
                data[i]['loc'] + " -- " + 
                data[i]['desc_jig'] + " -- " + 
                data[i]['cat'] + " -- " + 
                data[i]['wo_id'] + " -- " + 
                data[i]['type'];
                data[i]['fltr'] = fltr;
            }
            finalData = data;
            await createTable(tableUsage(finalData));
            const mainTbl = document.getElementById('mainTable');
            const targetDt = mainTbl.querySelectorAll('[data-row]');
            targetDt.forEach(dt=> {
                const target = dt.querySelector('[data-cell*="fltr"]');
                const value = target.getAttribute('data-cell');
                const splt = value.split('___');
                dt.setAttribute('data-row',splt[1]);
            })
            main.removeChild(document.getElementById('load'));
            return;
        }
        if(event.target.getAttribute('id') === 'usageHist') {
            const btnXl2 = document.getElementById('usageHist');
            btnXl2.textContent = "";
            btnXl2.classList.add('load_txt');
            btnXl2.disabled = true;
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.json_to_sheet(finalData);
            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
            // Generate an Excel file
            XLSX.writeFile(workbook, 'usage.xlsx');
            btnXl2.classList.remove('load_txt');
            btnXl2.textContent = "dl excel";
            btnXl2.disabled = false;
            return;
        }
    })

    document.addEventListener('change', async function(event) {
        if(event.target.getAttribute('id') === 'search1') {
            const target = event.target;
            const value = event.target.value;
            const mainTbl = document.getElementById('mainTable');
            const targetDt = mainTbl.querySelectorAll('[data-row]');
            targetDt.forEach(dt=>{
                dt.classList.remove('displayHide');
                if(!dt.getAttribute('data-row').toLocaleLowerCase().includes(value.toLocaleLowerCase())) {
                    console.log('count')
                    dt.classList.add('displayHide');
                }
            })
        }
    })

</script>
<script src="../../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>
