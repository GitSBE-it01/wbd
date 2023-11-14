<?php
include('conn_form_pinjam.php');
include('conn_list_user.php');
include('conn_list_barang.php');
include 'checklogin.php';
$user_login = $_SESSION['username'];
  

$id = $_GET['id'];
$sql = "SELECT * FROM datapeminta where id = $id";
$result = $conn_form_pinjam->query($sql);
$result_user = $result->fetch_assoc();

$sqluser = "SELECT nama, divisi FROM user WHERE username='".$result_user['peminta_id']."'";
$result_user_peminta = $conn_list_user->query($sqluser);
$result_user_peminta_data = $result_user_peminta->fetch_assoc();

$sql = "SELECT * FROM list_minta_barang WHERE id_pinjam='".$result_user['id']."'";
$result_list_minta_barang = $conn_form_pinjam->query($sql);

$sql = "SELECT * FROM list_verifikasi WHERE id_pinjam='".$result_user['id']."'";
$result_list_verifikasi = $conn_form_pinjam->query($sql);
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
      <div class="row" id="divToPrint">
        <div class="col-lg-qw">

          <div class="card">
            <div class="card-body">
              <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nama Peminta</th>
                  <th scope="col">Dept</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Keperluan</th>
                  <th scope="col">Comment</th>
                  <th scope="col">Tenggat Waktu</th>
                  <th scope="col">Status</th>
                  <th scope="col">Finished?</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  echo '<tr>
                  <th scope="row">'.$result_user_peminta_data["nama"].'</th> 
                      <td>'.$result_user_peminta_data["divisi"].'</td> 
                      <td>';
                      while ($row_result_list_minta_barang = $result_list_minta_barang->fetch_assoc()) {
                        $sql = "SELECT CONCAT(pt_desc1, ' ', pt_desc2) as nama FROM pt_mstr where id = '".$row_result_list_minta_barang['id_barang']."'";
                        $result_part_master = $conn_list_barang->query($sql);
                        $result_part_master_data = $result_part_master->fetch_assoc();
    
                        echo '<b>Nama:</b> '.$result_part_master_data["nama"].'<br><b>Total:</b> '.$row_result_list_minta_barang["total"].'<hr>';
                      }
                      echo'</td>
                      <td>'.$result_user["keperluan"].'</td>
                      <td>'.$result_user["comment"].'</td>  
                      <td>'.$result_user["tanggal_akhir"].'</td>';
                      if ($result_user["verifikasi"] == 0){
                        echo'
                        <td>Open</td> 
                        ';
                      }
                      else{
                        echo'
                        <td>Closed</td>
                        ';
                      }
                      echo'
                      <td><a href="editformutama.php?id='.$result_user['id'].'">Yes</a></td>
                      </tr>';
                ?>
              </tbody>
              </table>   
              
              
              <table class="table">
              <thead>
                <tr>
                  <th scope="col">Mengetahui</th>
                  <th scope="col">Verifikasi</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
                  while ($row_result_list_verifikasi = $result_list_verifikasi->fetch_assoc()) {
                    echo '<tr> 
                    <td>'. $row_result_list_verifikasi["nama"] .'</td>';
                    if ($row_result_list_verifikasi["status_verifikasi"] == 0){
                      echo '<td>
                      <a href="editverifikasi.php?id='.$row_result_list_verifikasi["id"].'&verifikasi=1&id_pinjam='.$result_user['id'].'"> <img src="assets/img/greencheck.png" class="rounded-circle" style="width: 30px"> </a>
                      
                      <a href="editverifikasi.php?id='.$row_result_list_verifikasi["id"].'&verifikasi=2&id_pinjam='.$result_user['id'].'"><img src="assets/img/redcross.png" class="rounded-circle" style="width: 30px"></a>
                    </td>';
                    }
                    else if($row_result_list_verifikasi["status_verifikasi"] == 1){
                      echo'
                      <td><img src="assets/img/greencheck.png" class="rounded-circle" style="width: 30px"></td>
                      ';
                    }
                    else{
                      echo'
                      <td><img src="assets/img/redcross.png" class="rounded-circle" style="width: 30px"></td>
                      ';
                    }
                    echo '</tr>';
                  }  
                ?>
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