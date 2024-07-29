<?php
function new_type_handle($db_conn, $data, $action, $model, $table) {
    $mdl = $model[$table]->table;
    switch($action) {
        case "fetch_join_data":
            $query = 'SELECT * FROM '.$mdl.' mt JOIN db_wbd.ntr_hd hd on mt.item_number = hd.item_number';
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        case "fetch_wo_prot_with_desc":
            $query = 'SELECT * FROM '.$mdl.' wo JOIN dbqad_live.pt_mstr mt on wo.wo_part = mt.pt_part WHERE wo.wo_status="R" AND wo.wo_nbr LIKE "%prot%"';
            $types = '';
            $response  = $db_conn->customQuery('', $query, $types, $data);
            break;
        default:
            $response = "action not available";
    }
    return $response;
}

