<?php
function vjs_alat_ukur_handle($db_conn, $data, $method, $model, $table) {
    switch($method) {
        case "POST":
            $mdl = $model[$table];
            $response  = $data;
        default:
            $response = "Method Not Allowed";
    }
    return $response;
}

