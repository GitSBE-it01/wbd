<?php
include_once "../index.php";

$routs = [];
$param_routs = 'qad_rout__fetch_routs_sbe4';
if(!check_cache('data_sbe4', $param_routs)) {
    delete_cache('data_sbe4', $param_routs);
    $wc_sbe4 = odbc_qad::execQuery("SELECT r.ro_routing as routing_code, i.pt_desc1 as description1, i.pt_desc2 as description2, r.ro_op as operation, r.ro_start as start_date, r.ro_end as end_date, r.ro_desc as op_desc, r.ro_wkctr as work_center, r.ro_mch_op as machines_per_operation, r.ro_wait as wait_time, r.ro_setup_men as setup_crew, r.ro_men_mch as run_crew, r.ro_setup as setup_time, r.ro_run as run_time, r.ro_sub_cost as sub_cost, r.ro_sub_lead as sub_lead, r.ro_mod_date as mod_date, r.ro_mod_userid as mod_by, i.pt_mfg_lead as manufacturing_lead_time, r.ro__qade01 as qad_decimal, i.pt__chr04 as assy_line, r.ro_vend as supplier, r.ro__chr01 as work_center2, i.pt_article as article, r.ro__dec01 as lead_time FROM pub.ro_det r JOIN pub.pt_mstr i ON r.ro_routing = i.pt_part WHERE ro_wkctr LIKE 'S4-%' WITH (NOLOCK, READPAST NOWAIT)",'');

    $wc_sbe3 = odbc_qad::execQuery("SELECT r.ro_routing as routing_code, i.pt_desc1 as description1, i.pt_desc2 as description2, r.ro_op as operation, r.ro_start as start_date, r.ro_end as end_date, r.ro_desc as op_desc, r.ro_wkctr as work_center, r.ro_mch_op as machines_per_operation, r.ro_wait as wait_time, r.ro_setup_men as setup_crew, r.ro_men_mch as run_crew, r.ro_setup as setup_time, r.ro_run as run_time, r.ro_sub_cost as sub_cost, r.ro_sub_lead as sub_lead, r.ro_mod_date as mod_date, r.ro_mod_userid as mod_by, i.pt_mfg_lead as manufacturing_lead_time, r.ro__qade01 as qad_decimal, i.pt__chr04 as assy_line, r.ro_vend as supplier, r.ro__chr01 as work_center2, i.pt_article as article, r.ro__dec01 as lead_time FROM pub.ro_det r JOIN pub.pt_mstr i ON r.ro_routing = i.pt_part WHERE ro_wkctr LIKE 'S3-%' WITH (NOLOCK, READPAST NOWAIT)",'');

    foreach($wc_sbe4 as $set) {
        $routs[]=$set;
    }

    foreach($wc_sbe3 as $set) {
        $routs[]=$set;
    }
    cache_data('data_sbe4', $param_routs, $routs);
} else {
    $routs = get_cache('data_sbe4', $param_routs);
}

if(isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    cors_sbe4();
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($routs);
    return;
} else {
    /*
    echo "
    <head>
        <title>routing sbe4</title>
    </head>
    <script>
        const data_rout =".json_encode($routs).";
        console.log(data_rout);
    </script>";
    echo 'jumlah data routing = '.count($routs)."</br> contoh 5 data awal : </br>";
    echo "<pre>";
    print_r(array_slice($routs,0,5));
    echo "</pre>";
    echo "
    <script>
        window.open('http://informationsystem.sbe.co.id:8080/wbd/data_sbe4/so/index.php', '_blank');
    </script>
    ";*/
    echo json_encode($routs);
    return;
}

/*
data_sbe4('SELECT 
    r.ro_routing as routing_code,
    i.pt_desc1 as description1,
    i.pt_desc2 as description2,
    r.ro_op as operation,
    r.ro_start as start_date,
    r.ro_end as end_date,
    r.ro_desc as op_desc,
    r.ro_wkctr as work_center,
    r.ro_mch_op as machines_per_operation,
    r.ro_wait as wait_time,
    r.ro_setup_men as setup_crew,
    r.ro_men_mch as run_crew,
    r.ro_setup as setup_time,
    r.ro_run as run_time,
    r.ro_sub_cost as sub_cost,
    r.ro_sub_lead as sub_lead,
    r.ro_mod_date as mod_date,
    r.ro_mod_userid as mod_by,
    i.pt_mfg_lead as manufacturing_lead_time,
    r.ro__qade01 as qad_decimal,
    i.pt__chr04 as assy_line,
    r.ro_vend as supplier,
    r.ro__chr01 as work_center2,
    i.pt_article as article,
    r.ro__dec01 as lead_time
FROM pub.ro_det r 
JOIN pub.pt_mstr i 
ON r.ro_routing = i.pt_part 
WHERE ro_wkctr LIKE "S4-%" 
OR ro_wkctr LIKE "S3-%"',
'routs_sbe4');
*/
?>

