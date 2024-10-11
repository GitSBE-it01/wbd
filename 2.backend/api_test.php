<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "api/index.php";
require_once "data_process/index.php";
require_once "middleware/index.php";
require_once "model/index.php";

session_start();
cors2();
function routes($model) {
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
                    $response  = DB_access2::getQuery($action,$mdl);
                    cache_data($routes, $param, $response);
                } else {
                    $response = get_cache($routes, $param);
                }
            } else {
                $response  = DB_access2::getQuery($action,$mdl);
            }
            break;
        case "POST":
            $mdl = $model[$table];
            if($action === 'insert' || $action === 'insert2') {
                $response  = DB_access2::insertQuery($action,$mdl, $dt);
            } else if($action === 'fetch' || $action=== 'fetch2') {
                if($cache === 'cache') {
                    if(!check_cache($routes, $param)) {
                        delete_cache($routes, $param);
                        $response  = DB_access2::fetchQuery($action,$mdl, $dt);
                        cache_data($routes, $param, $response);
                    } else {
                        $response = get_cache($routes, $param);
                    }
                } else {
                    $response  = DB_access2::fetchQuery($action,$mdl, $dt);
                }
            } else {
                if($cache === 'cache') {
                    if(!check_cache($routes, $param)) {
                        delete_cache($routes, $param);
                        $response = custom_handle($dt, $routes, $action, $model, $table);
                        cache_data($routes, $param, $response);
                    } else {
                        $response = get_cache($routes, $param);
                    }
                } else {
                    $response = custom_handle($dt, $routes, $action, $model, $table);
                }
            }
            break;
        case "PUT":
            $mdl = $model[$table];
            $response  = DB_access2::updateQuery($action,$mdl, $dt);
            break;
        case "DELETE":
            $mdl = $model[$table];
            $response  = DB_access2::deleteQuery($action,$mdl, $dt);
            break;
        default: 
            $response = 'method not allowed';
    }
    header("Cache-Control: public");
    header("Content-Type: application/json");
    echo json_encode($response);
    return;
}

routes($model);
?>

