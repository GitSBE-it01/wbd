<?php
/*
    wo_part as item_number,
    pt_desc1 as desc1,
    pt_desc2 as desc2,
    wo_site as site,
    ptp_buyer as buyer_planner,
    wo_nbr as work_order,
    wo_lot as id,
    wo_qty_ord as qty_ord,
    case(when wo_status = "C" then 0 else (wo_qty_ord - wo_qty_comp - wo_qty_rjct)) as qty_open,
    wo_qty_comp as qty_comp,
    wo_rel_date as rel_date,
    wo_ord_date as order_date,
    wo_due_date as due_date,
    wo_rmks as remarks,
    wo_so_job as sales_job,
    wo_status as status,
    wo_vend as supplier,
    wo__chr04 as assy_line,
    wo__chr03 as fixed_r
*/

include_once "../index.php";

$wo_sbe4 = [];
$param_wo_sbe4 = 'qad_rout__fetch_wo_sbe4';
if(!check_cache('data_sbe4', $param_wo_sbe4)) {
    delete_cache('data_sbe4', $param_wo_sbe4);
    $wo_sbe4 = odbc_qad::execQuery("SELECT 
        wo_part as item_number,
        pt_desc1 as desc1,
        pt_desc2 as desc2,
        wo_site as site,
        ptp_buyer as buyer_planner,
        wo_nbr as work_order,
        wo_lot as id,
        wo_qty_ord as qty_ord,
        case 
            WHEN wo_status = 'C' then 0 
            else (wo_qty_ord - wo_qty_comp - wo_qty_rjct) 
        END as qty_open,
        wo_qty_comp as qty_comp,
        wo_rel_date as rel_date,
        wo_ord_date as order_date,
        wo_due_date as due_date,
        wo_rmks as remarks,
        wo_so_job as sales_job,
        wo_status as status,
        wo_vend as supplier,
        wo__chr04 as assy_line,
        wo__chr03 as fixed_r
    FROM pub.wo_mstr wo 
    LEFT JOIN pub.pt_mstr pt ON wo.wo_part = pt.pt_part
    LEFT JOIN pub.ptp_det ptp ON wo.wo_part = ptp.ptp_part
    WHERE (wo_site = 'SOFTPART' OR wo_site = 'SoftPart' OR wo_site = 'softpart' ) 
    WITH (NOLOCK, READPAST NOWAIT)",'');
    cache_data('data_sbe4', $param_wo_sbe4, $wo_sbe4);
} else {
    $wo_sbe4 = get_cache('data_sbe4', $param_wo_sbe4);
}

if(isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    cors_sbe4();
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($wo_sbe4);
    return;
} else {
    /*
    echo "
    <head>
        <title>wo sbe4</title>
    </head>
    <body>
    <script src='../../assets/template/library/sheetjs/xlsx.full.min.js'></script>
    <script>
        const data_wo_sbe4 =".json_encode($wo_sbe4).";
        console.log(data_wo_sbe4);
    </script>
    </body>";
    echo 'jumlah data wo_sbe4 test = '.count($wo_sbe4)."</br> contoh 5 data awal : </br>";
    echo "<pre>";
    print_r(array_slice($wo_sbe4,0,5));
    echo "</pre>";
    */
    echo json_encode($wo_sbe4);
    return;
}

/*
    const workbook = XLSX.utils.book_new();
    const worksheet = XLSX.utils.json_to_sheet(data_wo_sbe4);
    XLSX.utils.book_append_sheet(workbook, worksheet, 'data_intersite');
    XLSX.writeFile(workbook, 'data.xlsx')
*/
?>