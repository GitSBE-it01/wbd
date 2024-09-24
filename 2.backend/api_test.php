<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "api/index.php";
require_once "data_process/index.php";
require_once "middleware/index.php";
require_once "model/index.php";

/*
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Ori, Origin, Route, Req-Detail, cache-control,Req-Method');

    $origin = isset($_SERVER['HTTP_ORI']) ? $_SERVER['HTTP_ORI'] : '';
    $allowedOrigins = [
        'http://informationsystem.sbe.co.id:8080', 
        'http://192.168.2.103:8080',
        'http://localhost:5173',
        'http://182.16.168.187:62898',
        'informationsystem.sbe.co.id:8080', 
        '182.16.168.187:62898',
        '192.168.2.103:8080',
        'localhost:5173',
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit();
    }
    if (!in_array($origin, $allowedOrigins)) {
        echo json_encode('tidak termasuk dalam array');
        http_response_code(403); 
        exit(); 
    }
    echo json_encode('di dalam array');
*/
session_start();
cors2();
function routes($model, $db_conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    $dt = $data['Data'];
    $method = $_SERVER['REQUEST_METHOD'];
    $cache = $_SERVER['HTTP_CACHE_CONTROL'];
    $table = $_SERVER['HTTP_REQ_DETAIL'];
    $routes = $_SERVER['HTTP_ROUTE'];
    $action = $_SERVER['HTTP_REQ_METHOD'];
    $param =  $table."__".$action;
    switch($method) {
        case "GET":
            $mdl = $model[$table];
            if($cache === 'cache') {
                if(!check_cache($routes, $param)) {
                    delete_cache($routes, $param);
                    $response  = $db_conn->getQuery($action,$mdl);
                    cache_data($routes, $param, $response);
                } else {
                    $response = get_cache($routes, $param);
                }
            } else {
                $response  = $db_conn->getQuery($action,$mdl);
            }
            break;
        case "POST":
            $mdl = $model[$table];
            if($action === 'insert' || $action === 'insert2') {
                $response  = $db_conn->insertQuery($action,$mdl, $dt);
            } else if($action === 'fetch' || $action=== 'fetch2') {
                if($cache === 'cache') {
                    if(!check_cache($routes, $param)) {
                        delete_cache($routes, $param);
                        $response  = $db_conn->fetchQuery($action,$mdl, $dt);
                        cache_data($routes, $param, $response);
                    } else {
                        $response = get_cache($routes, $param);
                    }
                } else {
                    $response  = $db_conn->fetchQuery($action,$mdl, $dt);
                }
            } else {
                if($cache === 'cache') {
                    if(!check_cache($routes, $param)) {
                        delete_cache($routes, $param);
                        $response = custom_handle($db_conn, $dt, $routes, $action, $model, $table);
                        cache_data($routes, $param, $response);
                    } else {
                        $response = get_cache($routes, $param);
                    }
                } else {
                    $response = custom_handle($db_conn, $dt, $routes, $action, $model, $table);
                }
            }
            break;
        case "PUT":
            $mdl = $model[$table];
            $response  = $db_conn->updateQuery($action,$mdl, $dt);
            break;
        case "DELETE":
            $mdl = $model[$table];
            $response  = $db_conn->deleteQuery($action,$mdl, $dt);
            break;
        default: 
            $response = 'method not allowed';
    }
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($response);
    return;
}

routes($model, $db_conn);
?>