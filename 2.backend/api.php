<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "index.php";
require_once "./data_access/1.index.php";

session_start();
$allowedOrigins = [
    'http://informationsystem.sbe.co.id:8080', 
    'http://192.168.2.103:8080',
    'informationsystem.sbe.co.id:8080', 
    '192.168.2.103:8080',
];

$origin = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
if (in_array($origin, $allowedOrigins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
} else {
    http_response_code(403); 
    exit(); 
}
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handling preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $response = delete_cache();
    echo json_encode($response);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $data_name = isset($data['parameters']) ? $data['parameters']:'';
    $isi_data = isset($data['data']) ? $data['data']:'';
    $response = cache_data($data_name, $isi_data);
    echo json_encode($response);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_SERVER['HTTP_APP']) && $_SERVER['HTTP_APP'] === 'cache') {
        $response = get_cache($_SERVER['HTTP_PARAM']);
    } else {
        if(isset($_SESSION['username'])) {
            $data = array(
                'name'=>$_SESSION['absname'],
                'dept'=>$_SESSION['divisi'],
                'absen'=>$_SESSION['absen'],
                'jabatan'=>$_SESSION['jabatan'],
                'grade'=>$_SESSION['grade'],
            );
            $response = $data;
        } else {
            $response = 'failed';
        }
    }
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($response);
    return;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = 'db_wbd';
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action']; 
    $param = $data['parameters']; 
    $queryStart = getArrayList($codeList, $param); 
    $dataParam = isset($data['data']) ? $data['data']:'';
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
        default:
            $response = 'Method not supported';
    }

    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($response);
    return;
} 



?>