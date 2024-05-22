<?php 

require_once "backend/class.php";
$jig_master = new QueryInit('jig_master');
$log_master = new QueryInit('log_master');
$jig_function = new QueryInit('jig_function');
$log_function = new QueryInit('log_function');
$list_location = new QueryInit('list_location');


$codeList = array(
    'jig_master'=>$jig_master,
    'log_master'=>$log_master,
    'jig_function'=>$jig_function,
    'log_function'=>$log_function,
    'list_location'=>$list_location,
);


?>