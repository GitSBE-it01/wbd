<?php
// 2829199 AND 3257958
/*
op_wo_nbr as work_order,
wo_ord_date as order_date,
wo_rel_date as release_date,
wo_due_date as due_date,
wo_stat_close_date as wo_close_date,
wo_status as wo_status,
op_trnbr as tran_nbr,
op_part as item_number,
pt_desc1 as description1,
pt_desc2 as description2,
pt_pm_code as pm,
op_wo_lot as id,
op_date as eff_date,
op_tran_date as tran_date,
op_wo_op as operation,
wr_desc as op_desc,
(op_qty_comp * op_std_run) as std_run_time,
wr_men_mch as run_crew,
op_act_run as act_run_time,
wr_setup as std_setup,
op_act_setup as act_setup,
op_std_units as std_unit,
op_act_units as act_unit,
op_wkctr as work_center,
wc_dept as department,
op_emp as employee,
op_type as type,
wo_qty_ord as qty_ord,
wo_qty_comp as qty_comp,
op_qty_comp as quantity,
op_qty_rwk as qty_rwk,
rsn_type as reason_type,
op_rsn_rwk as rework_reason,
rsn_desc as rsn_desc,
op_qty_rjct as qty_reject,
op_rsn_rjct as reject_reason,
op_comment as comment,
op_time as trans time,
op_rsn as reason,
CASE 
    when op_type='DOWN' then op_act_run 
    else 0
end as down_time,
op_userid as user_id,
wo_rmks as remarks,
ro__qade01 as qad_dec_fld,
wo_so_job as sales_job,
wo_vend as supplier,
pt_buyer as buyer_planner,
op_doc_id as document,
op__dec01 as act_run_crew

"SELECT 
        op_wo_nbr as work_order,
        wo_ord_date as order_date,
        wo_rel_date as release_date,
        wo_due_date as due_date,
        wo_stat_close_date as wo_close_date,
        wo_status as wo_status,
        op_trnbr as tran_nbr,
        op_part as item_number,
        pt_desc1 as description1,
        pt_desc2 as description2,
        pt_pm_code as pm,
        op_wo_lot as id,
        op_date as eff_date,
        op_tran_date as tran_date,
        op_wo_op as operation,
        wr_desc as op_desc,
        (op_qty_comp * op_std_run) as std_run_time,
        wr_men_mch as run_crew,
        op_act_run as act_run_time,
        wr_setup as std_setup,
        op_act_setup as act_setup,
        op_std_units as std_unit,
        op_act_units as act_unit,
        op_wkctr as work_center,
        wc_dept as department,
        op_emp as employee,
        op_type as type,
        wo_qty_ord as qty_ord,
        wo_qty_comp as qty_comp,
        op_qty_comp as quantity,
        op_qty_rwrk as qty_rwk,
        rsn_type as reason_type,
        op_rsn_rwrk as rework_reason,
        rsn_desc as rsn_desc,
        op_qty_rjct as qty_reject,
        op_rsn_rjct as reject_reason,
        op_comment as comment,
        op_time as trans_time,
        op_rsn as reason,
        CASE 
            when op_type='DOWN' then op_act_run 
            else 0
        end as down_time,
        op_userid as user_id,
        wo_rmks as remarks,
        ro__qade01 as qad_dec_fld,
        wo_so_job as sales_job,
        wo_vend as supplier,
        pt_buyer as buyer_planner,
        op_doc_id as document,
        op__dec01 as act_run_crew
    FROM pub.op_hist op 
    JOIN pub.wo_mstr wo ON op.op_wo_lot = wo.wo_lot
    JOIN pub.wc_mstr wc ON op.op_wkctr = wc.wc_wkctr
    JOIN pub.wr_route wr 
        ON op.op_wo_lot = wr.wr_lot
        AND op.op_wo_op = wr.wr_op
    LEFT JOIN pub.rsn_ref rsn ON op.op_rsn_rwrk = rsn.rsn_code
    LEFT JOIN pub.pt_mstr pt ON op.op_part = pt.pt_part
    LEFT JOIN pub.ro_det ro ON wo.wo_routing = ro.ro_routing
    WHERE 
        op_trnbr BETWEEN $i AND $ii 
        AND (op_type='labor' OR op_type='down') 
        AND rsn_type = 'REWORK'
    WITH (NOLOCK, READPAST NOWAIT)";

*/

