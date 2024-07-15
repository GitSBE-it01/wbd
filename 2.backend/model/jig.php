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

















