<?php
$model['pn_dept'] = new Model('dbpick_now.dept_new',
[
    'assyLine::s',
	'dept::s',
],
'assyLine::s');

$model['pn_loc'] = new Model('dbpick_now.loc_dept',
[
    'loc::s',
	'dept::s',
],
'loc::s');

$model['pn_loc'] = new Model('dbpick_now.loc_dept',
[
    'loc::s',
	'dept::s',
],
'loc::s');

$model['pn_pic_cat'] = new Model('dbpick_now.pic_part_category',
[
    'id::i',
    'tipe::s',
    'optr::s',
    'part_cat::s',
],
'id::i');

$model['pn_result'] = new Model('dbpick_now.result_fix',
[
    'data_date::s',
    'item::s',
    '_desc::s',
    'remark::s',
    'lot__id::s',
    'loc__line::s',
    'dept::s',
    'qty::d',
    'valAcc::d',
    'qty_OH::d',
    'lotOH::s',
    '_date::s',
    'rel_dt::s',
    'due_dt::s',
    'wo_rmks::s',
    'pic::s',
    'pick::s',
    'id_new::s',
    'id::i',
    'item_id::s',
    '_desc2::s',
    'old_id::s',
],
'id::i');

?>