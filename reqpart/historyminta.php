<?php
include('conn_form_pinjam.php');
include('conn_list_barang.php');
include('conn_list_user.php');


$sql = "SELECT * FROM datapeminta ORDER BY id DESC";
$result_data_peminta = $conn_form_pinjam->query($sql);




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <title>History Permintaan</title>
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
  td{
    text-align: center;
  }
  #myInput {
    background-position: 10px 12px; /* Position the search icon */
    background-repeat: no-repeat; /* Do not repeat the icon image */
    width: 100%; /* Full-width */
    font-size: 16px; /* Increase font-size */
    padding: 12px 20px 12px 20px; /* Add some padding */
    border: 1px solid #ddd; /* Add a grey border */
    margin-bottom: 12px; /* Add some space below the input */
  }

  #myTable {
    border-collapse: collapse; /* Collapse borders */
    width: 100%; /* Full-width */
    border: 1px solid #ddd; /* Add a grey border */
    font-size: 18px; /* Increase font-size */
  }

  #myTable th, #myTable td {
    text-align: left; /* Left-align text */
    padding: 12px; /* Add padding */
  }

  #myTable tr {
    /* Add a bottom border to all table rows */
    border-bottom: 1px solid #ddd;
  }

  #myTable tr.header, #myTable tr:hover {
    /* Add a grey background color to the table header and on hover */
    background-color: #f1f1f1;
  }

  .zoom {
    transition: transform .2s; /* Animation */
  }

  .zoom:hover {
    transform: scale(1.3); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
  }
  </style>
</head>

<body>

  <!-- NAVBAR
  <div id="nav-placeholder"></div>
  <script>
  $(function(){
    $("#nav-placeholder").load("navbar.html");
  });
  </script> -->

  
<?php include 'navbar.php';?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>History Permintaan</h1> 
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-qw">
          <div class="card">
            <div class="card-body">
              <div class="float-right"><h5 class="card-title"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari data..">  </h5></div>
              
              <table class="table table-hover table-bordered table-sm" id="myTable">
              <thead>
                <tr class="table-secondary align-middle">
                  <!-- <th scope="col">Created by</th> -->
                  <th class="text-center" scope="col">Nama Peminta</th>
                  <th class="text-center" scope="col">List Barang</th>
                  <th class="text-center" scope="col">Verifikasi</th>
                  <th class="text-center" scope="col">Tenggat Waktu</th>
                  <th class="text-center" scope="col">Status</th>
                  <th class="text-center" scope="col">Details</th>            
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row_result_data_peminta = $result_data_peminta->fetch_assoc()) {
                  $sqluser = "SELECT nama FROM user WHERE username='".$row_result_data_peminta['created_id']."'";
                  $result_user_login = $conn_list_user->query($sqluser);
                  $result_user_login_data = $result_user_login->fetch_assoc();
                  
                  $sqluser = "SELECT nama FROM user WHERE username='".$row_result_data_peminta['peminta_id']."'";
                  $result_user_peminta = $conn_list_user->query($sqluser);
                  $result_user_peminta_data = $result_user_peminta->fetch_assoc();

                  $sql = "SELECT * FROM list_minta_barang WHERE id_pinjam='".$row_result_data_peminta['id']."'";
                  $result_list_minta_barang = $conn_form_pinjam->query($sql);

                  $sql = "SELECT * FROM list_verifikasi WHERE id_pinjam='".$row_result_data_peminta['id']."'";
                  $result_list_verifikasi = $conn_form_pinjam->query($sql);
                  if($row_result_data_peminta["verifikasi"] == 0){
                    echo '
                    <tr>'; 
                  }
                  else{
                    echo '
                    <tr class="table-info">'; 
                  }
                     
                  echo'<td>'.$result_user_peminta_data["nama"].'</td> 
                      <td>';
                  while ($row_result_list_minta_barang = $result_list_minta_barang->fetch_assoc()) {
                    $sql = "SELECT CONCAT(pt_part, ' (', pt_desc1, ' ', pt_desc2, ')') as nama FROM pt_mstr where id = '".$row_result_list_minta_barang['id_barang']."'";
                    $result_part_master = $conn_list_barang->query($sql);
                    $result_part_master_data = $result_part_master->fetch_assoc();

                    echo '<b>Nama:</b> '.$result_part_master_data["nama"].'<br><b>Total:</b> '.$row_result_list_minta_barang["total"].'<hr>';
                  }
                  echo '<br></td> 
                      <td>';
                      while ($row_result_list_verifikasi = $result_list_verifikasi->fetch_assoc()) {
                  
                        if ($row_result_list_verifikasi["status_verifikasi"] == 0){
                          echo '<b>Nama: </b> '.$row_result_list_verifikasi["nama"].'<br><b>Status:</b> <img src="assets/img/pending.png" class="rounded-circle" style="width: 30px"> <hr>';
                        }
                        else if($row_result_list_verifikasi["status_verifikasi"] == 1){
                          echo '<b>Nama: </b> '.$row_result_list_verifikasi["nama"].'<br><b>Status:</b> <img src="assets/img/greencheck.png" class="rounded-circle" style="width: 30px"> <hr>';
                        }
                        else{
                          echo '<b>Nama: </b> '.$row_result_list_verifikasi["nama"].'<br><b>Status:</b><img src="assets/img/redcross.png" class="rounded-circle" style="width: 30px"> <hr>';
                        }
                      }    
                  echo'<br></td> 
                      <td>'.$row_result_data_peminta["tanggal_akhir"].'</td>';
                  if ($row_result_data_peminta["verifikasi"] == 0){
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
                  <td><div class="zoom"><a href="verifikasihistory.php?id='.$row_result_data_peminta["id"].'" target="_blank"><img src="assets/img/editpng.png" style="width: 30px"></a></div></td></tr>
                  ';
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


<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  th = table.getElementsByTagName("th");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    for (j = 0; j < th.length; j++){
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
}

function PrintDiv() {
  var divToPrint = document.getElementById('divToPrint');
  var popupWin = window.open('printform.php');
  popupWin.document.open();
  popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
  popupWin.document.close();
}
</script>


</body>

</html>