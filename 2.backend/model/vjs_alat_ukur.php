<?php
$model['vjs_log'] = new Model('dbvjs_online.new_vjs_log',
[
    'data_group::s',
    'check_point::s',
    'standard::s',
    'result::s',
],
'id::i');

$model['vjs_hd'] = new Model('dbvjs_online.new_vjs_hd',
[
    'data_group::s',
    'sn_id::s',
    'no_asset::s',
    'eff_date::s',
    'period::s',
    'category::s',
    'user_input::s',
    'approval_by::s',
    'loc::s',
    'decision::s',
],
'data_group::s');

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
    'loc::s',
    'subcat::s',
], 
'sn_id::s');

$model['vjs_loc'] = new Model('dbvjs_online.new_vjs_loc',
[
    'location::s',  
], 
'location::s');
