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
        $reff = explode("/",$_SERVER['HTTP_REFERER']);
        $routes = $reff[4];
        if(isset($_SESSION['username'])) {
            $data = array(
                'name'=>$_SESSION['absname'],
                'dept'=>$_SESSION['divisi'],
                'absen'=>$_SESSION['absen'],
                'jabatan'=>$_SESSION['jabatan'],
                'grade'=>$_SESSION['grade'],
            );
            $role = custom_handle($db_conn, ['absen'=>$_SESSION['absen'], 'abs_name'=>$_SESSION['absname'], 'apps'=>$routes], 'auth', 'auth_fetch', $model, 'auth');
            if(count($role) === 1) {
                $data['role'] = $role[0]['role'];
            } else {
                $data['role'] = 'user';
            }
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