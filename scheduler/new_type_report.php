<?php
function ntr_master_sched() {
    $query1 = 'SELECT 
    distinct(a.wo_part) AS item_number,
    CONCAT(b.pt_desc1," ", b.pt_desc2) AS _desc,
    b.pt_added,
    a.wo_status
    FROM dbqad_live.wo_mstr a
    JOIN dbqad_live.pt_mstr b 
    ON a.wo_part = b.pt_part 
    WHERE a.wo_nbr LIKE "%prot%"';
    $query2 = 'SELECT distinct(item_number) FROM db_wbd.ntr_master';

    $data1 = DB::execQuery($query1, '');
    $data2 = DB::execQuery($query2, '');
    $cek = [];
    foreach($data2 as $set) {
        $cek[] = $set['item_number'];
    }
    $query = 'INSERT INTO ntr_master (item_number,_desc, fo_before_brk_in ,tol_fo_before ,fo_after_brk_in ,tol_fo_after, added, status_wo) VALUES (?,?,?,?,?,?,?,?)';
    $input_dt = [];
    foreach($data1 as $set) {
        if(!in_array($set['item_number'], $cek)) {
            $cek[]=$set['item_number'];
            $set['fo_before_brk_in'] = 0;
            $set['tol_fo_before'] = 0;
            $set['fo_after_brk_in'] = 0;
            $set['tol_fo_after'] = 0;
            $new_date = DateTime::createFromFormat('d/m/y', $set['pt_added']);
            $new_stat = $set['wo_status'];
            unset($set['pt_added']);
            unset($set['wo_status']);
            $set['added']= $new_date->format('Y-m-d');
            $set['status_wo'] = $new_stat;
            $input_dt[$set['item_number']] = $set;
        } else {
            if($set['wo_status'] === 'R') {
                $input_dt[$set['item_number']]['status_wo'] = $set['wo_status'];
            }
        }
    }
    $input_fix = [];
    foreach($input_dt as $set) {
        if(isset($set['item_number'])) {
            $input_fix[] = $set;
        }
    }
    
    if(count($input_fix) > 0) {
        echo '<pre>';
        print_r(array_slice($input_fix,0,5));
        echo '</pre>';
        echo count($input_fix).'</br>';
        DB::execQuery($query, 'ssiiiiss', $input_fix);
        echo count($input_fix).' data inputted </br>';
    } else {
        echo 'data is up to date </br>';
    }
    $input_fix =null;
    $input_dt =null;
    echo 'NTR Scheduler Succesfully run </br>';
    return;
}