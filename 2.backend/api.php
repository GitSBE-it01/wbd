<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "api/index.php";
require_once "data_access/index.php";
require_once "data_process/index.php";
require_once "middleware/index.php";
require_once "model/index.php";

session_start();
cors();
function routes($model) {
    $data = json_decode(file_get_contents('php://input'), true);
    $method = $_SERVER['REQUEST_METHOD'];
    $reff = explode("/",$_SERVER['HTTP_REFERER']);
    $routes = $reff[4];
    switch($routes) {
        case "vjs_alat_ukur2" :
            $response = vjs_alat_ukur_handle($data, $method, $model, $_SERVER['HTTP_REQ_DETAIL']);
            break;
        default: 
            $response = 'wrong routes';
    }
    
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($response);
    return;
}
routes($model);

/*
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
*/



?>