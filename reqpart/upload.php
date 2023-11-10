
<?php
include ('conn_list_barang.php');
include ('conn_form_pinjam.php');
include ('checklogin.php');
$user_login = $_SESSION['username'];

// FIX
$id_login =  $user_login;
$id_peminta =  $_REQUEST['nama_peminta'];
$tanggal_awal =  $_REQUEST['tanggal_awal'];
$tanggal_akhir = $_REQUEST['tanggal_akhir'];
$account_code = $_REQUEST['account_code'];
$keperluan = $_REQUEST['keperluan'];
$cost_center =  $_REQUEST['cost_center'];
$comment =  $_REQUEST['comment'];

  
$sql = "INSERT INTO datapeminta (created_id, peminta_id, tanggal_awal, account_code, keperluan, cost_center, tanggal_akhir, verifikasi, comment) VALUES ('$id_login', '$id_peminta', '$tanggal_awal','$account_code','$keperluan','$cost_center', '$tanggal_akhir', 0, '$comment')";
  
if(mysqli_query($conn_form_pinjam, $sql)){
    $id_pinjam = $conn_form_pinjam->insert_id;
    $td1 = $_POST['list_id'];
    foreach($td1 as $v) {
        $id_barang = $_POST["td_" . $v];
        $total = $_POST["total_" . $v];
        $sql = "INSERT INTO list_minta_barang (id_pinjam, id_barang, total) VALUES ('$id_pinjam', '$id_barang', '$total')";
        if(mysqli_query($conn_form_pinjam, $sql)){
        }
    }
    $td1 = $_POST['listtahu_id'];
    foreach($td1 as $v) {
        list($value1,$value2) = explode('|', $_POST["tdtahu_" . $v]);
        $sql = "INSERT INTO list_verifikasi (id_pinjam, username, nama, tanggal, status_verifikasi) VALUES ('$id_pinjam', '$value1', '$value2', '0000-00-00', '0')";
        if(mysqli_query($conn_form_pinjam, $sql)){
            ?>
            <script type="text/javascript">
            window.location = "historyminta.php";
            </script>  
            <?php
        }
        else{
            
            echo "EROR";
        }
    }

} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn_form_pinjam);
}
  
// Close connection
mysqli_close($conn_form_pinjam);
?>





