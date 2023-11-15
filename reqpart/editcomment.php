
<?php
include('conn_form_pinjam.php');
include ('checklogin.php');

$id = $_REQUEST['id'];
$id_now = $_REQUEST['id_now'];
$komen = $_REQUEST['editcomment'];
$sql = "UPDATE list_komentar SET isi='$komen', status_komen='Edited', created_at = NOW() where id =$id";

$allNama = array();
$allEmail = array();
if(mysqli_query($conn_form_pinjam, $sql)){
    $sql1 = "SELECT username, nama, email FROM list_verifikasi WHERE id_pinjam=$id_now";
    $result = $conn_form_pinjam->query($sql1);
    while ($result_data_loop = $result->fetch_assoc()) {
        array_push($allNama, $result_data_loop["nama"]);
        array_push($allEmail, $result_data_loop["email"]);
    }

    $sql1 = "SELECT created_id, peminta_id, nama_created, email_created, nama_peminta, email_peminta FROM datapeminta WHERE id=$id_now";
    $result = $conn_form_pinjam->query($sql1);
    $result_data = $result->fetch_assoc();

    array_push($allNama, $_SESSION["nama"]);
    array_push($allEmail, $_SESSION['email']);
    if($_SESSION["email"] != $result_data["email_created"]){
        array_push($allNama, $result_data["nama_created"]);
        array_push($allEmail, $result_data["email_created"]);
        if($_SESSION["email"] != $result_data["email_peminta"] && $result_data["email_peminta"] != $result_data["email_created"]){
            array_push($allNama, $result_data["nama_peminta"]);
            array_push($allEmail, $result_data["email_peminta"]);
        }
    }
    else{
        if($_SESSION["email"] != $result_data["email_peminta"]){
            array_push($allNama, $result_data["nama_peminta"]);
            array_push($allEmail, $result_data["email_peminta"]);
        }
    }

    foreach(array_unique($allNama) as $key=>$value) {
        require_once "Mail.php";
        $subject = "REQUEST SPAREPART - EDIT COMMENT";
        $body  = "Dear" .$allNama[$key]."\n \n";
        $body .= "\n";
        $body .= "Edited Comment: ".$komen."\n  \n";
        $body .= "Click link below to view detail.\n";
        $body .= "http://192.168.2.103:8080/wbd/reqpart/verifikasihistory.php?id=".$id_now." \n";
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
    <?php echo 'window.location = "verifikasihistory.php?id='. $id_now.'"'; ?>
    </script>  
    <?php
} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn_form_pinjam);
}
  
// Close connection
mysqli_close($conn_form_pinjam);
?>
