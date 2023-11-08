
<?php

$conn = mysqli_connect("localhost", "root", "", "formsparepart");
  
if($conn === false){
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}
  
$id = $_GET['id'];
$ver = $_GET['verifikasi'];
if ($ver == 1){
    $sql = "UPDATE datapeminta SET verifikasi=1 where id =$id";
}
elseif ($ver == 2) {
    $sql = "UPDATE datapeminta SET verifikasi=2 where id =$id";
}
  
  
if(mysqli_query($conn, $sql)){
?>
<script type="text/javascript">
window.location = "historyminta.php";
</script>  
<?php
} else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn);
}
  
// Close connection
mysqli_close($conn);
?>
