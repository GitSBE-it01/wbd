<?php

$dmc_vjs = 'SELECT * FROM dmc_vjs d join list_inspect l on d.inspection = l.inspection';
$dmc_vjs_log = 'SELECT * FROM dmc_vjs_log';
$dmc_input = 'SELECT * FROM dmc_input';
$vjs_input = 'SELECT * FROM vjs_input';
$assets = 'SELECT * FROM dbinventaris.astreg_main';
$wo_list = 'SELECT * FROM dbqad_live.wo_mstr w JOIN dbqad_live.pt_mstr p on w.wo_part = p.pt_part';
$vjs_assets = 'SELECT * FROM vjs_list vl join dbinventaris.astreg_main ast on vl.asset_id = ast.id';

$insert_dmc_vjs = 'INSERT INTO dmc_vjs';
$insert_dmc_vjs_log = 'INSERT INTO dmc_vjs_log';
$insert_dmc_input = 'INSERT INTO dmc_input';
$insert_vjs_input = 'INSERT INTO vjs_input';
$insert_assets = 'INSERT INTO dbinventaris';
$insert_vjs_assets = 'INSERT INTO vjs_list';

$update_dmc_vjs = 'UPDATE dmc_vjs';
$update_dmc_vjs_log = 'UPDATE dmc_vjs_log';
$update_dmc_input = 'UPDATE dmc_input';
$update_vjs_input = 'UPDATE vjs_input';
$update_assets = 'UPDATE dbinventaris';
$update_vjs_assets = 'UPDATE vjs_list';

$delete_dmc_vjs = 'DELETE FROM dmc_vjs';
$delete_dmc_vjs_log = 'DELETE FROM dmc_vjs_log';
$delete_dmc_input = 'DELETE FROM dmc_input';
$delete_vjs_input = 'DELETE FROM vjs_input';
$delete_assets = 'DELETE FROM dbinventaris';
$delete_vjs_assets = 'DELETE FROM vjs_list';

$codeList = array(
    'dmc_vjs'=>$dmc_vjs,
    'dmc_input'=>$dmc_input,
    'vjs_input'=>$vjs_input,
    'dmc_vjs_log'=>$dmc_vjs_log,
    'assets'=>$assets,
    'wo_list' => $wo_list,
    'vjs_assets'=>$vjs_assets,

    'insert_dmc_vjs'=>$insert_dmc_vjs,
    'insert_dmc_input'=>$insert_dmc_input,
    'insert_vjs_input'=>$insert_vjs_input,
    'insert_dmc_vjs_log'=>$insert_dmc_vjs_log,
    'insert_assets'=>$insert_assets,
    'insert_vjs_assets'=>$insert_vjs_assets,
    
    'update_dmc_vjs'=>$update_dmc_vjs,
    'update_dmc_input'=>$update_dmc_input,
    'update_vjs_input'=>$update_vjs_input,
    'update_dmc_vjs_log'=>$update_dmc_vjs_log,
    'update_assets'=>$update_assets,
    'update_vjs_assets'=>$update_vjs_assets,
    
    'delete_dmc_vjs'=>$delete_dmc_vjs,
    'delete_dmc_input'=>$delete_dmc_input,
    'delete_vjs_input'=>$delete_vjs_input,
    'delete_dmc_vjs_log'=>$delete_dmc_vjs_log,
    'delete_assets'=>$delete_assets,
    'delete_vjs_assets'=>$delete_vjs_assets,
);

?>