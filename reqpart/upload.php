
<?php

$conn = mysqli_connect("localhost", "root", "", "formsparepart");
  
if($conn === false){
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}
  
$nama_peminta =  $_REQUEST['nama_peminta'];
$departemen = $_REQUEST['departemen'];
$tanggal_awal =  $_REQUEST['tanggal_awal'];
$nama_barang = $_REQUEST['nama_barang'];
$account_code = $_REQUEST['account_code'];
$keperluan = $_REQUEST['keperluan'];
$cost_center =  $_REQUEST['cost_center'];
$tanggal_akhir = $_REQUEST['tanggal_akhir'];
  
$sql = "INSERT INTO datapeminta (nama_peminta, departemen, tanggal_awal, nama_barang, account_code, keperluan, cost_center, tanggal_akhir, verifikasi) VALUES ('$nama_peminta', 
    '$departemen','$tanggal_awal','$nama_barang','$account_code','$keperluan','$cost_center', '$tanggal_akhir', 0)";
  
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
