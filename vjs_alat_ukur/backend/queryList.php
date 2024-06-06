<?php 
require_once "class.php";

$master = new QueryInit('dbvjs_online.master_alat');
$point = new QueryInit('dbvjs_online.new_master_point');
$vjs_month = new QueryInit('dbvjs_online.vjs_h');
$vjs_detail = new QueryInit('dbvjs_online.new_vjs_d');


$codeList = array(
    'master'=>$master,
    'point'=>$point,
    'vjs_detail'=>$vjs_detail,
    'vjs_month'=>$vjs_month,
);


?>