function data_otb() {
    for($i=3256063; $i<3257959; $i+=501) {
        $start_time = microtime(true);
        $ii = $i + 500;
        $query = "SELECT 
            op_wo_nbr as work_order,
            wo_ord_date as order_date,
            wo_rel_date as rel_date,
            wo_due_date as due_date,
            wo_stat_close_date as wo_close_date,
            wo_status as wo_stat,
            op_trnbr as tr_nbr,
            op_part as item_number,
            pt_desc1 as desc1,
            pt_desc2 as desc2,
            pt_pm_code as pm,
            op_wo_lot as id_wo,
            op_date as eff_date,
            op_tran_date as tr_date,
            op_wo_op as operation,
            wr_desc as op_desc,
            (op_qty_comp * op_std_run) as std_run,
            wr_men_mch as run_crew,
            op_act_run as act_run,
            wr_setup as std_setup,
            op_act_setup as act_setup,
            op_std_units as std_unit,
            op_act_units as act_unit,
            op_wkctr as wc,
            wc_dept as dept,
            op_emp as emp,
            op_type as type,
            wo_qty_ord as qty_ord,
            wo_qty_comp as qty_compl,
            op_qty_comp as qty,
            op_qty_rwrk as qty_rwk,
            op_rsn_rwrk as rework_reason,
            op_qty_rjct as qty_rjk,
            op_rsn_rjct as rjc_rsn,
            op_comment as comment,
            op_time as trans_time,
            op_rsn as reason,
            CASE 
                when op_type='DOWN' then op_act_run 
                else 0
            end as down_time,
            op_userid as user_id,
            wo_rmks as rmrks,
            wo_so_job as sales_job,
            wo_vend as supplier,
            pt_buyer as buyer
        FROM pub.op_hist op 
        JOIN pub.wo_mstr wo ON op.op_wo_lot = wo.wo_lot
        JOIN pub.wc_mstr wc ON op.op_wkctr = wc.wc_wkctr
        JOIN pub.wr_route wr 
            ON op.op_wo_lot = wr.wr_lot
            AND op.op_wo_op = wr.wr_op
        LEFT JOIN pub.pt_mstr pt ON op.op_part = pt.pt_part
        WHERE 
            op_trnbr BETWEEN $i AND $ii 
            AND (op_type='labor' OR op_type='down') 
        WITH (NOLOCK, READPAST NOWAIT)";
        $op_hist = odbc_qad::execQuery($query,'');
        echo 'jumlah data op hist yg di db: '.count($op_hist)."</br>";

        $query = 'INSERT INTO `otb_full`(
                `work_order`,
                `order_date`,
                `rel_date`,
                `due_date`,
                `wo_close_date`,
                `wo_stat`,
                `tr_nbr`,
                `item_number`,
                `desc1`,
                `desc2`,
                `pm`,
                `id_wo`,
                `eff_date`,
                `tr_date`,
                `operation`,
                `op_desc`,
                `std_run`,
                `run_crew`,
                `act_run`,
                `std_setup`,
                `act_setup`,
                `std_unit`,
                `act_unit`,
                `wc`,
                `dept`,
                `emp`,
                `type`,
                `qty_ord`,
                `qty_compl`,
                `qty`,
                `qty_rwk`,
                `rework_reason`,
                `qty_rjk`,
                `rjc_rsn`,
                `comment`,
                `trans_time`,
                `reason`,
                `down_time`,
                `user_id`,
                `rmrks`,
                `sales_job`,
                `supplier`,
                `buyer`
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $end_time = microtime(true);
        $elapsed_time = $end_time - $start_time;
        if(count($op_hist)>0) {
            $insert = DB::execQuery($query,"ssssssisssssssssdidddssssssiidisissisdsssss",$op_hist);
            echo count($op_hist).'data inserted '.$insert.' selama '.number_format($elapsed_time, 2).' detik</br>';
            $op_hist = [];
        }
    }
    return;
}

