
<?php
include('conn_form_pinjam.php');
include('conn_list_user.php');

$id = $_REQUEST['id'];
$komen = $_REQUEST['newcomment'];
$username = $_REQUEST['username'];

$sqluser = "SELECT nama, divisi FROM user WHERE username='".$username."'";
$result_user = $conn_list_user->query($sqluser);
$result_user_data = $result_user->fetch_assoc();

$sqlemail = "SELECT nama, username FROM list_verifikasi WHERE id_pinjam=$id";
$result_email = $conn_form_pinjam->query($sqlemail);

$sql = "INSERT INTO list_komentar (username, nama, id_pinjam, isi, status_komen, created_at) VALUES ('".$username."', '".$result_user_data["nama"]."', $id, '".$komen."', 'Created', NOW())";
  
$allNama = array();
$allEmail = array();
if(mysqli_query($conn_form_pinjam, $sql)){
    $last_inserted_id = $conn_form_pinjam->insert_id;
    $sql = "SELECT comment FROM datapeminta WHERE id=$id";
    $result_comment = $conn_form_pinjam->query($sql);
    $result_comment_data = $result_comment->fetch_assoc();
    //SET ID COMMENT DARI LAST INSERTED ID
    if($result_comment_data["comment"] == 0){
        $sql = "UPDATE datapeminta SET comment=$last_inserted_id WHERE id=$id";
        if(mysqli_query($conn_form_pinjam, $sql)){
        }
    }

    if( $_FILES['myfile']['name'] != "" ) {
        $dir_gambar = 'D:\xampp\htdocs\wbd\reqpart\assets\files\\';
        $url_folder_gambar = 'http://192.168.2.103/wbd/reqpart/assets/files/';
        $path=$_FILES['myfile']['name'];
        $path =  str_replace(' ', '_', $path);
        $uploadfile = $dir_gambar.$last_inserted_id.'.'.$path;
        move_uploaded_file( $_FILES['myfile']['tmp_name'],$uploadfile) or die( "Could not copy file!");

        $namafinalfile = $last_inserted_id.'.'.$path;
        $sql = "UPDATE list_komentar SET namafile = '".$namafinalfile."' WHERE id=$last_inserted_id";
        if(mysqli_query($conn_form_pinjam, $sql)){
        }
    }
    
    while ($result_email_data = $result_email->fetch_assoc()) {
        array_push($allNama, $result_email_data["nama"]);
        $sqlalamatemail = "SELECT email FROM user WHERE username='".$result_email_data["username"]."'";
        $result_sqlalamatemail = $conn_list_user->query($sqlalamatemail);
        while ($result_sqlalamatemail_data = $result_sqlalamatemail->fetch_assoc()) {
            array_push($allEmail, $result_sqlalamatemail_data['email']);
        }
    }

    foreach($allNama as $key=>$value) {
        require_once "Mail.php";
        $subject = "REQUEST SPAREPART - NEW COMMENT";
        $body  = "Dear ".$allNama[$key]."\n \n";
        $body .= "\n";
        $body .= "Comment by: ".$result_user_data["nama"]." (".$result_user_data["divisi"].")\n";
        $body .= "Comment:  ".$komen."\n  \n";
        $body .= "Click link below to view detail.\n";
        $body .= "http://192.168.2.103:8080/wbd/reqpart/verifikasihistory.php?id=".$id." \n";
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
    <?php echo 'window.location = "verifikasihistory.php?id='. $id.'"'; ?>
    </script>  
<?php
 
    
} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn_form_pinjam);
}
  
// Close connection
mysqli_close($conn_form_pinjam);
?>
