<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';

require_once 'intersite/index.php';
require_once 'routing/index.php';
require_once 'so/index.php';
require_once 'wo/index.php';

/*
    const data = ''; //bisa di isi dengan filter kalau di perlukan, utk saat ini tidak bisa di fungsikan terlebih dahulu;
    let result = [];
    fetch("http://informationsystem.sbe.co.id:8080/wbd/data_sbe4/index.php", {
        method: "POST", 
        headers: {
            'Content-Type': 'application/json',
            'Ori': "http://informationsystem.sbe.co.id:8080",
        },
        body: JSON.stringify({Data:data})})  
    .then(response => response.text())
    .then(data => {
        result = data;
    })
    .catch(error => {
        console.error('Error:', error);   
    });
    console.log(result);
*/

function data_sbe4() {
    $datasets = [
        [
            'query'=>'SELECT 
                    r.ro_routing as Routing_Code,
                    i.pt_desc1 as Description1,
                    i.pt_desc2 as Description2,
                    r.ro_op as Operation,
                    r.ro_start as Start_Date,
                    r.ro_end as End_Date,
                    r.ro_desc as Op_desc,
                    r.ro_wkctr as Work_Center,
                    r.ro_mch_op as Machines_per_Operation,
                    r.ro_wait as Wait_Time,
                    r.ro_setup_men as Setup_Crew,
                    r.ro_men_mch as Run_Crew,
                    r.ro_setup as Setup_Time,
                    r.ro_run as Run_Time,
                    i.pt_mfg_lead as Manufacturing_Lead_Time
                FROM dbqad_live.ro_det r 
                JOIN dbqad_live.pt_mstr i 
                ON r.ro_routing = i.pt_part 
                WHERE ro_wkctr LIKE "S4-%" 
                OR ro_wkctr LIKE "S3-%"',
            'name'=>'routs'
        ],
    ];
    $response = [];
    foreach($datasets as $set ) {
        $response[$set['name']] = DB::execQuery($set['query'],'');
    }
    if(isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
        cors_sbe4();
        header("Cache-Control: public");
        header("Content-Type: application/json");
        echo json_encode($response);
        return;
    } else {
        echo "
        <script>
            const data =".json_encode($response).";
            console.log(data);
        </script>";
        return $response;
    }
}
data_sbe4();
?>

