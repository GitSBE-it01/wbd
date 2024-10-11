<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "middleware/index.php";
require_once "api/index.php";

session_start();
cors();
function auth() {
    global $model;
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $reff = explode("/",$_SERVER['HTTP_REFERER']);
        if(isset($_SESSION['nik'])) {
            $db_src = custom_handle([
                'EmployeeID'=>$_SESSION['nik']], 'auth', 'auth_mstr', $model, 'auth_mstr');
            $fix_dt = [];
            foreach($db_src as $set) {
                $check = str_replace("\r\n", "",$set['apps']);
                if($check === $reff[4]) {
                    $fix_dt[]=$set;
                }
            }
            
            $data = array(
                'name'=>$db_src[0]['Name'],
                'dept'=>$db_src[0]['Department'],
                'absen'=>$db_src[0]['Absensi'],
                'nik'=>$db_src[0]['EmployeeID'],
                'jabatan'=>$db_src[0]['Position'],
                'grade'=>$db_src[0]['Grade'],
                'role'=>isset($fix_dt[0]['role'])  ?  str_replace("\r\n", "",$fix_dt[0]['role']) : 'user',
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