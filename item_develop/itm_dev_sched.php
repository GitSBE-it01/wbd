<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';

require_once 'proses/cek_comp.php';
require_once 'proses/cek_ebom.php';
require_once 'proses/cek_parent.php';

echo "====================================================================</br>";
echo "cek item comp detail</br>";
echo "====================================================================</br>";
set_time_limit(3600);
$start_time = microtime(true);
detail_item_dev();
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";

echo "====================================================================</br>";
echo "cek item parent</br>";
echo "====================================================================</br>";
set_time_limit(3600);
$start_time = microtime(true);
parent_item_dev();
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";
?>

<script>
    setTimeout(() => {
        window.open('http://informationsystem.sbe.co.id:62898/wbd/data_sbe4/intersite/index.php', '_blank');
    }, 500);
    setTimeout(() => {
        window.open('http://informationsystem.sbe.co.id:62898/wbd/data_sbe4/routing/index.php', '_blank');
    }, 2000);
    setTimeout(() => {
        window.open('http://informationsystem.sbe.co.id:62898/wbd/data_sbe4/so/index.php', '_blank');
    }, 3500);
    setTimeout(() => {
        window.open('http://informationsystem.sbe.co.id:62898/wbd/data_sbe4/wo/index.php', '_blank');
    }, 5000);
</script>