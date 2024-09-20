<?php
$model['emp_data_sb3'] = new Model('db_jig_new.emp_data_sb3',
[
    'emp_code::s',
    'loc_name::s',
],
'emp_data_sb3::s');

$model['func_data_sb3'] = new Model('db_jig_new.func_data_sb3',
[
    'item_jig::s',
    'item_type::s',
    'opt_on::i',
    'opt_off::i',
    'status::s',
],
'id::i');

$model['func_log_sb3'] = new Model('db_jig_new.func_log_sb3',
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

$model['loc_data_sb3'] = new Model('db_jig_new.loc_data_sb3',
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

$model['loc_list_sb3'] = new Model('db_jig_new.loc_list_sb3',
[
    'name::s',
],
'name::s');

$model['loc_log_sb3'] = new Model('db_jig_new.loc_log_sb3',
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

$model['master_data_sb3'] = new Model('db_jig_new.master_data_sb3',
[
    'item_jig::s',
    'desc_jig::s',
    'status_jig::s',
    'material::s',
    'type::s',
    'drawing::s',
],
'item_jig::s');

$model['master_log_sb3'] = new Model('db_jig_new.master_log_sb3',
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


$model['trans_log_sb3'] = new Model('db_jig_new.trans_log_sb3',
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

$model['usage_log_sb3'] = new Model('db_jig_new.usage_log_sb3',
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

$model['mtnc_data_sb3'] = new Model('db_jig_new.mtnc_data_sb3',
[
    'type_jig::s',
    'mtnc_std_lifetime::i',
    'mtnc_by::s',
    'lftm_unit::s',
],
'type_jig::s');
















