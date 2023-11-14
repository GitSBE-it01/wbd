
<?php
include('conn_form_pinjam.php');
  
$id = $_REQUEST['id'];
$id_now = $_REQUEST['id_now'];
$komen = $_REQUEST['editcomment'];
$sql = "UPDATE list_komentar SET isi='$komen', status_komen='Edited', created_at = NOW() where id =$id";

  
  
if(mysqli_query($conn_form_pinjam, $sql)){
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
