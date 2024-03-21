<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "process.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Handling preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $req = json_decode(file_get_contents('php://input'), true);
    $data = $req['data'];
    $db = $req['param1'];
    $table = $req['param2'];
    // $response = fetch($db, $table, $data);
    header("Content-Type: application/json");
    echo json_encode($data);
} else {
    http_response_code(405);
    echo 'Only POST requests are allowed for this endpoint.';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $response = array(
        'message' => 'This is a response to a GET request.',
        'timestamp' => time()
    );
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405);
    echo 'Only GET requests are allowed for this endpoint.';
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $putData = file_get_contents("php://input");
    $jsonData = json_decode($putData, true);
    $response = $jsonData;
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405); // Method Not Allowed
    echo 'Only PUT requests are allowed for this endpoint.';
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $response = array('message' => 'This is a response to a DELETE request.');
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405); // Method Not Allowed
    echo 'Only DELETE requests are allowed for this endpoint.';
}
?>