<?php
function jig_db_handle($db_conn, $data, $action, $model, $table) {
    $mdl = $model[$table]->table;
    switch($action) {
        case "fetch_end_date":
            $query = 'SELECT * FROM '.$mdl.' WHERE end_date BETWEEN ? AND ?';
            $types = 'ss';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_op_tran":
            $query = 'SELECT * FROM '.$mdl.' WHERE op_tran_date BETWEEN ? AND ?';
            $types = 'ss';
            $response  = $db_conn->customQuery('new', $query, $types, $data);
            break;
        default:
            $response = "action not available";
    }
    return $response;
}

