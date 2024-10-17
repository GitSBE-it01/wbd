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

session_start();
cors_sbe4();
set_time_limit(3600);
function data_sbe4() {
    $data = json_decode(file_get_contents('php://input'), true);
    $dt = $data['Data'];
    $method = $_SERVER['REQUEST_METHOD'];
    /*
        $cache = $_SERVER['HTTP_CACHE_CONTROL'];
        $table = $_SERVER['HTTP_REQ_DETAIL'];
        $routes = $_SERVER['HTTP_ROUTE'];
        $action = $_SERVER['HTTP_REQ_METHOD'];
        $param =  $table."__".$action;
    */
    if($method === "POST") {
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
        /*
            if(!check_cache('general', 'qad_rout__fetch_qad_rout_sbe4')) {
                delete_cache('general', 'qad_rout__fetch_qad_rout_sbe4');
                cache_data('general', 'qad_rout__fetch_qad_rout_sbe4', $response);
            } else {
                $response = get_cache('general', 'qad_rout__fetch_qad_rout_sbe4');
            }
        */
    }
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($response);
    return $response;
}

$result = data_sbe4();

?>
