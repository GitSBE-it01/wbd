<?php

function cors() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Ori, Origin, Route, Req-Detail, cache-control,Req-Method');

    $allowedOrigins = [
        'http://informationsystem.sbe.co.id:8080', 
        'http://informationsystem.sbe.co.id:62898', 
        'http://informationsystem.sbe.co.id:62898/', 
        'http://192.168.2.103:8080',
        'http://192.168.2.103:62898',
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
    
    $origin = isset($_SERVER['HTTP_ORI']) ? $_SERVER['HTTP_ORI'] : '';
    if (!in_array($origin, $allowedOrigins)) {
        http_response_code(403); 
        exit(); 
    }
    return;
}

function cors2() {
    /*
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

    $origin = isset($_SERVER['HTTP_ORI']) ? $_SERVER['HTTP_ORI'] : '';
    if (in_array($origin, $allowedOrigins)) {
        header('Access-Control-Allow-Origin: ' . $origin);
    } else {
        http_response_code(403); 
        exit(); 
    }
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Ori, Origin, Route, Req-Detail, cache-control,Req-Method');

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit();
    }
*/
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Ori, Origin, Route, Req-Detail, cache-control,Req-Method');

    $origin = isset($_SERVER['HTTP_ORI']) ? $_SERVER['HTTP_ORI'] : '';
    $allowedOrigins = [
        'http://informationsystem.sbe.co.id:8080', 
        'http://informationsystem.sbe.co.id:62898', 
        'http://192.168.2.103:8080',
        'http://192.168.2.103:62898',
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
        http_response_code(403); 
        exit(); 
    }
    return;
}

function cors_sbe4() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Ori, Origin, Route, Req-Detail, cache-control,Req-Method');

    $origin = isset($_SERVER['HTTP_ORI']) ? $_SERVER['HTTP_ORI'] : '';
    $allowedOrigins = [
        'http://informationsystem.sbe.co.id:8080', 
        'http://informationsystem.sbe.co.id:62898', 
        'http://182.16.168.187:62898',
        'http://182.16.168.187:8080',
        'informationsystem.sbe.co.id:8080', 
        '182.16.168.187:62898',
        '182.16.168.187:8080',
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit();
    }
    if (!in_array($origin, $allowedOrigins)) {
        http_response_code(403); 
        exit(); 
    }
    return;
}