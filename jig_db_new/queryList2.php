<?php
$access= 'SELECT * FROM access_config.access_wbd';
$asset= 'SELECT * FROM dbqad_live.pt_mstr';

$user= 'SELECT * FROM access_config.user_list';

$jig_master_query = 'SELECT * FROM jig_master';
$log_master_query = 'SELECT * FROM log_master';
$jig_function_query = 'SELECT * FROM jig_function';
$log_function_query = 'SELECT * FROM log_function';
$jig_location_query = 'SELECT * FROM jig_loc2';
$log_location_query = 'SELECT * FROM log_location';
$ng_daily_query = 'SELECT * FROM dbngvar.ng_daily';
$jig_usage_query = 'SELECT * FROM jig_usage';
$list_mtnc_query = 'SELECT * FROM list_mtnc';

$insert_jig_master_query = 'INSERT INTO jig_master';
$insert_log_master_query = 'INSERT INTO log_master';
$insert_jig_function_query = 'INSERT INTO jig_function';
$insert_log_function_query = 'INSERT INTO log_function';
$insert_jig_location_query = 'INSERT INTO jig_loc2';
$insert_log_location_query = 'INSERT INTO log_location';
$insert_jig_usage_query = 'INSERT INTO jig_usage';

$update_jig_master_query = 'UPDATE jig_master';
$update_log_master_query = 'UPDATE log_master';
$update_jig_function_query = 'UPDATE jig_function';
$update_log_function_query = 'UPDATE log_function';
$update_jig_location_query = 'UPDATE jig_loc2';
$update_log_location_query = 'UPDATE log_location';
$update_jig_usage_query = 'UPDATE jig_usage';

$delete_jig_master_query = 'DELETE FROM jig_master';
$delete_jig_function_query = 'DELETE FROM jig_function';
$delete_jig_location_query = 'DELETE FROM jig_loc2';
$delete_jig_usage_query = 'DELETE FROM jig_usage';


$item_detail_query = "SELECT distinct(pt_part), pt_desc1, pt_desc2, pt_status FROM dbqad_live.pt_mstr";

$list_location= 'SELECT * FROM list_location';

$codeList = array(
    'access'=>$access,
    'asset'=>$asset,
    'user'=>$user,
    'list_location'=> $list_location,
    'log_master_query'=>$log_master_query,
    'log_location_query'=>$log_location_query,
    'log_function_query'=>$log_function_query,
    'jig_master_query'=>$jig_master_query,
    'jig_location_query'=>$jig_location_query,
    'jig_function_query'=>$jig_function_query,
    'item_detail_query'=>$item_detail_query,
    'ng_daily_query'=>$ng_daily_query,
    'insert_jig_location_query'=>$insert_jig_location_query,
    'update_jig_location_query'=>$update_jig_location_query,
    'insert_log_location_query'=>$insert_log_location_query,
    'update_log_location_query'=>$update_log_location_query,
    'insert_jig_master_query' =>$insert_jig_master_query,
    'insert_log_master_query' =>$insert_log_master_query,
    'insert_jig_function_query' =>$insert_jig_function_query,
    'insert_log_function_query' =>$insert_log_function_query,
    'update_jig_master_query' =>$update_jig_master_query,
    'update_log_master_query' =>$update_log_master_query,
    'update_jig_function_query' =>$update_jig_function_query,
    'update_log_function_query' =>$update_log_function_query,
    'delete_jig_master_query' => $delete_jig_master_query,
    'delete_jig_function_query' => $delete_jig_function_query,
    'delete_jig_location_query' => $delete_jig_location_query,

    'jig_usage_query' => $jig_usage_query,
    'insert_jig_usage_query' => $insert_jig_usage_query,
    'update_jig_usage_query' => $update_jig_usage_query,
    'delete_jig_usage_query' => $delete_jig_usage_query,
    'list_mtnc_query' =>$list_mtnc_query
);
