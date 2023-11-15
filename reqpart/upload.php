
<?php
include ('conn_form_pinjam.php');
include ('checklogin.php');
$user_login = $_SESSION['username'];

// FIX
$id_login =  strtoupper($user_login);
$nama_login = $_SESSION['nama'];
$divisi_login = $_SESSION['divisi'];
$email_login = $_SESSION['email'];
$id_peminta = $_REQUEST['id_peminta'];
$arr = explode("|",$id_peminta);
// $tanggal_awal =  $_REQUEST['tanggal_awal'];
$tanggal_akhir = $_REQUEST['tanggal_akhir'];
$account_code = $_REQUEST['account_code'];
$keperluan = $_REQUEST['keperluan'];
$cost_center =  $_REQUEST['cost_center'];
// $comment =  $_REQUEST['comment'];

  
$sql = "INSERT INTO datapeminta (created_id, nama_created, divisi_created, email_created, peminta_id, nama_peminta, divisi_peminta, email_peminta, tanggal_awal, account_code, keperluan, cost_center, tanggal_akhir, verifikasi) VALUES ('$id_login', '$nama_login', '$divisi_login','$email_login', '$arr[0]','$arr[2]','$arr[1]','$arr[3]', NOW(),'$account_code','$keperluan','$cost_center', '$tanggal_akhir', 0)";
  
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
        $ptum = $_POST["ptum_" . $v];
        $ptpart = $_POST["ptpart_" . $v];
        $nama_barang = $_POST["nama_barang_" . $v];
        $sql = "INSERT INTO list_minta_barang (id_pinjam, id_barang, nama_barang, pt_part, pt_um, total) VALUES ('$id_pinjam', '$id_barang', '$nama_barang', '$ptpart', '$ptum', '$total')";
        if(mysqli_query($conn_form_pinjam, $sql)){
        }
    }


    //TAMBAH EMAIL PEMINTA DAN CREATED_BY
    array_push($allNama, $_SESSION["nama"]);
    array_push($allEmail, $_SESSION["email"]);
    if($_SESSION["nama"] != $arr[2]){
        array_push($allNama, $arr[2]);
        array_push($allEmail, $arr[3]);
    }


    $td1 = $_POST['listtahu_id'];
    foreach($td1 as $v) {
        list($value1,$value2,$value3,$value4) = explode('|', $_POST["tdtahu_" . $v]);
        $sql = "INSERT INTO list_verifikasi (id_pinjam, username, nama, divisi,email, tanggal, status_verifikasi) VALUES ('$id_pinjam', '$value1', '$value3', '$value2', '$value4', '0000-00-00', '0')";
        array_push($allNama, $value2);
        array_push($allEmail, $value4);        
        if(mysqli_query($conn_form_pinjam, $sql)){
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





