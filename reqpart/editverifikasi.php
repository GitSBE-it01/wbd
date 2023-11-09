
<?php
include('conn_form_pinjam.php');
  
$id = $_GET['id'];
$ver = $_GET['verifikasi'];
if ($ver == 1){
    $sql = "UPDATE datapeminta SET verifikasi=1 where id =$id";
}
elseif ($ver == 2) {
    $sql = "UPDATE datapeminta SET verifikasi=2 where id =$id";
}
  
  
if(mysqli_query($conn_form_pinjam, $sql)){
?>
<script type="text/javascript">
window.location = "historyminta.php";
</script>  
<?php
} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn_form_pinjam);
}
  
// Close connection
mysqli_close($conn_form_pinjam);
?>
