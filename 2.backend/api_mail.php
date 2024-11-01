<?php
require_once "D:/xampp/php/pear/Mail.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the POST request (if needed)
    $data = json_decode(file_get_contents('php://input'), true);
    $detail = $data['Data'];
    $to = $detail['to'];
    $cc = $detail['cc'];
    $subject = $detail['subject'];
    $body= $detail['body'];
    $result = send_mail($to, $cc, $subject, $body);
    echo json_encode($result);
    return;
}


function send_mail($to, $cc, $subject, $body) {
    $from = "SBE-InformationSystem";
    $host = "192.168.2.242";
    $port = "25";
    $username = "";
    $password = "Sinar123";
    $body .= "</br></br>- Sinar Baja Electric Information System -";
    $headers = array(
        'From' => $from, 
        'To' => $to, 
        'Cc' => $cc, 
        'Subject' => $subject, 
        'MIME-Version' => '1.0\r\n', 
        'Content-Type' => 'text/html; charset=UTF-8\r\n'
    );

    $smtp = Mail::factory('smtp', array(
        'host' => $host, 
        'port' => $port, 
        'auth' => false, 
        'username' => $username, 
        'password' => $password
    ));

    $mail_fix = $smtp -> send($to, $headers, $body);
    return $mail_fix;
}
