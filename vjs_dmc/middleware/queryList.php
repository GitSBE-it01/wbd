<?php

$asset_vjs_rel = 'SELECT * FROM asset_vjs_rel';
$dmc_vjs = 'SELECT * FROM dmc_vjs d join list_inspect l on d.inspection = l.inspection';
$dmc_vjs_log = 'SELECT * FROM dmc_vjs_log';
$list_category	 = 'SELECT * FROM list_category';
$woid = 'SELECT * FROM dbqad_live.wo_mstr wo LEFT JOIN dbqad_live.pt_mstr pt on wo.wo_part = pt.pt_part';
$list_inspect = 'SELECT * FROM list_inspect';
$insert_dmc_vjs_log = "INSERT INTO dmc_vjs_log";
$assets = 'SELECT * FROM dbinventaris.astreg_main';
$data_input = 'SELECT * FROM data_input';
$insert_data_input = 'INSERT INTO data_input';
$vjs_assets = 'SELECT * FROM vjs_list vl join dbinventaris.astreg_main ast on vl.asset_id = ast.id';

$codeList = array(
    'asset_vjs_rel'=>$asset_vjs_rel,
    'dmc_vjs'=>$dmc_vjs,
    'dmc_vjs_log'=>$dmc_vjs_log,
    'list_category'=>$list_category,
    'list_inspect'=>$list_inspect,
    'woid'=>$woid,
    'assets'=>$assets,
    'data_input'=>$data_input,
    'insert_data_input'=>$insert_data_input,
    'vjs_assets'=>$vjs_assets,
    'insert_dmc_vjs_log'=>$insert_dmc_vjs_log,

);

?>