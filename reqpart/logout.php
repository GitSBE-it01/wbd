<?php
//lanjutkan session yang sudah dibuat sebelumnya
session_start();
 
//hapus session yang sudah dibuat
session_destroy();
 
//redirect ke halaman login
header('location:../../login.php');
if(isset($_GET["error"]) && $_GET['error'] == 1){
    header('location:../../login.php?error=2');
}
?>