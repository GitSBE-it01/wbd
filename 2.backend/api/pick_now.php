<?php
function pick_now_handle($db_conn, $data, $action, $model, $table) {
    $mdl = $model[$table]->table;
    switch($action) {
        case "fetch_end_date":
            $query = 'SELECT * FROM '.$mdl.' WHERE end_date BETWEEN ? AND ?';
            $types = 'ss';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_del_res":
            $query = 'DELETE FROM '.$mdl.' WHERE data_date=?';
            $types = 's';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        default:
            $response = "action not available in jig db handle";
    }
    return $response;
}


