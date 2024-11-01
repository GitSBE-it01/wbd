<?php
function cek_bom() {
    $date = (int)date('Ymd');
    $code = $date * 10000000000;
    $query = "SELECT * FROM pub.ps_mstr WHERE oid_ps_mstr > $code WITH (NOLOCK, READPAST NOWAIT)";
    $ebom_new = odbc_qad::execQuery($query,'');
    $full = [];
    foreach($ebom_new as $set) {
        $fltr = $set['ps_par'];
        echo $fltr;
        $query = "SELECT * FROM db_wbd.cek_bom WHERE ps_par LIKE '%$fltr%'";
        $ebom_old = DB::execQuery($query,'');
        if(count($ebom_old) === 0) {
            $data = [
                'ps_par'=>$set['ps_par'],
                'ps_comp'=>$set['ps_comp'],
                'ps_qty_per'=>$set['ps_qty_per'],
                'ps_start'=>$set['ps_start'],
                'ps_end'=>$set['ps_end'],
                'ps_ps_code'=>$set['ps_ps_code'],
                'data_date'=>date('Y-m-d')
            ];
            $full[]= $data;
        }
    }
    $msg ='';
    if(count($full)>0) {
        $query = "INSERT INTO db_wbd.cek_bom(`ps_par`, `ps_comp`, `ps_qty_per`, `ps_start`, `ps_end`, `ps_ps_code`, `data_date`) VALUES
        (?,?,?,?,?,?,?)";
        $insert = DB::execQuery($query,'ssdssss', $full);
        if($insert === 'success') {
            $msg .= $insert." ". count($full).' data inserted </br>';
        }
    } else {
        $msg = 'no data inserted to database';
    }
    return $msg;
}
?>

















<script>
/* contekan coding
    // echo 'count : '.count($rout).'</br>';
    // echo 'type : '.gettype($rout).'</br>';
    // echo 'type of each data: '.gettype($rout[0]).'</br>';
    print_r($rout[0]);
        print_r($rout[1758]);
        echo '</br>';
        print_r(array_slice($rout,0,1));
        echo '</br>';
    function testing() {
    $query ='SELECT * FROM db_wbd.wbd_test';
     
    if(!check_cache('test', 'fetch_test')) {
        delete_cache('test', 'fetch_test');
        $data = DB::execQuery($query,'');
        cache_data('test', 'fetch_test', $data);
        echo 'fetch_test has '.count($data).' data </br>';
    } else {
        echo 'fetch_test already cached</br>';
    }
    return;
    }

    function test_odbc() {
    set_time_limit(3600);
    $query = [
        [
            'query'=>"SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN 2829199 AND 3043579 AND op_type='labor' AND op_dept='P1.ASSY' WITH (NOLOCK, READPAST NOWAIT)",
            'param'=>'op_hist__fetch_p1_assy_labor1'
        ],
        [
            'query'=>"SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN 3043580 AND 3257958 AND op_type='labor' AND op_dept='P1.ASSY' WITH (NOLOCK, READPAST NOWAIT)",
            'param'=>'op_hist__fetch_p1_assy_labor2'
        ],
        [
            'query'=>"SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN 2829199 AND 3257958 AND op_type='labor' AND op_dept='prod1.vc' WITH (NOLOCK, READPAST NOWAIT)",
            'param'=>'op_hist__fetch_vc_labor'
        ],
        [
            'query'=>"SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN 2829199 AND 3257958 AND op_type='labor' AND op_dept='qc' WITH (NOLOCK, READPAST NOWAIT)",
            'param'=>'op_hist__fetch_qc_labor'
        ],
        [
            'query'=>"SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN 2829199 AND 3257958 AND op_type='down' AND op_dept='P1.ASSY' WITH (NOLOCK, READPAST NOWAIT)",
            'param'=>'op_hist__fetch_p1_assy_down'
        ],
        [
            'query'=>"SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN 2829199 AND 3257958 AND op_type='down' AND op_dept='QC' WITH (NOLOCK, READPAST NOWAIT)",
            'param'=>'op_hist__fetch_qc_down'
        ],
        [
            'query'=>"SELECT * FROM pub.op_hist WHERE op_trnbr BETWEEN 2829199 AND 3257958 AND op_type='down' AND op_dept='prod1.vc' WITH (NOLOCK, READPAST NOWAIT)",
            'param'=>'op_hist__fetch_vc_down'
        ],
    ];

    foreach($query as $set) {
        if(!check_cache('test', $set['param'])) {
            delete_cache('test', $set['param']);
            $data = odbc_qad::execQuery($set['query'],'');
            cache_data('test', $set['param'], $data);
            echo $set['param']." has ".count($data).' data </br>';
        } else {
            echo $set['param']." already cached</br>";
        }
    }
    return;
    }

    function test_odbc2() {
    set_time_limit(3600);
    $query = [
        [
            'query'=>"SELECT * FROM pub.ro_det WHERE ro_routing='1HTWDDDVT001' ",
        ],
    ];

    foreach($query as $set) {
        $data = odbc_qad::execQuery($set['query'],'');
        print_r($data);
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    return;
    }
    */

</script>