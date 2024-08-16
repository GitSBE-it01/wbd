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
],
'id::s');

$model['nt_data'] = new Model('db_wbd.ntr_data',
[
    'hd_code::s',
    'msr_type::i',
    'result::i',
    'no_repeat::i',
    'repeat_code::i',
    'item_comp::i',
    'no_lot::i',
    'um::s',
],
'id::i');

$model['nt_reff'] = new Model('db_wbd.ntr_measure_list',
[
    'type::s',
],
'type::s');





















