<?php
require_once "config.php";
require_once "queryList2.php";
require_once "process2.php";
require_once "process.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $param = $data['parameters']; 
    $action = $data['action']; 
    $insertData = isset($data['insertFilter']) ? $data['insertFilter']:''; 
    $updateData = isset($data['updateFilter']) ? $data['updateFilter']:'';
    $filter = isset($data['filter']) ? $data['filter']:''; 
    $query = getArrayList($codeList, $param); 
    if ($action === 'getData') {
        $result = getData($query);
    } elseif ($action === 'fetchDataFilter') {
        $result = fetchDataFilter($query, $filter);
    } elseif ($action === 'insertData') {
        $result = insertData($query, $insertData);
    }elseif ($action === 'updateData') {
        $result = updateData($query, $updateData);
    }
    header("Cache-Control: public, max-age=3600");
    header("Content-Type: application/json");
    echo json_encode($result);
}


?>