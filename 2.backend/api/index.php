<?php
require_once "D:/xampp/htdocs/wbd/2.backend/model/index.php";
require_once "D:/xampp/htdocs/wbd/2.backend/middleware/class.php";
require_once "general.php";
require_once "vjs_alat_ukur.php";
require_once "new_type_report.php";
require_once "jig_db.php";

function custom_handle($db_conn, $dt, $routes, $action, $model, $table) {
    if(is_int(strpos($table,'qad'))) {
        $response = general_handle($db_conn, $dt, $action, $model, $table);
        return $response;
    } else {
        switch($routes) {
            case "vjs_alat_ukur":
                $response = vjs_alat_ukur_handle($db_conn, $dt, $action, $model, $table);
                break;
            case "jig_db_new3":
                $response = jig_db_handle($db_conn, $dt, $action, $model, $table);
                break;
            case "new_type_report":
                $response = new_type_handle($db_conn, $dt, $action, $model, $table);
                break;
            case "auth":
                $response = auth_handle($db_conn, $dt, $action, $model, $table);
                break;
            default: 
                $response = 'wrong routes';
        }
        return $response;
    }
}

function auth_handle($db_conn, $data, $action, $model, $table) {
    $mdl = $model[$table]->table;
    switch($action) {
        case "auth_mstr":
            $query = 'SELECT * FROM '.$mdl.' em LEFT JOIN db_wbd.access ac ON em.Absensi = ac.absen WHERE Absensi=? ';
            $types = 's';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        default:
            $response = "action not available";
    }
    return $response;
}

