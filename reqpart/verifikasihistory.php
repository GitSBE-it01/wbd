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

$sql = "SELECT * FROM list_komentar WHERE id_pinjam='".$result_user['id']."'";
$result_list_komentar = $conn_form_pinjam->query($sql);
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
  <link href="assets/vendor/quill/quill.bubble.c  ss" rel="stylesheet">
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
              <tbody>
                <tr>
                  <th scope="col">Nama Peminta</th>
                  <?php
                  echo '<td>'.$result_user_peminta_data["nama"].'</td></tr>';
                  ?>

                <tr>
                  <th scope="col">Asal Departemen</th>
                  <?php
                  echo '<td>'.$result_user_peminta_data["divisi"].'</td></tr>';
                  ?>

                <tr>
                  <th scope="col">Nama Barang</th>
                  <?php
                  echo '
                      <td>';
                      while ($row_result_list_minta_barang = $result_list_minta_barang->fetch_assoc()) {
                        $sql = "SELECT CONCAT(pt_part, ' (',pt_desc1, ' ', pt_desc2, ')') as nama FROM pt_mstr where id = '".$row_result_list_minta_barang['id_barang']."'";
                        $result_part_master = $conn_list_barang->query($sql);
                        $result_part_master_data = $result_part_master->fetch_assoc();
    
                        echo '<b>Nama:</b> '.$result_part_master_data["nama"].'<br><b>Total:</b> '.$row_result_list_minta_barang["total"].'<br>';
                      }
                      echo'</td></tr>';
                    ?>

                <tr>
                  <th scope="col">Keperluan</th>
                  <?php
                  echo'
                  <td>'.$result_user["keperluan"].'</td></tr>';
                  ?>

                <tr>
                  <th scope="col">Tenggat Waktu</th>
                  <?php
                  echo'
                  <td>'.$result_user["tanggal_akhir"].'</td></tr>';
                  ?>

                <tr>
                  <th scope="col">Status</th>
                  <?php
                  if ($result_user["verifikasi"] == 0){
                    echo'
                    <td>Open</td></tr> 
                    ';
                  }
                  else{
                    echo'
                    <td>Closed</td></tr>
                    ';
                  }
                  ?>
                      <!-- // echo'
                      // <td><a href="editformutama.php?id='.$result_user['id'].'">Yes</a></td>
                      // </tr>'; -->
              </tbody>
              </table>   
              <br><br>
              
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
                      if (strtoupper($user_login) == strtoupper($row_result_list_verifikasi["username"])){
                      echo '<td>
                      <a href="editverifikasi.php?id='.$row_result_list_verifikasi["id"].'&verifikasi=1&id_pinjam='.$result_user['id'].'"> <img src="assets/img/greencheck.png" class="rounded-circle" style="width: 30px"> </a>
                      
                      <a href="editverifikasi.php?id='.$row_result_list_verifikasi["id"].'&verifikasi=2&id_pinjam='.$result_user['id'].'"><img src="assets/img/redcross.png" class="rounded-circle" style="width: 30px"></a>
                      </td>';
                      }
                      else{
                        if($row_result_list_verifikasi["status_verifikasi"] == 1){
                          echo'
                          <td><img src="assets/img/greencheck.png" class="rounded-circle" style="width: 30px"></td>
                          ';
                        }
                        else if($row_result_list_verifikasi["status_verifikasi"] == 2){
                          echo'
                          <td><img src="assets/img/redcross.png" class="rounded-circle" style="width: 30px"></td>
                          ';
                        }
                        else{
                          echo'
                          <td><img src="assets/img/pending.png" class="rounded-circle" style="width: 30px"></td>
                          ';
                        }
                      }
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

        <div class="pagetitle">
          <h1>Comment</h1> 
        </div><!-- End Page Title -->

        <div class="col-lg-qw">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th style="width=60%">Komentar</th>
                    <th>File</th>
                    <th>Edit</th>

                </tr>
                </thead>
                <tbody>
                <?php
                  while ($row_result_list_komentar = $result_list_komentar->fetch_assoc()) {
                    if($row_result_list_komentar['status_komen']!= "Deleted"){
                    echo '<tr>
                    <td style="width=20%"><div style="text-align=center">'.$row_result_list_komentar['nama'].'</div><hr><b>'.$row_result_list_komentar['status_komen'].': </b>'.$row_result_list_komentar['created_at'].'</td>';
                    if(strtoupper($row_result_list_komentar['username']) == strtoupper($user_login)){
                        echo'
                        <td><form method="POST" action="editcomment.php">
                        <textarea name="editcomment" rows="4" cols="70">'.$row_result_list_komentar['isi'].'</textarea><input type="hidden" name="id" value='.$row_result_list_komentar['id'].'><input type="hidden" name="id_now" value='.$id.'><br>
                        <button class="btn btn-success" id="submit">Edit</button>
                        </form></td>
                        <td><a href="assets/files/'.$row_result_list_komentar['namafile'].'" target="_blank">'.$row_result_list_komentar['namafile'].'</a></td>
                        <td><a href="deletecomment.php?id='.$row_result_list_komentar['id'].'&id_now='.$id.'">Delete</a></td>
                        </tr>';
                      }
                      else{
                        echo'<td>'.$row_result_list_komentar['isi'].'</td>
                        <td>'.$row_result_list_komentar['namafile'].'</td>
                        <td></td>
                        </tr>';
                      }
                    }
                  }
                  ?>
                  </tbody>
                </table>
              <!-- <input type="button" value="print" onclick="PrintDiv();" /> -->
            </div>
          </div> 
        </div>
      </div>
      <div class="row">
        <div class="col-lg-qw">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <tbody>
                  <tr>
                  <th><a>Klik disini untuk Print:</a><th>
                  <td><div><a onclick="PrintDiv();"><img src="assets/img/print.png" style="width: 30px"></a></div></td>
                  </tr>
                  <tr>
                  <?php
                    if(strtoupper($user_login) == strtoupper($result_user['peminta_id']) ||strtoupper($user_login) == strtoupper($result_user['created_id'])){ // CUMA BOLEH YG BUAT YG FINISH
                      echo '<th><a>Permohonan Selesai?</a><th>                      
                      <td><a href="editformutama.php?id='.$result_user['id'].'">Yes</a></td>';
                    }
                  ?>                  
                  </tr>
                  <tr>
                  <th><a>Tambah Comment:</a><th>
                  <?php
                  echo'
                  <form method="POST" action="addcomment.php" enctype="multipart/form-data">
                  <td><textarea name="newcomment" rows="4" cols="100"></textarea><input type="hidden" name="id" value='.$id.'><input type="hidden" name="username" value='.$user_login.'>
                  <input type="file" id="myfile" name="myfile"><br><br>
                  <button class="btn btn-success" id="submit">Submit</button></td>
                  </form>';
                  ?>
                  </tr>
                </tbody>
                </table>
              <!-- <input type="button" value="print" onclick="PrintDiv();" /> -->
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>

  <script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank');
       popupWin.document.open();
       popupWin.document.write('<html><head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"></html><h1>Form Permintaan Spare Part</h1><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
      popupWin.document.close();
            }
 </script>
</body>

</html>