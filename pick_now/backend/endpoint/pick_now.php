<?php
    function pickNow($req, $res) {
        $timestamp = time();
        $time = date('Y-m-d H:i:s', $timestamp);
        
        $method = $req['REQUEST_METHOD'];
        echo json_encode($method);
        $db_access = new LocDAO();
        
        switch($method) {
            case "GET":
                // $response = CorsMiddleware($req, $res);
                $response = $db_access->getAllLoc('dbqad_live');
                echo json_encode($response);
                break;
            case "POST":
                break;
            default:
                http_response_code(405); // Method not allowed status code
                echo 'Method not supported';
        }
    }
    



?>