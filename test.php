<?php
require_once "2.backend/api/vjs_alat_ukur.php";

$test2 = 'adstaret';
$test = [
    'a'=>'testing'
];
$test3 = 'test2';
echo ${$test3};
echo '<pre>';
print_r($model);
echo '</pre>';
echo '</br>'. $test['a'] . '</br>';
echo 'test = ' . ($test['a'] === 'testing');
echo (isset($test['b']));
