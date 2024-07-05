<?php

function cors() {
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
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Req-Detail');

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit();
    }
    return;
}