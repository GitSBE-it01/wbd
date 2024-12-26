<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';

set_time_limit(3600);
// SELECT tr_nbr, tr_date FROM `otb_full` WHERE tr_date < '2023-01-01'
function data_otb() {
    $entry = [];
    for($i=2134029; $i<2142765; $i+=101) {
        $start_time = microtime(true);
        $ii = $i + 100;
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
        foreach($op_hist as $key=>$value) {
            $entry[]=$value;
        }
        $op_hist = [];
        echo 'jumlah data entry yg di db: '.count($entry)."</br>";
        if(count($entry)>100) {
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
            $insert = DB::execQuery($query,"ssssssisssssssssdidddssssssiidisissisdsssss",$entry);
            echo count($entry).'data inserted '.$insert.' selama '.number_format($elapsed_time, 2).' detik</br>';
            $entry = [];
        }
    }
    if(count($entry) !== 0) {
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
        $insert = DB::execQuery($query,"ssssssisssssssssdidddssssssiidisissisdsssss",$entry);
        echo count($entry).'data inserted '.$insert.' selama '.number_format($elapsed_time, 2).' detik</br>';
        $entry = [];
    }
    return;
}

echo "====================================================================</br>";
echo "otb data download</br>";
echo "====================================================================</br>";
$start_time = microtime(true);
data_otb();
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";



?>
