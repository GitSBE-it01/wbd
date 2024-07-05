<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";

function cache_handle() {
    $req_cache = $_SERVER['REQUEST_METHOD'];
    switch($req_cache) {
        case "get":
            $response = 'invalid GET request';
            if(isset($_SERVER['HTTP_APP']) && $_SERVER['HTTP_APP'] === 'cache') {
                $response = get_cache($_SERVER['HTTP_PARAM']);
            } 
            header("Cache-Control: public");
            header("Content-Type: application/json");
            break;
        case "delete":
            $response = delete_cache();
            break;
        case "put":
            $data = json_decode(file_get_contents('php://input'), true);
            $data_name = isset($data['parameters']) ? $data['parameters']:'';
            $isi_data = isset($data['data']) ? $data['data']:'';
            $response = cache_data($data_name, $isi_data);
            break;
        default:
            $response = 'Method not supported for cache';
    }
    echo json_encode($response);
    return ;
}
