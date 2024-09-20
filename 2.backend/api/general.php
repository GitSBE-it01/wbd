<?php
function general_handle($db_conn, $data, $action, $model, $table) {
    $mdl = $model[$table]->table;
    switch($action) {
        case "fetch_item":
            $query = 'SELECT * FROM '.$mdl;
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_rout_active_subcon":
            $query = 'SELECT * FROM '.$mdl.' WHERE ro_wkctr ="subcont"';
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_wo_prot_with_desc":
            $query = 'SELECT 
            distinct(a.wo_part) AS item_number,
	        CONCAT(b.pt_desc1," ", b.pt_desc2) AS _desc FROM '.$mdl.' a
            JOIN dbqad_live.pt_mstr b 
            ON a.wo_part = b.pt_part 
            WHERE a.wo_nbr LIKE "%prot%" AND `wo_status` != "C"';
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_wo_prot_specific_item":
            $query = 'SELECT 
            a.wo_part AS item_number,
	        CONCAT(b.pt_desc1," ", b.pt_desc2) AS _desc,
            a.wo_status as _status,
            a.wo_nbr as work_order,
            a.wo_lot as wo_id,
            a.wo_nbr as wo, 
            a.wo_qty_ord as qty_ord,
            a.wo_rel_datex as rel_date,
            a.wo_due_datex as due_date
            FROM '.$mdl.' a
            JOIN dbqad_live.pt_mstr b 
            ON a.wo_part = b.pt_part 
            WHERE wo_nbr LIKE "%prot%"';
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        default:
            $response = "action not available";
    }
    return $response;
}

