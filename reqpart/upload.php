
<?php
include ('conn_list_barang.php');
include ('conn_list_user.php');
include ('conn_form_pinjam.php');
include ('checklogin.php');
$user_login = $_SESSION['username'];

// FIX
$id_login =  strtoupper($user_login);
$id_peminta =  $_REQUEST['nama_peminta'];
// $tanggal_awal =  $_REQUEST['tanggal_awal'];
$tanggal_akhir = $_REQUEST['tanggal_akhir'];
$account_code = $_REQUEST['account_code'];
$keperluan = $_REQUEST['keperluan'];
$cost_center =  $_REQUEST['cost_center'];
// $comment =  $_REQUEST['comment'];

  
$sql = "INSERT INTO datapeminta (created_id, peminta_id, tanggal_awal, account_code, keperluan, cost_center, tanggal_akhir, verifikasi) VALUES ('$id_login', '$id_peminta', NOW(),'$account_code','$keperluan','$cost_center', '$tanggal_akhir', 0)";
  
$allNama = array();
$allEmail = array();
$last_inserted_id = 0;
if(mysqli_query($conn_form_pinjam, $sql)){
    $id_pinjam = $conn_form_pinjam->insert_id;
    $last_inserted_id = $id_pinjam;
    $td1 = $_POST['list_id'];
    foreach($td1 as $v) {
        $id_barang = $_POST["td_" . $v];
        $total = $_POST["total_" . $v];
        $sql = "INSERT INTO list_minta_barang (id_pinjam, id_barang, total) VALUES ('$id_pinjam', '$id_barang', '$total')";
        if(mysqli_query($conn_form_pinjam, $sql)){
        }
    }


    //PEMINTA
    $sqluser = "SELECT nama, divisi FROM user WHERE username='".$id_peminta."'";
    $result_user = $conn_list_user->query($sqluser);
    $result_user_data = $result_user->fetch_assoc();
    array_push($allNama, $result_user_data["nama"]);
    $sqlalamatemail = "SELECT email FROM user WHERE username='".$id_peminta."'";
    $result_sqlalamatemail = $conn_list_user->query($sqlalamatemail);
    $result_sqlalamatemail_data = $result_sqlalamatemail->fetch_assoc();
    array_push($allEmail, $result_sqlalamatemail_data['email']);


    $td1 = $_POST['listtahu_id'];
    foreach($td1 as $v) {
        list($value1,$value2) = explode('|', $_POST["tdtahu_" . $v]);
        $sql = "INSERT INTO list_verifikasi (id_pinjam, username, nama, tanggal, status_verifikasi) VALUES ('$id_pinjam', '$value1', '$value2', '0000-00-00', '0')";
        if(mysqli_query($conn_form_pinjam, $sql)){
            array_push($allNama, $value2);
            $sqlalamatemail = "SELECT email FROM user WHERE username='".$value1."'";
            $result_sqlalamatemail = $conn_list_user->query($sqlalamatemail);
            $result_sqlalamatemail_data = $result_sqlalamatemail->fetch_assoc();
            array_push($allEmail, $result_sqlalamatemail_data['email']);        
        }
        else{
            echo "EROR";
        }
    }

} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn_form_pinjam);
}
  
foreach($allNama as $key=>$value) {
    require_once "Mail.php";
    $subject = "REQUEST SPAREPART - PERMINTAAN";
    $body  = "Dear " .$allNama[$key]."\n \n";
    $body .= "\n";
    $body .= "Keperluan:  ".$keperluan."\n  \n";
    $body .= "Click link below to view detail.\n";
    $body .= "http://192.168.2.103:8080/wbd/reqpart/verifikasihistory.php?id=".$last_inserted_id." \n";
    $body .= "";
    $body .= "\n";
    $body .= "- Sinar Baja Electric Information System -\n";
  
    $to = $allEmail[$key];
    //$to = "it.indra@sbe.co.id";
    $from = "SBE-InformationSystem";
    $host = "192.168.2.242";
    $port = "25";
    $username = "";
    $password = "Sinar123";
  
    $headers = array('From' => $from, 'To' => $to,'Subject' => $subject);
    $smtp = Mail::factory('smtp', array('host' => $host, 'port' => $port, 'auth' => false, 'username' => $username, 'password' => $password));
    $mail = $smtp -> send($to, $headers, $body);
  
}
 
  ?>
  <script type="text/javascript">
  window.location = "historyminta.php";
  </script>  
  <?php


// Close connection
mysqli_close($conn_form_pinjam);
?>





