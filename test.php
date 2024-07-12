<?php
require_once "2.backend/api/vjs_alat_ukur.php";
require_once "2.backend/model/index.php";
$mdl = (array) $model['qad_wo']->field;
echo 'test' . gettype($mdl);
sort($mdl);
echo '<pre>';
print_r($mdl);
echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>testtingg</div>
    <script src=""></script>
</body>
</html>