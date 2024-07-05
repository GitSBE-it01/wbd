<?php


function vjs_alat_ukur_handle($data,$method, $model, $table) {
    $data_req = $data['data']; 
    $table_db =  $model[$table]->table;
    switch($method) {
        case "GET":
            $query = 'SELECT * FROM '.$table_db;
            $response = getData('db_wbd', $query);
            break;
        case "fetch":
            $query = '';
            $response = getData('db_wbd', $query, $data_req);
            break;
        default:
            $response = "Method Not Allowed";
    }
    return $response;
}

