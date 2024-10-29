<?php
/*
    sod_nbr as sales_order,
    so_channel as channel_so,
    so_bill as bill_to,
    so_cust as sold_to,
    ad_name as name,
    sod_line as line,
    sod_part as item_number,
    sod_desc as item_description_so,
    (pt_desc1 + " " + pt_desc2) as item_description,
    sod_um as um,
    sod_qty_ord as qty_ord,
    sod_status as status,
    so_curr as currency,
    sod_price as price,
    so_ex_rate2 as exch_rate2,
    (sod_price * sod_qty_ord) as ext_price,
    sod_due_date as due_date,
    sod_qty_ship as qty_ship,
    (sod_qty_ord - sod_qty_ship) as qty_open,
    so_po as purch_order,
    cmt_cmmt[01] as comment01,
    so_ship as ship_to,
    so_rmks as remarks,
    pt_dsgn_grp as channel,
    pt_part_type as brand,
    pt_group as spk_group,
    pt__chr06 as prod_cat,
    so_ord_date as order_date,
    sod_qty_all as qty_allocated,
    so_stat as act_stat,
    so_slspsn[1] as salesperson,
    sod_consume as consume,
    so_compl_stat as stat_stat,
    so_compl_date as stat_date,
    sod_tax_in as tax_in

        $so_sbe4 = odbc_qad::execQuery("SELECT 
        sod_nbr as sales_order,
        sod_site as site,
        so_channel as channel_so,
        so_bill as bill_to,
        so_cust as sold_to,
        sod_line as line,
        sod_part as item_number,
        sod_desc as item_description_so,
        (pt_desc1 + ' ' + pt_desc2) as item_description,
        sod_um as um,
        sod_qty_ord as qty_ord,
        sod_status as status,
        so_curr as currency,
        sod_price as price,
        so_ex_rate2 as exch_rate2,
        (sod_price * sod_qty_ord) as ext_price,
        sod_due_date as due_date,
        sod_qty_ship as qty_ship,
        (sod_qty_ord - sod_qty_ship) as qty_open,
        so_po as purch_order,
        so_ship as ship_to,
        so_rmks as remarks,
        pt_dsgn_grp as channel,
        pt_part_type as brand,
        pt_group as spk_group,
        pt__chr06 as prod_cat,
        so_ord_date as order_date,
        sod_qty_all as qty_allocated,
        so_stat as act_stat,
        so_slspsn[1] as salesperson,
        sod_consume as consume,
        so_compl_stat as compl_stat,
        so_compl_date as stat_date,
        sod_tax_in as tax_in
    FROM pub.sod_det sod 
    JOIN pub.pt_mstr pt ON sod.sod_part = pt.pt_part
    JOIN pub.so_mstr so ON sod.sod_nbr = so.so_nbr
    WHERE sod_site = 'SOFTPART'
    WITH (NOLOCK, READPAST NOWAIT)",'');
*/
include_once "../index.php";

$so_sbe4 = [];
$param_so_sbe4 = 'qad_rout__fetch_so_sbe4';
if(!check_cache('data_sbe4', $param_so_sbe4)) {
    delete_cache('data_sbe4', $param_so_sbe4);
    $so_sbe4 = odbc_qad::execQuery("SELECT 
        sod_nbr as sales_order,
        sod_site as site,
        so_channel as channel_so,
        so_bill as bill_to,
        so_cust as sold_to,
        sod_line as line,
        sod_part as item_number,
        sod_desc as item_description_so,
        (pt_desc1 + ' ' + pt_desc2) as item_description,
        sod_um as um,
        sod_qty_ord as qty_ord,
        sod_status as status,
        so_curr as currency,
        sod_price as price,
        so_ex_rate2 as exch_rate2,
        (sod_price * sod_qty_ord) as ext_price,
        sod_due_date as due_date,
        sod_qty_ship as qty_ship,
        (sod_qty_ord - sod_qty_ship) as qty_open,
        so_po as purch_order,
        so_ship as ship_to,
        so_rmks as remarks,
        pt_dsgn_grp as channel,
        pt_part_type as brand,
        pt_group as spk_group,
        pt__chr06 as prod_cat,
        so_ord_date as order_date,
        sod_qty_all as qty_allocated,
        so_stat as act_stat,
        so_slspsn[1] as salesperson,
        sod_consume as consume,
        so_compl_stat as compl_stat,
        so_compl_date as stat_date,
        sod_tax_in as tax_in
    FROM pub.sod_det sod 
    JOIN pub.so_mstr so ON sod.sod_nbr = so.so_nbr
    LEFT JOIN pub.pt_mstr pt ON sod.sod_part = pt.pt_part
    WHERE sod_site = 'SOFTPART'
    WITH (NOLOCK, READPAST NOWAIT)",'');
    cache_data('data_sbe4', $param_so_sbe4, $so_sbe4);
} else {
    $so_sbe4 = get_cache('data_sbe4', $param_so_sbe4);
}

if(isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    cors_sbe4();
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($so_sbe4);
    return;
} else {
    /*
    echo "
    <head>
        <title>so sbe4</title>
    </head>
    <body>
    <script src='../../assets/template/library/sheetjs/xlsx.full.min.js'></script>
    <script>
        const data_so_sbe4 =".json_encode($so_sbe4).";
        console.log(data_so_sbe4);
    </script>
    </body>";
    echo 'jumlah data so_sbe4 test = '.count($so_sbe4)."</br> contoh 5 data awal : </br>";
    echo "<pre>";
    print_r(array_slice($so_sbe4,0,5));
    echo "</pre>";
    echo "
    <script>
        window.open('http://informationsystem.sbe.co.id:8080/wbd/data_sbe4/wo/index.php', '_blank');
    </script>
    ";
    */
    echo json_encode($so_sbe4);
    return;
}

/*
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(data_so_sbe4);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'data_intersite');
        XLSX.writeFile(workbook, 'data.xlsx')
*/
?>