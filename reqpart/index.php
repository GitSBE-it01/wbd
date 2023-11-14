<?php
include 'navbar.php';
include 'checklogin.php';
$user_login = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home</title>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <style type="text/css">
  h1 {
  text-align: center;

  }

  </style>
</head>

<body>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Home</h1>
     
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <h1 style="text-align: center">Permintaan Spare Part</h1>
    
      </div>
    </section>

  </main><!-- End #main -->

  
<!-- FOOTER -->
  <?php include 'footer.php';?>
</body>

</html>