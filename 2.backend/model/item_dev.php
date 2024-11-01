<?php
$model['id_bom'] = new Model('db_wbd.id_bom',
[
    'id::i',
	'ps_par::s',
	'ps_comp::s',
	'ps_qty_per::d',
	'ps_start::s',
	'ps_end::s',
	'ps_ps_code::s',
	'data_date::s',
],
'id::i');

$model['id_mstr'] = new Model('db_wbd.id_master',
[
    'id::i',
	'item_number::s',
	'desc1::s',
	'desc2::s',
	'item_site::s',
	'item_status::s',
	'prod_line::s',
	'pm_code::s',
	'buyer::s',
	'rout_cek::s',
	'bom_cek::s',
],
'id::i');

?>