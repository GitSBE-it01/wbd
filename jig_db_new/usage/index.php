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
    import {createSearch, searchBarMain} from './searchBar.js';
    import {createBtn} from './button.js';

    main.appendChild(loading('load','loading2'));
    const data = await jig_usage.getData();
    for (let i=0; i<data.length; i++) {
        const fltr = data[i]['item_jig'] + " -- " + data[i]['tr_date'] + " -- " + data[i]['qty'];
        data[i]['filter']=fltr;
    }
    const sortDtFilt = data.sort((a, b) => {
        const nameComparison = a.item_jig.localeCompare(b.item_jig);
        if (nameComparison !== 0) {
            return nameComparison;
        }
        return b.tr_date - a.tr_date;
    })
    let finalData = sortDtFilt;

    await createSearch(searchBarMain);
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
    await createTable(tableUsage(finalData));
    main.removeChild(document.getElementById('load'));

    document.addEventListener('click', async function(event) {
        if(event.target.getAttribute('id') === 'searchBtn') {
            if(document.getElementById('mainTable')) {
                document.getElementById('mainTable').remove();
            }
            const fltrVal = document.getElementById('search').value.toLowerCase();
            const dataFltr = data.filter(item =>item.filter.toLowerCase().includes(fltrVal));
            const sortDtFilt = dataFltr.sort((a, b) => {
                const nameComparison = a.item_jig.localeCompare(b.item_jig);
                if (nameComparison !== 0) {
                  return nameComparison;
                }
                return b.tr_date - a.tr_date;
            })
            finalData = sortDtFilt;
            await createTable(tableUsage(finalData));
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

</script>
<script src="../../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>
