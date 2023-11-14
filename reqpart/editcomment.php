
<?php
include('conn_form_pinjam.php');
include ('conn_list_user.php');
include ('checklogin.php');
$user_login = $_SESSION['username'];
  
$sqllogin = "SELECT nama FROM user WHERE username='".$user_login."'";
$result_sqllogin = $conn_list_user->query($sqllogin);
$result_sqllogin_data = $result_sqllogin->fetch_assoc();

$id = $_REQUEST['id'];
$id_now = $_REQUEST['id_now'];
$komen = $_REQUEST['editcomment'];
$sql = "UPDATE list_komentar SET isi='$komen', status_komen='Edited', created_at = NOW() where id =$id";

$allNama = array();
$allEmail = array();
  
if(mysqli_query($conn_form_pinjam, $sql)){
    $sql = "SELECT username, nama FROM list_verifikasi WHERE id_pinjam=$id_now";
    $result = $conn_form_pinjam->query($sql);
    while ($result_data_loop = $result->fetch_assoc()) {
        array_push($allNama, $result_data_loop["nama"]);
        $sqlemail = "SELECT email FROM user WHERE username='".$result_data_loop["username"]."'";
        $result_sqlemail = $conn_list_user->query($sqlemail);
        $result_sqlemail_data = $result_sqlemail->fetch_assoc();
        array_push($allEmail, $result_sqlemail_data['email']);
    }

    $sql = "SELECT created_id, peminta_id FROM datapeminta WHERE id=$id_now";
    $result = $conn_form_pinjam->query($sql);
    $result_data = $result->fetch_assoc();
    if(strtoupper($result_data["created_id"]) != strtoupper($user_login)){
        $sqlemail = "SELECT nama, email FROM user WHERE username='".$result_data["created_id"]."'";
        $result_sqlemail = $conn_list_user->query($sqlemail);
        $result_sqlemail_data = $result_sqlemail->fetch_assoc();
        array_push($allNama, $result_sqlemail_data["nama"]);
        array_push($allEmail, $result_sqlemail_data['email']);
    }
    if(strtoupper($result_data["peminta_id"]) != strtoupper($user_login)){
        $sqlemail = "SELECT nama, email FROM user WHERE username='".$result_data["peminta_id"]."'";
        $result_sqlemail = $conn_list_user->query($sqlemail);
        $result_sqlemail_data = $result_sqlemail->fetch_assoc();
        array_push($allNama, $result_sqlemail_data["nama"]);
        array_push($allEmail, $result_sqlemail_data['email']);
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
