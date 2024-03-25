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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = $_SERVER['REQUEST_URI'];
    $split = explode("/", $data);
    $count = count($split)-1;
    $split2 = explode("?", $split[$count]);
    $count2 = count($split2)-1;
    $res = array(
        'timestamp'=> time(),
        'response'=>fetch($req)
    );
    header("Content-Type: application/json");
    echo json_encode($res);
    return;
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $req = json_decode(file_get_contents('php://input'), true);
    $res = array(
        'timestamp'=> time(),
        'response'=>fetch($req)
    );
    header("Content-Type: application/json");
    echo json_encode($res);
    return;
} 


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $putData = file_get_contents("php://input");
    $jsonData = json_decode($putData, true);
    $res = $jsonData;
    header('Content-Type: application/json');
    echo json_encode($res);
    return;
} 

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $res = array('message' => 'This is a response to a DELETE request.');
    header('Content-Type: application/json');
    echo json_encode($res);
    return;
} 

http_response_code(405); // Method Not Allowed
echo 'Requests method errors are allowed for this endpoint.';

?>