<?php
require_once "config.php";
require_once "queryList.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $param = $data['parameters'];
    $getData = getArrayList($codeList, $param);
    $result = fetchData($getData);
    header("Cache-Control: public, max-age=3600");
    header("Content-Type: application/json");
    echo json_encode($result);
}
?>