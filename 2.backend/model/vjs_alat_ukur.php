<?php


$model['vjs_log'] = new Model('dbvjs_online.new_vjs_log',
[
    'id::int', // primary key
    'sn_id::string',
    'category::string',
    'no_asset::string',
    'check_point::string',
    'standard::string',
    'eff_date::date',
    'data_group::string',
    'user_input::string',
    'decision::bool',
    'approval_by::string',
]);

$model['vjs_reff'] = new Model('dbvjs_online.new_reff',
[
    'subcat::string'
]);

$model['vjs_point'] = new Model('dbvjs_online.new_master_point',
[
    'id::int', // primary key
    'new_cat::string',  //foreign key to vjs_reff
    'alat::string',
    'check_point::string',
    'standard::string',
    'pilihan::date',
    'status::string',
]);

$model['vjs_alat'] = new Model('dbvjs_online.new_master_alat',
[
    'sn_id::string', // primary key
    'cat::string',
    'new_subcat::string', //foreign key to vjs_reff
    'no_asset::string',
    '_desc::string',
    'merk::string',
    'install_date::date',
    'loc::string',
    'cal_by::string',
    'subcat::string',
]);
