<?php
$model['sb_emp_data'] = new Model('db_jig_new.sb_emp_data',
[
    'emp_code::s',
    'loc_name::s',
],
'emp_code::s');

$model['sb_func_data'] = new Model('db_jig_new.sb_func_data',
[
    'item_jig::s',
    'item_type::s',
    'opt_on::i',
    'opt_off::i',
    'status::s',
    'id_fk::i'
],
'id::i');

$model['sb_func_log'] = new Model('db_jig_new.sb_func_log',
[
    'item_jig::s',
    'item_type::s',
    'opt_on::i',
    'opt_off::i',
    'status::s',
    'remark::s',
    'trans_date::s',
    'id_fk::i'
],
'id_log::i');


$model['sb_loc_data'] = new Model('db_jig_new.sb_loc_data',
[
    'item_jig::s',
    'qty_per_unit::i',
    'unit::s',
    'lokasi::s',
    'status::s',
    'urut::i',
    'toleransi::i',
    'code::s',
    'id_fk::i'
],
'id::i');

$model['sb_loc_log'] = new Model('db_jig_new.sb_loc_log',
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
    'id_fk::i'
],
'id_log::i');

$model['sb_loc_list'] = new Model('db_jig_new.sb_loc_list',
[
    'name::s',
],
'name::s');

$model['sb_master_data'] = new Model('db_jig_new.sb_master_data',
[
    'item_jig::s',
    'desc_jig::s',
    'status_jig::s',
    'material::s',
    'type::s',
    'drawing::s',
],
'id::i');

$model['sb_master_log'] = new Model('db_jig_new.sb_master_log',
[
    'item_jig::s',
    'desc_jig::s',
    'status_jig::s',
    'material::s',
    'type::s',
    'trans_date::s',
    'remark::s',
    'drawing::s',
    'id::i'
],
'id_log::i');


$model['sb_mtnc_list'] = new Model('db_jig_new.sb_mtnc_list',
[
    'type_jig::s',
    'mtnc_std_lifetime::i',
    'mtnc_by::s',
    'lftm_unit::s',
],
'type_jig::s');

$model['sb_trans_data'] = new Model('db_jig_new.sb_trans_data',
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

$model['sb_usage_log'] = new Model('db_jig_new.sb_usage_log',
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
    'data_date::s'
],
'id::i');



















