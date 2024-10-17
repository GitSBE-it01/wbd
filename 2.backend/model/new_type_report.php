<?php
$model['nt_mstr'] = new Model('db_wbd.ntr_master',
[
    'item_number::s',
    '_desc::s',
    'fo_before_brk_in::i',
    'tol_fo_before::i',
    'fo_after_brk_in::i',
    'tol_fo_after::i',
    'added::i',
],
'item_number::s');

$model['nt_hd'] = new Model('db_wbd.ntr_hd',
[
    'id::s',
    'item_number::s',
    'wo_id::s',
    'create_date::s',
    'part_prod::s',
    'item_comp::s',
    'measure::s',
    'um::s',
    'no_lot::s',
    'std_max::s',
    'std_min::s',
    'group_code::s',
],
'id::s');

$model['nt_data'] = new Model('db_wbd.ntr_data',
[
    'id::i',
    'hd_code::s',
    'result::d',
    'no_repeat::i',
    'repeat_code::s',
],
'id::i');

$model['nt_reff'] = new Model('db_wbd.ntr_measure_list',
[
    'type::s',
    'um::s',
],
'type::s');





















