<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "middleware/index.php";

session_start();
cors();
function auth() {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_SESSION['username'])) {
            $data = array(
                'name'=>$_SESSION['absname'],
                'dept'=>$_SESSION['divisi'],
                'absen'=>$_SESSION['absen'],
                'jabatan'=>$_SESSION['jabatan'],
                'grade'=>$_SESSION['grade'],
            );
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