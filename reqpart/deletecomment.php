
<?php
include('conn_form_pinjam.php');
  
$id = $_GET['id'];
$id_now = $_GET['id_now'];
$sql = "UPDATE list_komentar SET status_komen='Deleted', created_at = NOW() where id =$id";

  
  
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
