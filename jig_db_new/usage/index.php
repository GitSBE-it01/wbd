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
    document.addEventListener("DOMContentLoaded", function() {
        activeLink('a.link');
    });
    const title = document.createElement('div');
    title.textContent = "Usage History";
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
    import {ng_daily, jig_function_query} from '../class.js';
    import {currentDate} from '../process.js';

    const start = performance.now();
    const data = await ng_daily.fetchDataFilter({op_wkctr:'TWD'});
    const mapDt = new Map();
    data.forEach(dt => {     
        const year = dt.op_date.split('-');
        if (year[0] === '2024') {
            const filter = dt.op_part+"///" + dt.op_wo_op;
            if (mapDt.has(filter)) {
                const target = mapDt.get(filter);
                target.qty_run += parseInt(dt.op_qty_run);
                target.qty_ng += parseInt(dt.op_qty_ng);
            } else {
                const objDt = {
                    wc: dt.op_wkctr,
                    id: dt.op_wo_lot,
                    oprt: dt.op_wo_op,
                    itm_nbr: dt.op_part,
                    type: dt.op_type,
                    op_desc: dt.op_wr_desc,
                    qty_run: parseInt(dt.op_qty_run),
                    qty_ng: parseInt(dt.op_qty_ng),
                    cat: dt.op_categ
                };
                mapDt.set(filter, objDt);
            }}
        });
    const sumDt = Array.from(mapDt.values());
    const sumDt2 = new Map();
    sumDt.forEach(sd=>{ 
        if(sumDt2.has(sd.itm_nbr)) {
            const target = sumDt2.get(sd.itm_nbr);
            if (target.qty_run < sd.qty_run) {
                target.qty_run = sd.qty_run;
            }
        } else {
            const newDt = {
                itm_nbr: sd.itm_nbr,
                qty_run: parseInt(sd.qty_run)
            }
            sumDt2.set(sd.itm_nbr,newDt);
        }
    })
    const dtFix = Array.from(sumDt2.values());
    const jig_use = await jig_function_query.getData();
    const join = jig_use.map((obj1) => {
        const match = dtFix.find((obj2)=> obj2.itm_nbr === obj1.item_type);
        return {
            ...obj1,
            use: match?.qty_run ?? 0
        }
    });
    const filterCek = [];
    const lastCheck = new Map();
    join.forEach(jn=>{
        const filter = jn.item_jig + jn.item_type;
        if (jn.use !== 0) {
            jn.fltr = filter;
            filterCek.push(jn);
        } 
    })
    filterCek.forEach(ft => {
        if (!lastCheck.has(ft.fltr)){
            const inp = {
                item_jig: ft.item_jig,
                use: ft.use
            }
            lastCheck.set(ft.fltr, inp);
        }
    })
    const sumFix = new Map();
    lastCheck.forEach(lc=> {
        if(sumFix.has(lc.item_jig)) {
            const target = sumFix.get(lc.item_jig);
            target.use += lc.use;
        } else {
            const newDt = {
                item_jig: lc.item_jig,
                use: lc.use
            }
            sumFix.set(lc.item_jig, newDt);
        }
    })
    const result = Array.from(sumFix.values());
    console.log(result);
    const inputData = {item_jig:[], tr_date: [], qty:[]};
    result.forEach(rlt => {
        inputData.item_jig.push(rlt.item_jig.trim());
        inputData.tr_date.push(currentDate());
        inputData.qty.push(rlt.use);
    })
    console.log(inputData);
    const end = performance.now();
    const totalTime = end - start;
    console.log('total time = ' + totalTime);
</script>
</body>
</html>
