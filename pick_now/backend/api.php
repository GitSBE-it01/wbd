<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "index.php";
require_once "queryList.php";

$allowedOrigins = [
    'http://informationsystem.sbe.co.id:8080', 
    'http://192.168.2.103:8080'
];

$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
if (in_array($origin, $allowedOrigins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
} else {
    http_response_code(403); 
    exit(); 
}
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handling preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = 'dbqad_live';
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action']; 
    $param = $data['parameters']; 
    $query = getArrayList($codeList, $param); 
    switch($action) {
        case "getData":
            $response = getData($db, $query);
            break;
        case "fetchDataFilter":
            $filter = isset($data['filter']) ? $data['filter']:''; 
            $response = fetchDataFilter($db, $query, $filter);
            break;
        case "insertData":
            $insertData = isset($data['insertFilter']) ? $data['insertFilter']:''; 
            $response = insertData($db, $query, $insertData);
            break;
        case "updateData":
            $updateData = isset($data['updateFilter']) ? $data['updateFilter']:'';
            $updateData2 = isset($data['updateFilter2']) ? $data['updateFilter2']:'';
            $response = updateData($db, $query, $updateData, $updateData2);
            break;
        case "deleteData":
            $delData = isset($data['delFilterKey']) ? $data['delFilterKey']:'';
            $delData2 = isset($data['delFilter']) ? $data['delFilter']:'';
            $response = deleteData($db, $query, $delData, $delData2);
            break;
        default:
            $response = 'Method not supported';
    }
    header("Cache-Control: public, max-age=3600");
    header("Content-Type: application/json");
    echo json_encode($response);
}


?>