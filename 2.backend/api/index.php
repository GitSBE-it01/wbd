<?php
require_once "D:/xampp/htdocs/wbd/2.backend/model/index.php";
require_once "D:/xampp/htdocs/wbd/2.backend/middleware/class.php";
require_once "vjs_alat_ukur.php";

function custom_handle($db_conn, $dt, $routes, $method, $model, $table) {
    switch($routes) {
        case "vjs_alat_ukur2":
            $response = vjs_alat_ukur_handle($db_conn, $dt, $method, $model, $table);
        default: 
            $response = 'wrong routes';
    }
    return $response;
}