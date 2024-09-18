<?php
function jig_db_sched() {
    $query = [
        [
            'query'=>'SELECT * FROM db_jig.jig_master',
            'param'=>'jig_mstr__get'
        ],
    ];

    foreach($query as $set) {
        if(!check_cache('jig_db_new', $set['param'])) {
            delete_cache('jig_db_new', $set['param']);
            $data = DB::execQuery($set['query'],'');
            cache_data('jig_db_new', $set['param'], $data);
            echo $set['param']." has ".count($data).' data </br>';
            $data = null;
        } else {
            echo $set['param']." already cached</br>";
        }
    }
    return;
}