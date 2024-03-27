<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "index.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Handling preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

$timestamp = time();
$time = date('Y-m-d H:i:s', $timestamp);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $req = $_SERVER['REQUEST_URI'];
    $res = array(
        'timestamp'=> $time,
        'version'=> $timestamp,
        'response'=>fetch($req)
    );
    header("Content-Type: application/json");
    echo json_encode($res);
    return;
} 

$req = json_decode(file_get_contents('php://input'), true);
$res  = array();
$check = true;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $res = array(
        'timestamp'=> $time,
        'version'=> $timestamp,
        'response'=>insert($req)
    );
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $res = array(
        'timestamp'=> $time,
        'version'=> $timestamp,
        'response'=>update($req)
    );
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $res = array(
        'timestamp'=> $time,
        'version'=> $timestamp,
        'response'=>delete($req)
    );
} else {
    $check = false;
}

if($check) {
    header("Content-Type: application/json");
    echo json_encode($res);
} else {
    http_response_code(405); // Method Not Allowed
    echo 'Requests method errors are allowed for this endpoint.';
}

?>