<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';

set_time_limit(3600);
function data_sbe4($query, $name) {
    $response = [];
    $param = 'qad_rout__fetch_'.$name;
    $response = odbc_qad::execQuery($query,'');
    /*
    if(!check_cache('data_sbe4', $param)) {
        delete_cache('data_sbe4', $param);
        cache_data('data_sbe4', $param, $response);
    } else {
        $response = get_cache('data_sbe4', $param);
    }
        */
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
            alert('data sudah selesai di proses');
        </script>";
        return $response;
    }
}

?>

