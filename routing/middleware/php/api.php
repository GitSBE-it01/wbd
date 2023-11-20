<?php
require_once "../../config.php";
require_once "queryList.php";
require_once "process.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $param = $data['parameters']; 
    $action = $data['action']; 
    $insertData = isset($data['insertFilter']) ? $data['insertFilter']:''; 
    $updateData = isset($data['updateFilter']) ? $data['updateFilter']:'';
    $updateData2 = isset($data['updateFilter2']) ? $data['updateFilter2']:'';
    $filter = isset($data['filter']) ? $data['filter']:''; 
    $query = getArrayList($codeList, $param); 
    if ($action === 'getData') {
        $result = getData($query);
    } elseif ($action === 'fetchDataFilter') {
        $result = fetchDataFilter($query, $filter);
    } elseif ($action === 'insertData') {
        $result = insertData($query, $insertData);
        // $result = array($insertData);
    }elseif ($action === 'updateData') {
        $result = updateData($query, $updateData, $updateData2);
    }
    header("Cache-Control: public, max-age=3600");
    header("Content-Type: application/json");
    echo json_encode($result);
}


?>