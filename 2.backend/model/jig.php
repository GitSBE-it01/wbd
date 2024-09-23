<?php
$model['jig_trans'] = new Model('db_jig.jig_trans',
[
    'code::s',
    'loc::s',
    'qty::i',
    'start_date::s',
    'end_date::s',
    'status::s',
    'item_jig::s',
],
'id::i');

$model['emp_code'] = new Model('db_jig.emp_code',
[
    'emp_code::s',
    'loc_name::s',
],
'emp_code::s');

$model['jig_func'] = new Model('db_jig.jig_function',
[
    'item_jig::s',
    'item_type::s',
    'opt_on::i',
    'opt_off::i',
    'status::s',
],
'id::i');

$model['log_func'] = new Model('db_jig.log_function',
[
    'item_jig::s',
    'item_type::s',
    'opt_on::i',
    'opt_off::i',
    'status::s',
    'remark::s',
    'trans_date::s',
],
'id_log::i');

$model['jig_mstr'] = new Model('db_jig.jig_master',
[
    'item_jig::s',
    'desc_jig::s',
    'status_jig::s',
    'material::s',
    'type::s',
    'drawing::s',
],
'item_jig::s');

$model['log_mstr'] = new Model('db_jig.log_master',
[
    'item_jig::s',
    'desc_jig::s',
    'status_jig::s',
    'material::s',
    'type::s',
    'trans_date::s',
    'remark::s',
    'drawing::s',
],
'id_log::i');

$model['jig_usg'] = new Model('db_jig.jig_usage',
[
    'tr_date::s',
    'jig::s',
    'desc_jig::s',
    'code::s',
    'cat::s',
    'loc::s',
    'qty_pinjam::i',
    'wo_id::s',
    'type::s',
    'qty_total::i',
    'count_dt::i',
    'code_count::i',
    'qty_jig::i',
    'qty_usage::i',
    'codeAll::s',
    'id_trans::s',
],
'id::i');

// testing usage 
$model['jig_usg_test'] = new Model('db_jig_new.sb_usage_log',
[
    'tr_date::s',
    'jig::s',
    'desc_jig::s',
    'code::s',
    'cat::s',
    'loc::s',
    'qty_pinjam::i',
    'wo_id::s',
    'type::s',
    'qty_total::i',
    'count_dt::i',
    'code_count::i',
    'qty_jig::i',
    'qty_usage::i',
    'codeAll::s',
    'id_trans::s',
],
'id::i');

$model['jig_loc'] = new Model('db_jig.jig_loc2',
[
    'item_jig::s',
    'qty_per_unit::i',
    'unit::s',
    'lokasi::s',
    'status::s',
    'urut::i',
    'toleransi::i',
    'code::s',
],
'id::i');

$model['log_loc'] = new Model('db_jig.log_location',
[
    'code::s',
    'item_jig::s',
    'qty_per_unit::i',
    'unit::s',
    'lokasi::s',
    'trans_date::s',
    'remark::s',
    'status::s',
    'urut::i',
    'toleransi::i',
    'addSub::s',
    'qty_change::i',
],
'id_log::i');

$model['list_loc'] = new Model('db_jig.list_location',
[
    'name::s',
],
'id::i');

$model['list_mtnc'] = new Model('db_jig.list_mtnc',
[
    'type_jig::s',
    'mtnc_std_lifetime::i',
    'mtnc_by::s',
    'lftm_unit::s',
],
'type_jig::s');

















