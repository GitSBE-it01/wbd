<?php
$model['id_tracker'] = new Model('db_wbd.id_tracker',
[
    'id::i',
    'id_parent::i',
	'item_number::s',
	'desc_::s',
	'site::s',
	'problem::s',
	'action::d',
	'pic::s',
	'etc::s',
	'status::s',
	'remarks::s',
	'added::s',
	'last_mod::s',
],
'id::i');

$model['id_dtl'] = new Model('db_wbd.id_dtl_parent',
[
    'id::i',
	'code::s',
	'parent::s',
	'parent_desc::s',
	'comp::s',
	'comp_desc::s',
	'status_item_comp::s',
	'buyer_planner::s',
	'status_isir::s',
	'need_isir::s',
	'finishing::s',
	'construction::s',
	'material::s',
	'bom_release_date::s',
	'status::s',
	'close_date::s',
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
	'added::s',
	'close_date::s',
	'status::s',
	
],
'id::i');

?>