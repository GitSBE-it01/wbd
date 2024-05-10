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
    $queryStart = getArrayList($codeList, $param); 
    $dataParam = isset($data['data']) ? $data['data']:''; 
    
    if(isset($data['cache']) && $data['cache']==='cache') {
        $md5Hash = md5($param . "--" . date("YmdHis"));
        $filePath = '../cache/' . $md5Hash . '.json';
        if (file_exists($filePath)) {
            $action = 'get_cache';
        } 
    }

    switch($action) {
        case "get":
            $query = $queryStart->getQuery();
            $response = getData($db, $query);
            break;
        case "fetch":
            $query = $queryStart->getQuery();
            $response = fetchDataFilter($db, $query, $dataParam);
            break;
        case "insert":
            $query = $queryStart->insertQuery();
            $response = insertData($db, $query, $dataParam);
            break;
        case "update":
            $query = $queryStart->updateQuery();
            $response = updateData($db, $query, $dataParam);
            break;
        case "delete":
            $query = $queryStart->deleteQuery();
            $response = deleteData($db, $query, $dataParam);
            break;
        case "get_cache":
            $cachedFile = file_get_contents($filePath);
            echo $cachedFile;
            return;
        default:
            $response = 'Method not supported';
    }
    
    if(isset($data['cache']) && $data['cache']==='cache'&& $action !== 'get_cache') {
        $json = json_encode($response);
        $md5Hash = md5($param . "--" . date("YmdHis"));
        $filePath = '../cache/' . $md5Hash . '.json';
        file_put_contents($filePath, $json);
    }

    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($response);
    return;
}


?>