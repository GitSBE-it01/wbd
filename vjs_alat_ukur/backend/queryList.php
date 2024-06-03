<?php 
require_once "class.php";

$master = new QueryInit('dbvjs_online.master_alat');
$point = new QueryInit('dbvjs_online.master_point');
$vjs_detail = new QueryInit('dbvjs_online.vjs_d');
$vjs_month = new QueryInit('dbvjs_online.vjs_h');


$codeList = array(
    'master'=>$master,
    'point'=>$point,
    'vjs_detail'=>$vjs_detail,
    'vjs_month'=>$vjs_month,
);


?>