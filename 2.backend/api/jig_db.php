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
        case "fetch_jig_func_w_desc":
            $query = 'SELECT jf.id, jf.item_jig, jf.item_type, jf.opt_on, jf.opt_off, jf.status, pt.pt_desc1, pt.pt_desc2, pt.pt_status FROM '.$mdl.' jf JOIN dbqad_live.pt_mstr pt ON jf.item_type = pt.pt_part WHERE jf.item_jig=?';
            $types = 's';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        default:
            $response = "action not available";
    }
    return $response;
}

