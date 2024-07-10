<?php
$model['ng_dly'] = new Model('dbngvar.ng_daily',
[
    'id_ng_daily::i', 
    'op_wo_nbr::s', 
    'op_wo_lot::s', 
    'op_wo_op::i',
    'op_date::s',
    'op_tran_date::s',
    'op_part::s', 
    'op_type::s', 
    'op_wkctr::s', 
    'op_wkgrp::s', 
    'op_dept::s', 
    'op_wkctr_first::s', 
    'op_emp::s', 
    'op_desc::s', 
    'op_comment::s', 
    'op_categ::s', 
    'op_qty_ng::d',
    'op_qty_run::d',
    'op_ng_rate::d',
    'op_men_mch::d',
    'op_wr_desc::s', 
    'analysis::i',
    'action::i',
],
'id_ng_daily::i');



