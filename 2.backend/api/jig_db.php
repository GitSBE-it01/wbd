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
            $query = 'SELECT * FROM '.$mdl.' WHERE op_tran_date BETWEEN ? AND ? AND op_type="LABOR"';
            $types = 'ss';
            $response  = $db_conn->customQuery('new', $query, $types, $data);
            break;
        case "fetch_jig_func_w_desc":
            $query = 'SELECT jf.id, jf.item_jig, jf.item_type, jf.opt_on, jf.opt_off, jf.status, pt.pt_desc1, pt.pt_desc2, pt.pt_status FROM '.$mdl.' jf JOIN dbqad_live.pt_mstr pt ON jf.item_type = pt.pt_part WHERE jf.item_jig=?';  
            $types = 's';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_distinct_jig":
            $query = 'SELECT distinct(jf.item_type), concat(pt.pt_desc1, " ", pt.pt_desc2) AS description FROM '.$mdl.' jf JOIN dbqad_live.pt_mstr pt ON jf.item_type = pt.pt_part;';
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_jig_usg_filter_date":
            $query = 'SELECT * FROM '.$mdl.' WHERE tr_date  BETWEEN ? AND ?';
            $types = 'ss';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_jig_usg_check":
            $query = "SELECT * FROM ".$mdl." WHERE cat = 'a.pinjam' or cat = 'c.kembali' AND id_trans != 0 AND id_trans IS NOT NULL";
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_jig_trans_sched":
            $query = 'SELECT * FROM '.$mdl.' WHERE end_date = DATE_SUB(CURDATE(), INTERVAL 1 DAY) or status = "open"';
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        default:
            $response = "action not available in jig db handle";
    }
    return $response;
}

function jig_db_test_handle($db_conn, $data, $action, $model, $table) {
    $mdl = $model[$table]->table;
    switch($action) {
        case "fetch_end_date":
            $query = 'SELECT * FROM '.$mdl.' WHERE end_date BETWEEN ? AND ?';
            $types = 'ss';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
          default:
            $response = "action not available in jig db handle";
    }
    return $response;
}

