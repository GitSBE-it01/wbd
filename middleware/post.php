<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "process.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handling preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $req = json_decode(file_get_contents('php://input'), true);
    $res = fetch($req);
    header("Content-Type: application/json");
    echo json_encode($res);
} else {
    http_response_code(405);
    echo 'Only POST requests are allowed for this endpoint.';
}

?>