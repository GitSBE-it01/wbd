<?php 
require_once "class.php";

$wobb = new QueryInit('dbqad_live.wod_det');
$wo = new QueryInit('dbqad_live.wo_mstr');
$ld = new QueryInit('dbqad_live.ld_det');
$pt_mstr = new QueryInit('dbqad_live.pt_mstr');


$loc = new QueryInit('dbpick_now.loc_dept');
$pic = new QueryInit('dbpick_now.pic_list');
$dept = new QueryInit('dbpick_now.dept_new');
$pickNow = new QueryInit('dbpick_now.result_fix');
$pic_part = new QueryInit('dbpick_now.pic_part_category');

$codeList = array(
    'wobb'=>$wobb,
    'wo'=>$wo,
    'ld'=>$ld,
    'pt_mstr'=> $pt_mstr,
    'loc'=>$loc,
    'pic'=>$pic,
    'dept'=>$dept,
    'pickNow'=> $pickNow,
    'pic_part'=> $pic_part,
);



?>