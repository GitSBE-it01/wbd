<?php

function cors() {
    $allowedOrigins = [
        'http://informationsystem.sbe.co.id:8080', 
        'http://192.168.2.103:8080',
        'http://localhost:5173',
        'informationsystem.sbe.co.id:8080', 
        '192.168.2.103:8080',
        'localhost:5173',
    ];

    $origin = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    if (in_array($origin, $allowedOrigins)) {
        header('Access-Control-Allow-Origin: ' . $origin);
    } else {
        http_response_code(403); 
        exit(); 
    }
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Req-Detail, cache-control,Req-Method');

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit();
    }
    return;
}

function cors2() {
    $allowedOrigins = [
        'http://informationsystem.sbe.co.id:8080', 
        'http://192.168.2.103:8080',
        'http://localhost:5173',
        'informationsystem.sbe.co.id:8080', 
        '192.168.2.103:8080',
        'localhost:5173',
    ];

    $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
    if (in_array($origin, $allowedOrigins)) {
        header('Access-Control-Allow-Origin: ' . $origin);
    } else {
        http_response_code(403); 
        exit(); 
    }
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Req-Detail, cache-control,Req-Method');

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit();
    }
    return;
}