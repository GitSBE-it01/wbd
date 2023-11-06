<?php
$jig_function = array(
    'cacheFolder'=> CACHE,
    'expTime'=> 43200,
    'cacheKey'=> 'jig_function',
    'query'=> "SELECT * FROM db_jig.jig_function"
);


$item_detail =array(
    'cacheFolder'=> CACHE,
    'expTime'=> 43200,
    'cacheKey'=> 'new_item_detail',
    'query'=> "SELECT distinct(pt_part), pt_desc1, pt_desc2, pt_status FROM dbqad_live.pt_mstr"
);


$jig_master = array(
    'cacheFolder'=> CACHE,
    'expTime'=> 43200,
    'cacheKey'=> 'jig_master',
    'query'=> 'SELECT * FROM jig_master'
);



$jig_location= array(
    'cacheFolder'=> CACHE,
    'expTime'=> 43200,
    'cacheKey'=> 'jig_location',
    'query'=> 'SELECT * FROM jig_location'
);

$jig_trans= array(
    'cacheFolder'=> CACHE,
    'expTime'=> 1,
    'cacheKey'=> 'jig_trans',
    'query'=> 'SELECT * FROM jig_trans WHERE status="open"'
);

$log_location= array(
    'cacheFolder'=> CACHE,
    'expTime'=> 60,
    'cacheKey'=> 'log_location',
    'query'=> 'SELECT * FROM log_location WHERE item_jig LIKE ?'
);

$log_master = array(
    'cacheFolder'=> CACHE,
    'expTime'=> 600,
    'cacheKey'=> 'log_master',
    'query'=> 'SELECT * FROM log_master WHERE item_jig LIKE ?'
);


$log_function = array(
    'cacheFolder'=> CACHE,
    'expTime'=> 60,
    'cacheKey'=> 'log_function',
    'query'=> "SELECT * FROM db_jig.log_function WHERE item_jig LIKE ?"
);


$list_location= array(
    'cacheFolder'=> CACHE,
    'expTime'=> 43200,
    'cacheKey'=> 'list_location',
    'query'=> 'SELECT * FROM list_location'
);

$list_mtnc= array(
    'cacheFolder'=> CACHE,
    'expTime'=> 1,
    'cacheKey'=> 'list_mtnc',
    'query'=> 'SELECT * FROM list_mtnc'
);

$access= 'SELECT * FROM access_config.access_wbd';

$user= 'SELECT * FROM access_config.user_list';

$log_master_query = 'SELECT * FROM log_master WHERE item_jig = ?';
$log_location_query = 'SELECT * FROM log_location WHERE item_jig = ?';
$log_function_query = 'SELECT * FROM log_function WHERE item_type = ?';
$jig_master_query = 'SELECT * FROM jig_master';
$jig_location_query = 'SELECT * FROM jig_location';
$jig_function_query = 'SELECT * FROM jig_function';
$item_detail_query = "SELECT distinct(pt_part), pt_desc1, pt_desc2, pt_status FROM dbqad_live.pt_mstr";
$jig_master_query2 = 'SELECT * FROM jig_master WHERE item_jig = ?';
$jig_location_query2 = 'SELECT * FROM jig_location WHERE item_jig = ?';
$jig_function_query2 = 'SELECT * FROM jig_function WHERE item_jig = ?';
//$employee_db = 'SELECT * FROM db_sb3employee.employee WHERE Site="SBE1"';
$employee_db= array(
    'cacheFolder'=> CACHE,
    'expTime'=> 60,
    'cacheKey'=> 'employ$employee_db',
    'query'=> 'SELECT * FROM db_sb3employee.employee WHERE Site="SBE1"'
);

$codeList = array(
    'jig_function'=> $jig_function,
    'log_function'=> $log_function,
    'new_item_detail'=> $item_detail,
    'jig_location'=> $jig_location,
    'jig_master'=> $jig_master,
    'log_location'=> $log_location,
    'log_master'=> $log_master,
    'list_location'=> $list_location,
    'jig_trans'=>$jig_trans,
    'list_mtnc'=>$list_mtnc,
    'access'=>$access,
    'user'=>$user,
    'log_master_query'=>$log_master_query,
    'log_location_query'=>$log_location_query,
    'log_function_query'=>$log_function_query,
    'jig_master_query'=>$jig_master_query,
    'jig_location_query'=>$jig_location_query,
    'jig_function_query'=>$jig_function_query,
    'item_detail_query'=>$item_detail_query,
    'jig_master_query2'=>$jig_master_query2,
    'jig_location_query2'=>$jig_location_query2,
    'jig_function_query2'=>$jig_function_query2,
    'employee_db'=>$employee_db,
);


?>