/*
    $query = "UPDATE `otb_temp_data` SET
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
        WHERE id_wo =?           
            )";
    echo count($full).'</br>';
        if($full) {
            $insert = DB::execQuery($query,"sssssiissss",$full);
            echo count($full).'data inserted '.$insert.'</br>';
        }
        return;
    }
    
*/

    /*
fixxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
   $query = "SELECT * FROM dbqad_live.rsn_ref";
    $rsn_ref = DB::execQuery($query,'');
    $query = "SELECT * FROM dbqad_live.pt_mstr";
    $item = DB::execQuery($query,'');
    $full = [];
    for($i=3181310; $i<3257958; $i+=251) {
        $ii = $i+250;
        $query = "SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN $i AND $ii AND (op_type='labor' OR op_type='down') WITH (NOLOCK, READPAST NOWAIT)";
        $op_hist = odbc_qad::execQuery($query,'');
        if(count($op_hist)>0) {
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
                    'std_run'=>$set['op_qty_comp'] * $set['op_std_run'],
                ]; // 23
                $cek = array_filter($item, function($itm) use ($set) {
                    return $itm['pt_part'] === $set['op_part'];
                });
                if(count($cek)===1) {
                    foreach($cek as $st) {  
                        $data['desc1']= $st['pt_desc1'];
                        $data['desc2']= $st['pt_desc2'];
                        $data['pm']= $st['pt_pm_code'];
                        $data['buyer']= $st['pt_buyer'];
                    }
                } else {
                    if(count($cek)>1) {
                        for($i=0; $i<1; $i++) {
                            $st = $cek[0];
                            $data['desc1']= $st['pt_desc1'];
                            $data['desc2']= $st['pt_desc2'];
                            $data['pm']= $st['pt_pm_code'];
                            $data['buyer']= $st['pt_buyer'];
                        }
                    } else {
                        $data['desc1']= '';
                        $data['desc2']= '';
                        $data['pm']= '';
                        $data['buyer']= '';
                    }
                }

                if(isset($set['op_rsn_rwrk'])) {
                    $cek = array_filter($rsn_ref, function($rsn) use ($set) {
                        return $rsn['rsn_code'] === $set['op_rsn_rwrk'];
                    });
                    if(count($rsn_ref)===1) {
                        foreach($cek as $st) {  
                            $data['rsn_type'] = $st['rsn_type'];
                            $data['rsn_desc'] = $st['rsn_desc'];
                        }
                    } else {
                        $data['rsn_type'] = '';
                        $data['rsn_desc'] = '';
                    }
                } else {
                    $data['rsn_type'] = '';
                    $data['rsn_desc'] = '';
                }
                $data['down_time'] = $set['op_type'] === 'DOWN' ? $set['op_act_run'] : 0;
                $data['qty'] = $set['op_qty_comp'];
                if(isset($data['item_number'])) {
                    $full[]=$data;
                }
            }
        }
        $query = 'INSERT INTO `otb_temp_data`(
                `work_order`,`tr_nbr`,`item_number`,`id_wo`,`eff_date`,`tr_date`,`operation`,`act_run`,`act_setup`,`std_unit`,`act_unit`,`wc`,`dept`,`emp`,`type`,`qty_rwk`,`rework_reason`,`qty_rjk`,`rjc_rsn`,`comment`,`trans_time`,`reason`,`user`,`std_run`,`desc1`,`desc2`,`pm`,`buyer`,`rsn_type`,`rsn_desc`, `down_time`, `qty`
            ) VALUES (
                ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
            )';
        if(count($full)>0) {
            $insert = DB::execQuery($query,"sissssiddssssssisississdssssssdi",$full);
            echo count($full).'data inserted '.$insert.'</br>';
            $full = [];
        }
    }   
    return;
fixxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


    $wo_dt =[];
    $op_hist = [];
    $full =[];
    for($i=3255883; $i<3257959; $i+=251) {
        $ii = $i+250;
        $query = "SELECT * FROM db_wbd.otb_temp_data WHERE tr_nbr BETWEEN $i AND $ii AND order_date IS NULL";
        $basic_dt = DB::execQuery($query,'');
        foreach($basic_dt as $set) {
            $data = [];
            $cek = [];
            $data['qty']=$set['qty'];
            if(count($wo_dt)>0) {
                $cek = array_filter($wo_dt, function($wo) use($set) {
                    return $wo['wo_lot'] === $set['id_wo'];
                });
            }
            if(count($cek)===0) {
                $query = "SELECT * FROM dbqad_live.wo_mstr WHERE wo_lot='".$set['id_wo']."'";
                $wo__ = DB::execQuery($query,'');
                $wo_dt[] = $wo__;
                $cek = $wo__;
            } 
            if(count($cek)===1) {
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
            } //10 total 37
            $cek = [];
            if(count($op_hist)>0) {
                $cek = array_filter($op_hist, function($op) use($set) {
                    return $op['op_trnbr'] === $set['tr_nbr'];
                });
            }
            if(count($cek)===0) {
                $query = "SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN $i AND $ii AND (op_type='labor' OR op_type='down') WITH (NOLOCK, READPAST NOWAIT)";
                $op_hist = odbc_qad::execQuery($query,'');
            }

            $data['std_run'] = $data['qty'] * $set['std_run'];

            $data['down_time'] = $set['op_type'] === 'DOWN' ? $set['act_run'] : 0;
            $data['tr_nbr']=$set['tr_nbr'];
            $full[]=$data;
        }
    }


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
        `rsn_type`,
        `rsn_desc`

                (
            [work_order] => 06050174
            [tr_nbr] => 3127959
            [item_number] => 2VDDTTTC1897
            [id_wo] => 1191261
            [eff_date] => 2023-09-15
            [tr_date] => 2023-09-15
            [operation] => 10
            [act_run] => 10.0000000000
            [act_setup] => .2330000000
            [std_unit] => 0
            [act_unit] => 0
            [wc] => TWD
            [dept] => P1.ASSY
            [emp] => TWD-A1
            [type] => LABOR
            [qty_rwk] => 0.0000000000
            [rework_reason] => 
            [qty_rjk] => 0.0000000000
            [rjc_rsn] => 
            [comment] => 2o (QX-AL82C)
            [trans_time] => 56895
            [reason] => 
            [user] => mfg
            [desc1] => VC ASSY-SATORI TW29RN-B-
            [desc2] => 8 (DIPROD)
            [pm] => M
            [buyer] => M-PLANER
            [rsn_type] => 
            [rsn_desc] => 

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



                         
            $query = "SELECT * FROM pub.wr_route WHERE wr_lot='".$op_hist[0]['op_wo_lot']."' AND wr_op='".$op_hist[0]['op_wo_op']."'";
            $wr_route = odbc_qad::execQuery($query,'');

            if(count($wr_route)===1) {
                $data['op_desc'] = $wr_route[0]['wr_desc'];
                $data['run_crew'] = $wr_route[0]['wr_men_mch'];
                $data['std_setup'] = $wr_route[0]['wr_setup'];
            } // 3 Total 42

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


?>
