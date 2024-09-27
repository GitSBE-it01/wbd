<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';

require_once 'general.php';
require_once 'new_type_report.php';
require_once 'pick_now.php';
require_once 'test.php';

echo "====================================================================</br>";
echo "testing</br>";
echo "====================================================================</br>";
$start_time = microtime(true);
//test_odbc();
echo "no testing currently";
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";

echo "====================================================================</br>";
echo "QAD cache data</br>";
echo "====================================================================</br>";
$start_time = microtime(true);
cache_qad_data();
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";

echo "====================================================================</br>";
echo "NTR Master sched</br>";
echo "====================================================================</br>";
$start_time = microtime(true);
ntr_master_sched();
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";

echo "====================================================================</br>";
echo "Pick Now sched</br>";
echo "====================================================================</br>";
echo "Opening new tab for pick now scheduler</br>";
?>
<script>
    window.open('http://informationsystem.sbe.co.id:8080/wbd/pick_now/pick_now_sched.html', '_blank');
</script>
<?php 
echo "********************************************************************</br></br>";


?>