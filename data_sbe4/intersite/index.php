<?php
/*
ds_part as item_nbr,
ds_shipsite as source,
ds_line as line,
ds_site as site,
ds_req_nbr as req_nbr,
ds_nbr as ord_number,
ds_shipdate as ship_date,
ds_qty_ord as qty_ordered,
ds_qty_ship as qty_ship,
(ds_qty_conf - ds_qty_ship) as qty_open,
pt_um as um,
ds_status as status,
ptp_site as site,
ptp_buyer as buyer_planner,
ptp_network as network_code,
ds_qty_conf as qty_confirmed,

*/
include_once "../index.php";

$intersite = [];
$param_intersite = 'qad_rout__fetch_intersite_demand';
if(!check_cache('data_sbe4', $param_intersite)) {
    delete_cache('data_sbe4', $param_intersite);
    $wc_sbe4 = odbc_qad::execQuery("SELECT 
        ds_part as item_nbr,
        ds_shipsite as source,
        ds_line as line,
        ds_site as intersite_site,
        ds_req_nbr as req_nbr,
        ds_nbr as ord_number,
        ds_shipdate as ship_date,
        ds_qty_ord as qty_ordered,
        ds_qty_ship as qty_ship,
        (ds_qty_conf - ds_qty_ship) as qty_open,
        pt_um as um,
        ds_status as status,
        ptp_site as item_site,
        ptp_buyer as buyer_planner,
        ptp_network as network_code,
        ds_qty_conf as qty_confirmed,
        dsr_ord_date as order_date
    FROM pub.ds_det ds 
    JOIN pub.pt_mstr pt ON ds.ds_part = pt.pt_part
    JOIN pub.ptp_det ptp ON ds.ds_part = ptp.ptp_part
    JOIN pub.dsr_mstr dsr ON ds.ds_req_nbr = dsr.dsr_req_nbr
    WHERE ptp_site = 'softpart'
    WITH (NOLOCK, READPAST NOWAIT)",'');
    foreach($wc_sbe4 as $set) {
        $intersite[]=$set;
    }
    cache_data('data_sbe4', $param_intersite, $intersite);
} else {
    $intersite = get_cache('data_sbe4', $param_intersite);
}

if(isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    cors_sbe4();
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($intersite);
    return;
} else {
    /*
    echo "
    <head>
        <title>intersite sbe4</title>
    </head>
    <body>
    <script src='../../assets/template/library/sheetjs/xlsx.full.min.js'></script>
    <script>
        const data_intersite =".json_encode($intersite).";
        console.log(data_intersite);
    </script>
    </body>";
    echo 'jumlah data intersite = '.count($intersite)."</br> contoh 5 data awal : </br>";
    echo "<pre>";
    print_r(array_slice($intersite,0,5));
    echo "</pre>";
    echo "
    <script>
        window.open('http://informationsystem.sbe.co.id:8080/wbd/data_sbe4/routing/index.php', '_blank');
    </script>
    ";
    */
    echo json_encode($intersite);
    return;
}

/*
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(data_intersite);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'data_intersite');
        XLSX.writeFile(workbook, 'data.xlsx')
*/
?>