<?php
$model['qad_wo'] = new Model('dbqad_live.wo_mstr',
[
    'id::i',
    'log::s',
    'wo_nbr::s',
    'wo_lot::s',
    'wo_status::s',
    'wo_part::s',
    'wo_qty_ord::i',
    'wo__chr04::s',
    'wo_rel_date::s',
    'wo_due_date::s',
    'wo_so_job::s',
    'wo_rmks::s',
    'wo_stat_close_date::s',
    'wo_vend::s',
    'wo_qty_comp::i',
    'wo_close_date::s',
    'wo__chr02::s',
    'wo_acct_close::s',
    'wo_ord_date::s',
    'wo_rel_datex::s',
    'wo_due_datex::s',
    'wo_stat_close_datex::s',
    'wo_close_datex::s',
    'wo_ord_datex::s',
    'wo_routing::s',
],
'id::i');

$model['qad_item'] = new Model('dbqad_live.pt_mstr',
[
    'id::i',

],
'id::i');

