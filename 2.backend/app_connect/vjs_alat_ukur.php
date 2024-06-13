<?php 
//require_once "D:/xampp/htdocs/wbd/2.backend/class.php";

$master = new QueryInit('dbvjs_online.new_master_alat');
$point = new QueryInit('dbvjs_online.new_master_point');
$vjs_log = new QueryInit('dbvjs_online.new_vjs_log');
$reff = new QueryInit('dbvjs_online.new_reff');

$codeList = array(
    'master'=>$master,
    'point'=>$point,
    'reff'=>$reff,
    'vjs_log'=>$vjs_log,
);


?>