<?php
include('conn_form_pinjam.php');
  
if($conn_form_pinjam === false){
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}
$id = $_GET['id'];
$sql = "SELECT * FROM datapeminta where id = $id";
$result = $conn_form_pinjam->query($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }
// $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <title>Verifikasi</title>
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
  <style>
      h1 {
  text-align: center;
  }
  </style>
</head>

<body>

<?php include 'navbar.php';?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Verifikasi Permintaan</h1> 
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-qw">

          <div class="card">
            <div class="card-body">
              <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nama Peminta</th>
                  <th scope="col">Asal Departemen</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Account Code</th>
                  <th scope="col">Keperluan</th>
                  <th scope="col">Cost Center</th>
                  <th scope="col">Tanggal Minta</th>
                  <th scope="col">Tenggat Waktu</th>
                  <th scope="col">Status</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr> 
                <?php
                while ($row = $result->fetch_assoc()) {
                  echo '
                      <th scope="row">'.$row["nama_peminta"].'</th> 
                      <td>'.$row["departemen"].'</td> 
                      <td>'.$row["nama_barang"].'</td>
                      <td>'.$row["account_code"].'</td>  
                      <td>'.$row["keperluan"].'</td>
                      <td>'.$row["cost_center"].'</td>  
                      <td>'.$row["tanggal_awal"].'</td> 
                      <td>'.$row["tanggal_akhir"].'</td>
                      <td>
                        <a href="editverifikasi.php?id='.$row["id"].'&verifikasi=1"> <img src="assets/img/greencheck.png" class="rounded-circle" style="width: 30px"> </a>
                        
                        <a href="editverifikasi.php?id='.$row["id"].'&verifikasi=2"><img src="assets/img/redcross.png" class="rounded-circle" style="width: 30px"></a>
                      </td>
                    ';}
                ?>
                <td>
              

              </td>
              </tr>
              </tbody>
              </table>     
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>

</body>

</html>