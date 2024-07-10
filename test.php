<?php
require_once "2.backend/api/vjs_alat_ukur.php";
require_once "2.backend/model/index.php";


$mdl = (array) $model['qad_wo']->field;
echo 'test' . gettype($mdl);
sort($mdl);
echo '<pre>';
print_r($mdl);
echo '</pre>';

