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
    const title = document.createElement('div');
    title.textContent = "Update Data";
    title.classList.add('navCard', 'sl3', 'fc-w', 'fs-xl', 'pt1', 'pl3', 'fw-blk');
    main.appendChild(title);
    /*
    ============================================================================
    navbar
    ============================================================================
    */
    // navbar di main container utk unhide div dari jig database dan speaker database
    import { createNavbar } from '../component/navbar.js';
    main.appendChild(createNavbar(`
    <div class='navCard navbar sl4'>
        <div class='navli'>
            <button type="button" id="btnSec1" data-switch="divStock">
                Update Stock
            </button>
        </div>
        <div class='navli'>
            <button type="button" id="btnSec2" data-switch="divJig">
                Update Jig Data
            </button>
        </div>
        <div class='navli'>
            <button type="button" id="btnSec3" data-switch="divType">
                Update Type List
            </button>
        </div>
    </div>
    `));
    /*
    ============================================================================
    data section
    ============================================================================
    */
    import { search } from './component/search.js';
    import { datalistLoc, locList, spkList } from './component/datalist.js';

    main.appendChild(loading('loading1', 'loading'));
    await datalistLoc('jig_suggest');
    await search('main', 'searchStock', 'btnStock', 'divStock', 'update Stock', 'jig_suggest', 'or6', 'or1');
    await search('main', 'searchJig', 'btnJig', 'divJig','update jig data', 'jig_suggest', 'sl6', 'sl3');
    await spkList('spkList');
    await search('main', 'searchType', 'btnType', 'divType', 'update type list', 'spkList', 'bl6','bl3');
    await locList('dataLokasi');
    const divStock = document.getElementById('divStock');
    divStock.classList.remove('hide');
    const btnStockDiv = document.getElementById('btnSec1');
    btnStockDiv.classList.add('switchActive');
    main.removeChild(document.getElementById('loading1'));

    import { stockUpdate, dataUpdate, typeUpdate } from './component/data.js';
    import { delDataStock, delDataType } from './component/updateInsert.js';
    
    document.addEventListener("click", async function(event) {
        if (event.target.getAttribute('type') === 'button' && event.target.getAttribute('data-switch') !== null) {
            const dataSwitch = document.querySelectorAll('[data-switch]')
            dataSwitch.forEach((obj) => {
                const change1 = document.getElementById(obj.getAttribute('id'));
                change1.classList.remove('switchActive');
                const change2 = document.getElementById(obj.getAttribute('data-switch'));
                change2.classList.add('hide');
            })
            const divTarget1 = document.getElementById(event.target.getAttribute('id'));
            const divTarget2 = document.getElementById(event.target.getAttribute('data-switch'));
            divTarget1.classList.add('switchActive');
            divTarget2.classList.remove('hide');
            return;
        }
        if (event.target.getAttribute('type') === 'button' && event.target.getAttribute('id').includes('del+') && event.target.getAttribute('data-input') !== null) {
            const delIdData = document.getElementById(event.target.getAttribute('id'));
            delIdData.textContent = "";
            delIdData.classList.add('proses');
            delIdData.disabled = true;
            await delDataStock(event.target.getAttribute('id'),'code');
            delIdData.classList.remove('proses');
            delIdData.textContent = "delete";
            return;
        }
        if (event.target.getAttribute('type') === 'button' && event.target.getAttribute('id').includes('del+') && event.target.getAttribute('data-updtype') !== null) {
            const delIdType = document.getElementById(event.target.getAttribute('id'));
            delIdType.textContent = "";
            delIdType.classList.add('proses');
            delIdType.disabled = true;
            await delDataType(event.target.getAttribute('id'),'id');
            delIdType.classList.remove('proses');
            delIdType.textContent = "delete";
            return;
        }
    })

    const btnStock = document.getElementById('btnStock');
    btnStock.addEventListener('click', async function() {
        await stockUpdate();
    })
    const btnJig = document.getElementById('btnJig');
    btnJig.addEventListener('click', async function() {
        await dataUpdate();
    })
    const btnType = document.getElementById('btnType');
    btnType.addEventListener('click', async function() {
        await typeUpdate();
    })

    document.addEventListener('change', async function(event) {
        console.log('change');
        if(event.target.hasAttribute('data-input')) {
            const current = event.target;
            const form = current.closest('[data-fromdb');
            console.log({current, form});
            form.setAttribute('data-fromdb','change');
        }
    })
</script>
</body>
</html>
