<?php
$model['vjs_log'] = new Model('dbvjs_online.new_vjs_log',
[
    'sn_id::s',
    'category::s',
    'no_asset::s',
    'check_point::s',
    'standard::s',
    'eff_date::s',
    'result::s',
    'data_group::s',
    'user_input::s',
    'decision::i',
    'approval_by::s',
],
'id::i');

$model['vjs_reff'] = new Model('dbvjs_online.new_reff',
[
    'subcat::s'
], 
'subcat::s');

$model['vjs_point'] = new Model('dbvjs_online.new_master_point',
[
    'new_cat::s',  //foreign key to vjs_reff
    'alat::s',
    'check_point::s',
    'standard::s',
    'pilihan::s',
    'status::s',
], 
'id::i');

$model['vjs_alat'] = new Model('dbvjs_online.new_master_alat',
[
    'sn_id::s',
    'cat::s',
    'new_subcat::s', //foreign key to vjs_reff
    'no_asset::s',
    '_desc::s',
    'merk::s',
    'install_date::s',
    'loc::s',
    'cal_by::s',
    'subcat::s',
], 
'sn_id::s');

$model['vjs_loc'] = new Model('dbvjs_online.new_vjs_loc',
[
    'location::s',  
], 
'location::s');
