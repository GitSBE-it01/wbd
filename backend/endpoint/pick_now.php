<?php
    function pickNow($req, $res) {
        $timestamp = time();
        $time = date('Y-m-d H:i:s', $timestamp);
        
        $method = $req['method'];
        echo json_encode($method);
        switch($method) {
            case "fetch":
                $response = array();
                echo json_encode($response);
                break;
            default:
                http_response_code(405); // Method not allowed status code
                echo 'Method not supported';
        }
    }
    



?>