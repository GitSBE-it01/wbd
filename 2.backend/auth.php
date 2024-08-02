<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "middleware/index.php";
require_once "api/index.php";

session_start();
cors();
function auth() {
    global $db_conn;
    global $model;
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_SESSION['nik'])) {
            $db_src = custom_handle($db_conn, [
                'EmployeeID'=>$_SESSION['username']], 'auth', 'auth_mstr', $model, 'auth_mstr');
            $data = array(
                'name'=>$db_src[0]['Name'],
                'dept'=>$db_src[0]['Department'],
                'absen'=>$db_src[0]['Absensi'],
                'jabatan'=>$db_src[0]['Position'],
                'grade'=>$db_src[0]['Grade'],
                'role'=>isset($db_src[0]['role']) ? $db_src[0]['role'] : 'user',
            );
            if($data['dept'] === "INFORMATION TECHNOLOGY") { $data['role'] = 'super';}
            $response = $data;
        } else {
            $response = 'failed';
        }
        header("Cache-Control: public");
        header("Content-Type: application/json");
        echo json_encode($response);
        return;
    }
}
auth();

?>