<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "queryList.php";
require_once "process.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handling preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = 'dbvjs';
    $data = json_decode(file_get_contents('php://input'), true);
    $param = $data['parameters']; 
    $action = $data['action']; 
    $insertData = isset($data['insertFilter']) ? $data['insertFilter']:''; 
    $updateData = isset($data['updateFilter']) ? $data['updateFilter']:'';
    $updateData2 = isset($data['updateFilter2']) ? $data['updateFilter2']:'';
    $delData = isset($data['delFilterKey']) ? $data['delFilterKey']:'';
    $delData2 = isset($data['delFilter']) ? $data['delFilter']:'';
    $filter = isset($data['filter']) ? $data['filter']:''; 
    $query = getArrayList($codeList, $param); 
    if ($action === 'getData') {
        $result = getData($db, $query);
    } elseif ($action === 'fetchDataFilter') {
        $result = fetchDataFilter($db, $query, $filter);
    } elseif ($action === 'insertData') {
        $result = insertData($db, $query, $insertData);
    } elseif ($action === 'updateData') {
        $result = updateData($db, $query, $updateData, $updateData2);
    } elseif ($action === 'deleteData') {
        $result = deleteData($db, $query, $delData, $delData2);
    }
    header("Cache-Control: public, max-age=3600");
    header("Content-Type: application/json");
    echo json_encode($result);
}


?>