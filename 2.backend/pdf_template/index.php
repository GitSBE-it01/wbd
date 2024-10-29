<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';
require_once '../../1.asset/index.php';
$html_array = [];
require_once 'vjs_alat_ukur/index.php';

function pdf_template($filter, $template) {
    global $html_array;
    $query = 'SELECT * FROM ';
    $data = DB::execQuery($query,'');
}


?>