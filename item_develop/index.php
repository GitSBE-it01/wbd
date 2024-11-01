<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';

require_once 'proses/cek_ebom.php';
require_once 'proses/cek_itm.php';

/*
echo "====================================================================</br>";
echo "cek EBOM</br>";
echo "====================================================================</br>";
set_time_limit(3600);
$start_time = microtime(true);
$result = cek_bom();
echo $result;
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";
*/

echo "====================================================================</br>";
echo "cek item</br>";
echo "====================================================================</br>";
set_time_limit(3600);
$start_time = microtime(true);
item_develop();
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";
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