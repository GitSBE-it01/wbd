<?php
function data_otb() {
    $query = "SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN 2939592 AND 3057958 AND (op_type='labor' OR op_type='down') WITH (NOLOCK, READPAST NOWAIT)";
    $op_hist = odbc_qad::execQuery($query,'');
    $full = [];
    foreach($op_hist as $set) {
        $data = [
            'work_order'=>$set['op_wo_nbr'],
            'tr_nbr'=>$set['op_trnbr'],
            'item_number'=>$set['op_part'],
            'id_wo'=>$set['op_wo_lot'],
            'eff_date'=>$set['op_date'],
            'tr_date'=>$set['op_tran_date'],
            'operation'=>$set['op_wo_op'],
            'act_run'=>$set['op_act_run'],
            'act_setup'=>$set['op_act_setup'],
            'std_unit'=>$set['op_std_units'],
            'act_unit'=>$set['op_act_units'],
            'wc'=>$set['op_wkctr'],
            'dept'=>$set['op_dept'],
            'emp'=>$set['op_emp'],
            'type'=>$set['op_type'],
            'qty_rwk'=>$set['op_qty_rwrk'],
            'rework_reason'=>$set['op_rsn_rwrk'],
            'qty_rjk'=>$set['op_qty_rjct'],
            'rjc_rsn'=>$set['op_rsn_rjct'],
            'comment'=>$set['op_comment'],
            'trans_time'=>$set['op_time'],
            'reason'=>$set['op_rsn'],
            'user'=>$set['op_userid'],
        ]; // 23
        $full[]=$data;
    }
    echo count($full).'</br>';
    echo "<pre>";
    print_r(array_slice($full,0,5));
    echo "</pre>";
    $op_hist = [];
    $query = 'INSERT INTO `otb_temp_data`(
    `work_order`,
    `tr_nbr`,
    `item_number`,
    `id_wo`,
    `eff_date`,
    `tr_date`,
    `operation`,
    `act_run`,
    `act_setup`,
    `std_unit`,
    `act_unit`,
    `wc`,
    `dept`,
    `emp`,
    `type`,
    `qty_rwk`,
    `rework_reason`,
    `qty_rjk`,
    `rjc_rsn`,
    `comment`,
    `trans_time`,
    `reason`,
    `user`) VALUES (
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?
        )';
    echo count($full).'</br>';
        if($full) {
            $insert = DB::execQuery($query,"sissssiddssssssisississ",$full);
            echo count($full).'data inserted '.$insert.'</br>';
        }

    /*
    $query = "SELECT * FROM db_wbd.otb_temp_data WHERE tr_nbr BETWEEN 2830658 AND 2830734";
    $basic_dt = DB::execQuery($query,'');
    
    $data_wo = [];
    $full = [];
    foreach($basic_dt as $set) {
        $cek = [];
        if(count($data_wo) > 0 ) {
            $cek = array_filter($data_wo, function($dt) use ($set) {
                return $dt['wo_lot'] === $set['id_wo'];
            });
        }
        $data = [];
        if(count($cek)===0) {
            $query = "SELECT * FROM pub.wo_mstr wo JOIN pub.wr_route wr ON wo.wo_lot = wr.wr_lot  WHERE wo.wo_lot='".$set['id_wo']."' WITH (NOLOCK, READPAST NOWAIT)";
            $wo = odbc_qad::execQuery($query,'');
            foreach($wo as $st){
                $data_wo[] =$st;
            }
            $cek = $wo[0];
            $data['order_date'] = $cek['wo_ord_date'];
            $data['rel_date'] = $cek['wo_rel_date'];
            $data['due_date'] = $cek['wo_due_date'];
            $data['wo_close_date'] = $cek['wo_stat_close_date'];
            $data['wo_stat'] = $cek['wo_status'];
            $data['qty_ord'] = $cek['wo_qty_ord'];
            $data['qty_compl'] = $cek['wo_qty_comp'];
            $data['rmrks'] = $cek['wo_rmks'];
            $data['sales_job'] = $cek['wo_so_job'];
            $data['supplier'] = $cek['wo_vend'];
        } else {
            foreach($cek as $st) {
                $data['order_date'] = $st['wo_ord_date'];
                $data['rel_date'] = $st['wo_rel_date'];
                $data['due_date'] = $st['wo_due_date'];
                $data['wo_close_date'] = $st['wo_stat_close_date'];
                $data['wo_stat'] = $st['wo_status'];
                $data['qty_ord'] = $st['wo_qty_ord'];
                $data['qty_compl'] = $st['wo_qty_comp'];
                $data['rmrks'] = $st['wo_rmks'];
                $data['sales_job'] = $st['wo_so_job'];
                $data['supplier'] = $st['wo_vend'];
            }
        }

        $data['tr_nbr']= $set['tr_nbr'];
        $full[]= $data;
    }
    $query = 'UPDATE `otb_temp_data` SET
    `order_date`=?,
    `rel_date`=?,
    `due_date`=?,
    `wo_close_date`=?,
    `wo_stat`=?,
    `qty_ord`=?,
    `qty_compl`=?,
    `rmrks`=?,
    `sales_job`=?,
    `supplier`=?
    WHERE 
    `tr_nbr`=?';

    if($data) {
        $update = DB::execQuery($query,"sssssiisssi",$full);
        echo $update;
    }

     /*
    $query = "SELECT * FROM dbqad_live.wo_mstr";
    $wo_mstr = DB::execQuery($query,'');
    $query = "SELECT * FROM dbqad_live.rsn_ref";
    $rsn_ref = DB::execQuery($query,'')
    $full = [];
    foreach($basic_dt as $set) {
        $cek = array_filter($item, function($itm) use ($set) {
            return $itm['pt_part'] === $set['item_number'];
        });
        if(count($cek)===1) {
            foreach($cek as $st) {  
                $data['desc1']= $st['pt_desc1'];
                $data['desc2']= $st['pt_desc2'];
                $data['pm']= $st['pt_pm_code'];
                $data['buyer']= $st['pt_buyer'];
            }
        }
        if($set['rework_reason'] !== '') {
            $cek = array_filter($rsn_ref, function($rsn) use ($set) {
                return $rsn['rsn_code'] === $set['rework_reason'];
            });
            if(count($rsn_ref)===1) {
                foreach($cek as $st) {  
                    $data['rsn_type'] = $st['rsn_type'];
                    $data['rsn_desc'] = $st['rsn_desc'];
                }
            }
        } else {
            $data['rsn_type'] = '';
            $data['rsn_desc'] = '';
        }
        $data['tr_nbr'] = $set['tr_nbr'];
        $full[] = $data;
    }

    $query = 'UPDATE `otb_temp_data` SET
    `desc1`=?,
    `desc2`=?,
    `pm`=?,
    `buyer`=?,
    `rsn_type`=?,
    `rsn_desc`=?
    WHERE 
    `tr_nbr`=?';
        if($data) {
            $update = DB::execQuery($query,"ssssssi",$full);
            echo $update;
        }

   
    $query = "SELECT * FROM db_wbd.otb_temp_data WHERE tr_nbr BETWEEN 2830658 AND 2830734";
    $basic_dt = DB::execQuery($query,'');
    echo 'data count = '.count($basic_dt).'</br>';
    echo '<pre>';
    print_r(array_slice($basic_dt,0,5));
    echo '</pre>';

    $query = "SELECT * FROM dbqad_live.pt_mstr";
    $item = DB::execQuery($query,'');
;
    $full = [];
    foreach($basic_dt as $set) {
        $cek = array_filter($item, function($itm) use ($set) {
            return $itm['pt_part'] === $set['item_number'];
        });
        if(count($cek)===1) {
            foreach($cek as $st) {
                $data['desc1']= $st['pt_desc1'];
                $data['desc2']= $st['pt_desc2'];
                $data['pm']= $st['pt_pm_code'];
                $data['buyer']= $st['pt_buyer'];
            }
        }
        $data['tr_nbr'] = $set['tr_nbr'];
        $full[] = $data;
    }

$query = 'UPDATE `otb_temp_data` SET
    `desc1`=?,
    `desc2`=?,
    `pm`=?,
    `buyer`=?
    WHERE 
    `tr_nbr`=?';
        if($data) {
            $update = DB::execQuery($query,"ssssi",$full);
            echo $update;
        }

    


    $query = "SELECT * FROM dbqad_live.rsn_ref";
    $rsn_ref = DB::execQuery($query,'');
    echo 'data count = '.count($rsn_ref).'</br>';
    echo '<pre>';
    print_r(array_slice($rsn_ref,0,10));
    echo '</pre>';
    $query = "SELECT * FROM dbqad_live.pt_mstr";
    $pt_mstr = DB::execQuery($query,'');
    echo 'data count = '.count($pt_mstr).'</br>';
    echo '<pre>';
    print_r(array_slice($pt_mstr,0,10));
    echo '</pre>';

    $query = "SELECT * FROM dbqad_live.wo_mstr";
    $wo_mstr = DB::execQuery($query,'');
    echo 'data count = '.count($wo_mstr).'</br>';
    echo '<pre>';
    print_r(array_slice($wo_mstr,0,10));
    echo '</pre>';
    3257958

    $count = 0;
    for($i=2829898; $i<2830734; $i++) {
        $query = "SELECT * FROM pub.op_hist WHERE op_trnbr='".$i."' AND (op_type='labor' OR op_type='down') WITH (NOLOCK, READPAST NOWAIT)";
        $op_hist = odbc_qad::execQuery($query,'');
        if(count($op_hist) > 0 ) {
            $data = [
                'work_order'=>$op_hist[0]['op_wo_nbr'],
                'tr_nbr'=>$op_hist[0]['op_trnbr'],
                'item_number'=>$op_hist[0]['op_part'],
                'id_wo'=>$op_hist[0]['op_wo_lot'],
                'eff_date'=>$op_hist[0]['op_date'],
                'tr_date'=>$op_hist[0]['op_tran_date'],
                'operation'=>$op_hist[0]['op_wo_op'],
                'act_run'=>$op_hist[0]['op_act_run'],
                'act_setup'=>$op_hist[0]['op_act_setup'],
                'std_unit'=>$op_hist[0]['op_std_units'],
                'act_unit'=>$op_hist[0]['op_act_units'],
                'wc'=>$op_hist[0]['op_wkctr'],
                'dept'=>$op_hist[0]['op_dept'],
                'emp'=>$op_hist[0]['op_emp'],
                'type'=>$op_hist[0]['op_type'],
                'qty_rwk'=>$op_hist[0]['op_qty_rwrk'],
                'rework_reason'=>$op_hist[0]['op_rsn_rwrk'],
                'qty_rjk'=>$op_hist[0]['op_qty_rjct'],
                'rjc_rsn'=>$op_hist[0]['op_rsn_rjct'],
                'comment'=>$op_hist[0]['op_comment'],
                'trans_time'=>$op_hist[0]['op_time'],
                'reason'=>$op_hist[0]['op_rsn'],
                'user'=>$op_hist[0]['op_userid'],
            ]; // 23
            $query = "SELECT * FROM dbqad_live.pt_mstr WHERE pt_part='".$op_hist[0]['op_part']."'";
            $pt_mstr = DB::execQuery($query,'');
            if(count($pt_mstr)===1) {
                $data['desc1']= $pt_mstr[0]['pt_desc1'];
                $data['desc2']= $pt_mstr[0]['pt_desc2'];
                $data['pm']= $pt_mstr[0]['pt_pm_code'];
                $data['buyer']= $pt_mstr[0]['pt_buyer'];
            } //27
            $query = "SELECT * FROM dbqad_live.wo_mstr WHERE wo_lot='".$op_hist[0]['op_wo_lot']."'";
            $wo_mstr = DB::execQuery($query,'');
            if(count($wo_mstr)===1) {
                $data['order_date'] = $wo_mstr[0]['wo_ord_date'];
                $data['rel_date'] = $wo_mstr[0]['wo_rel_date'];
                $data['due_date'] = $wo_mstr[0]['wo_due_date'];
                $data['wo_close_date'] = $wo_mstr[0]['wo_stat_close_date'];
                $data['wo_stat'] = $wo_mstr[0]['wo_status'];
                $data['qty_ord'] = $wo_mstr[0]['wo_qty_ord'];
                $data['qty_compl'] = $wo_mstr[0]['wo_qty_comp'];
                $data['rmrks'] = $wo_mstr[0]['wo_rmks'];
                $data['sales_job'] = $wo_mstr[0]['wo_so_job'];
                $data['supplier'] = $wo_mstr[0]['wo_vend'];
            } //10 total 37

            if($op_hist[0]['op_rsn_rwrk'] ==="" ) {
                $data['rsn_type'] = "";
                $data['rsn_desc'] = "";
            } else {
                $query = "SELECT * FROM dbqad_live.rsn_ref WHERE rsn_code='".$op_hist[0]['op_rsn_rwrk']."'";
                $rsn_ref = DB::execQuery($query,'');
                if(count($rsn_ref)===1) {
                    $data['rsn_type'] = $rsn_ref[0]['rsn_type'];
                    $data['rsn_desc'] = $rsn_ref[0]['rsn_desc'];
                } // 2 Total 39
            }

            $query = "SELECT * FROM pub.wr_route WHERE wr_lot='".$op_hist[0]['op_wo_lot']."' AND wr_op='".$op_hist[0]['op_wo_op']."'";
            $wr_route = odbc_qad::execQuery($query,'');

            if(count($wr_route)===1) {
                $data['op_desc'] = $wr_route[0]['wr_desc'];
                $data['run_crew'] = $wr_route[0]['wr_men_mch'];
                $data['std_setup'] = $wr_route[0]['wr_setup'];
            } // 3 Total 42

            if ($op_hist[0]['op_type'] === "MOVE") {
                $data['qty'] = $op_hist[0]['op_qty_wip'];
            } elseif ($op_hist[0]['op_type'] === "WOSCRAPI" || $op_hist[0]['op_type'] === "WOSCRAPO") {
                $data['qty'] = $op_hist[0]['op_qty_scrap'];
            } else {
                $data['qty'] = $op_hist[0]['op_qty_comp']; 
            } 

            $data['std_run'] = $data['qty'] * $op_hist[0]['op_std_run'];

            $data['down_time'] = $op_hist[0]['op_type'] === 'DOWN' ? $op_hist[0]['op_act_run'] : 0;
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            $query = 'INSERT INTO `otb_temp_data`(
            `work_order`,
            `tr_nbr`,
            `item_number`,
            `id_wo`,
            `eff_date`,
            `tr_date`,
            `operation`,
            `act_run`,
            `act_setup`,
            `std_unit`,
            `act_unit`,
            `wc`,
            `dept`,
            `emp`,
            `type`,
            `qty_rwk`,
            `rework_reason`,
            `qty_rjk`,
            `rjc_rsn`,
            `comment`,
            `trans_time`,
            `reason`,
            `user`,
            `desc1`,
            `desc2`,
            `pm`,
            `buyer`,
            `order_date`,
            `rel_date`,
            `due_date`,
            `wo_close_date`,
            `wo_stat`,
            `qty_ord`,
            `qty_compl`,
            `rmrks`,
            `sales_job`,
            `supplier`,
            `rsn_type`,
            `rsn_desc`,
            `op_desc`,
            `run_crew`,
            `std_setup`,
            `qty`,
            `std_run`,
            `down_time`) VALUES (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?)';
            if($data)
            $insert = DB::execQuery($query,'sissssiddssssssisissssssssssssssiissssssidddd',[$data]);
        }
        $count++;
    }
    echo $count;
    */
    return;
}




?>
