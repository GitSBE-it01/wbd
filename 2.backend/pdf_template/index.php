<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';
require_once 'D:/xampp/htdocs/wbd/1.asset/index.php';
require_once 'vjs_alat_ukur/index.php';
$period_array = [
    'b01'=>'Januari',
    'b02'=>'Februari',
    'b03'=>'Maret',
    'b04'=>'April',
    'b05'=>'Mei',
    'b06'=>'Juni',
    'b07'=>'Juli',
    'b08'=>'Agustus',
    'b09'=>'September',
    'b10'=>'Oktober',
    'b11'=>'November',
    'b12'=>'Desember',
];

function pdf_template($filter, $route) {
    switch($route){
        case "vjs_alat_ukur": 
            $response = body_vjs_alat_ukur($filter);
            break;
        default:
            $response = "no pdf template for this route";
    }
    return $response;
}

?>