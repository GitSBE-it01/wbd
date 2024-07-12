<?php
require_once "D:/xampp/htdocs/wbd/2.backend/model/index.php";
require_once "D:/xampp/htdocs/wbd/2.backend/middleware/class.php";
require_once "vjs_alat_ukur.php";
require_once "jig_db.php";
function custom_handle($db_conn, $dt, $routes, $action, $model, $table) {
    switch($routes) {
        case "vjs_alat_ukur":
            $response = vjs_alat_ukur_handle($db_conn, $dt, $action, $model, $table);
            break;
        case "jig_db_new3":
            $response = jig_db_handle($db_conn, $dt, $action, $model, $table);
            break;
        default: 
            $response = 'wrong routes';
    }
    return $response;
}