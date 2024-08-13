<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "api/index.php";
require_once "data_access/index.php";
require_once "data_process/index.php";
require_once "middleware/index.php";
require_once "model/index.php";

session_start();
cors();
function routes($model, $db_conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    $dt = $data['Data'];
    $method = $_SERVER['REQUEST_METHOD'];
    $reff = explode("/",$_SERVER['HTTP_REFERER']);
    $cache = $_SERVER['HTTP_CACHE_CONTROL'];
    $table = $_SERVER['HTTP_REQ_DETAIL'];
    if(is_int(strpos($table, 'qad'))) {
        $routes = 'general';
    } else {
        $routes = $reff[4];
    }
    $action = $_SERVER['HTTP_REQ_METHOD'];
    $today = date('Ymd');
    $param =  $today."__".$table."__".$action;
    switch($method) {
        case "GET":
            $mdl = $model[$table];
            if($cache === 'cache') {
                if(!check_cache($routes, $param)) {
                    delete_cache2($routes, $table);
                    $response  = $db_conn->getQuery($action,$mdl);
                    cache_data($param, $routes, $response);
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
                        delete_cache2($routes, $table);
                        $response  = $db_conn->fetchQuery($action,$mdl, $dt);
                        cache_data($param, $routes, $response);
                    } else {
                        $response = get_cache($routes, $param);
                    }
                } else {
                    $response  = $db_conn->fetchQuery($action,$mdl, $dt);
                }
            } else {
                if($cache === 'cache') {
                    if(!check_cache($routes, $param)) {
                        delete_cache2($routes, $table);
                        $response = custom_handle($db_conn, $dt, $routes, $action, $model, $table);
                        cache_data($param, $routes, $response);
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

if(isset($_SESSION['username'])) {
    routes($model, $db_conn);
}
?>