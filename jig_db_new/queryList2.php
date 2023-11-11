<?php
$access= 'SELECT * FROM access_config.access_wbd';

$user= 'SELECT * FROM access_config.user_list';

$log_master_query = 'SELECT * FROM log_master';
$log_location_query = 'SELECT * FROM log_location';
$log_function_query = 'SELECT * FROM log_function';
$jig_master_query = 'SELECT * FROM jig_master';
$jig_location_query = 'SELECT * FROM jig_location';
$jig_function_query = 'SELECT * FROM jig_function';
$item_detail_query = "SELECT distinct(pt_part), pt_desc1, pt_desc2, pt_status FROM dbqad_live.pt_mstr";
$list_location= 'SELECT * FROM list_location';

$codeList = array(
    'access'=>$access,
    'user'=>$user,
    'list_location'=> $list_location,
    'log_master_query'=>$log_master_query,
    'log_location_query'=>$log_location_query,
    'log_function_query'=>$log_function_query,
    'jig_master_query'=>$jig_master_query,
    'jig_location_query'=>$jig_location_query,
    'jig_function_query'=>$jig_function_query,
    'item_detail_query'=>$item_detail_query,
);
