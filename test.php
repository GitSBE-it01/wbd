<?php

$test = [
    'a'=>'testing'
];

echo '<pre>';
print_r($test);
echo '</pre>';
echo '</br>'. $test['a'] . '</br>';
echo 'test = ' . ($test['a'] === 'testing');
echo (isset($test['b']));
