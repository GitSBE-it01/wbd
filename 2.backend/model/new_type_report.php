<?php
$model['nt_mstr'] = new Model('db_wbd.ntr_master',
[
    'item_number::s',
    '_desc::s',
    'fo_before_brk_in::i',
    'tol_fo_before::i',
    'fo_after_brk_in::i',
    'tol_fo_after::i',
],
'item_number::s');

$model['nt_hd'] = new Model('db_wbd.ntr_hd',
[
    'id::s',
    'item_number::s',
    'wo_id::s',
],
'id::s');

$model['nt_data'] = new Model('db_wbd.ntr_data',
[
    '_code::s',
    'fo_cone::i',
    'flexi_spider::i',
    'fo_before_sweeper::i',
    'fo_after_sweeper::i',
    'fo_clio::i',
    'before_breakin::i',
    'after_breakin::i',
    'repeat_no::i',
],
'id::i');






















