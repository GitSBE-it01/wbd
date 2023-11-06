<?php
require_once "../config.php";
require_once "queryList.php";
require_once "process.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $param = $data['parameters']; // db use code
    $action = $data['action']; // which function to run
    $insertData = isset($data['insertFilter']) ? $data['insertFilter']:''; // for insert data
    $updateData = isset($data['updateFilter']) ? $data['updateFilter']:''; // for insert data
    $filter = isset($data['filter']) ? $data['filter']:''; // for get data
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