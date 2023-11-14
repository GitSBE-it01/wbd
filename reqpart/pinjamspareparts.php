<?php

include ('conn_list_user.php');
include ('conn_list_barang.php');
include 'checklogin.php';
$user_login = $_SESSION['username'];


$sql = "SELECT * from user where jabatan='Staff' OR jabatan='Staff Approval' OR jabatan='Superintendent' OR jabatan='Manager'";
$data_user = $conn_list_user->query($sql);

$sql = "SELECT * from pt_mstr where pt_part LIKE '3%'";
$data_barang = $conn_list_barang->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Permintaan</title>
  <!-- <script>
    $(function(){
      $("#styling-placeholder").load("styling.html");
    });
  </script> -->
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <style type="text/css">
  h1 {
  text-align: center;
  }

  </style>

</head>

<body>

  <!-- ======= Header ======= -->
  
<?php include 'navbar.php';?>

  <main id="main" class="main">
  

    <div class="pagetitle">
      <h1>Permintaan</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Permintaan Spare Parts</h5>

              <form method="POST" action="upload.php">
  
                <div class="col-md-12">  
                    <div class="form-group">
                        <label for="inputnama">Nama Peminta: </label>
                        <select class="js-example-basic-single" id="inputnama" name="nama_peminta">
                          <?php 
                           while ($row = $data_user->fetch_assoc()) {
                             echo '
                             <option value="'.$row["username"].'">'.$row["divisi"].' - '.$row["nama"].'</option>
                               ';}
                          ?>
                        </select>
                    </div>
                    <br><br>

                    <?php
                    $sql = "SELECT * from user where jabatan='Staff' OR jabatan='Staff Approval' OR jabatan='Superintendent' OR jabatan='Manager'";
$data_user = $conn_list_user->query($sql);                    
                    ?>
                    <div class="form-group">
                        <label for="inputdiketahui">Diketahui oleh: </label>
                        <select class="js-example-basic-single2" id="inputdiketahui" name="diketahui" onchange="addDiketahui()">
                          <?php 
                           while ($row = $data_user->fetch_assoc()) {
                             echo '
                             <option value="'.$row["username"].'|'.$row["divisi"].' '.$row["nama"].'">'.$row["divisi"].' - '.$row["nama"].'</option>
                               ';}
                          ?>
                        </select>
                        <div id="list_diketahui"></div>
                    </div>


                    <table class="table" id="myTablediketahui">
                      <thead>
                        <tr>
                          <th scope="col" style="width: 80%">Nama Mengetahui</th>
                          <th scope="col">Edit</th>
                        </tr>
                      </thead>
                      <tbody id="isi_diketahui" name="isi_diketahui[]">
                      </tbody>
                    </table>


                    <br><br>
                    


                    <div class="form-group">
                        <label for="inputnamabarang">Nama Barang: </label>
                        <select class="js-example-basic-single3" id="inputnamabarang" name="nama_barang" onchange="addBarang()">
                          <?php 
                           while ($row = $data_barang->fetch_assoc()) {
                             echo '
                             <option value="'.$row["id"].'|'.$row["pt_part"].' '.$row["pt_desc1"].' '.$row["pt_desc2"].'">'.$row["pt_part"].' ('.$row["pt_desc1"].' '.$row["pt_desc2"].')</option>
                               ';}
                          ?>
                        </select>
                        <div id="list_nama_barang"></div>
                    </div>


                    <table class="table" id="myTable">
                      <thead>
                        <tr>
                          <th scope="col" style="width: 60%">Nama Barang</th>
                          <th scope="col" style="width: 20%">Jumlah Barang</th>
                          <th scope="col">Edit</th>
                        </tr>
                      </thead>
                      <tbody id="isi_barang_minta" name="isi_barang_minta[]">
                      </tbody>
                    </table>

                    <br><br>

                    <!-- <div class="form-group">
                        <label for="inputtglminta">Tanggal Minta</label>
                        <input type="date" class="form-control" id="inputtglminta" name="tanggal_awal" placeholder="Masukkan Tanggal Awal">
                    </div> -->
                    <!-- <br><br> -->
                    <div class="form-group">
                        <label for="inputduedate">Tanggal Akhir: </label>
                        <input type="date" class="form-control" id="inputduedate" name="tanggal_akhir" placeholder="Masukkan Tenggat Waktu">
                    </div>
                    <br><br>
            
                    <div class="form-group">
                        <label for="inputacccode">Account Code: </label>
                        <input type="text" class="form-control" id="inputacccode" name="account_code" placeholder="Masukkan Account Code">
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="inputperlu">Keperluan: </label>
                        <input type="text" class="form-control" id="inputperlu" name="keperluan" placeholder="Masukkan Penjelasan Keperluan">
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="inputcostcenter">Cost Center: </label>
                        <input type="text" class="form-control" id="inputcostcenter" name="cost_center" placeholder="Masukkan Cost Center">
                    </div>
                    <br><br>
                </div>
                <br/>
                <button style="align-items: center;" class="btn btn-success" id="submit">Submit</button>
            </form>
            </div>
          </div>
              <script src="js/jquery-3.3.1.min.js"></script>
              <script src="js/popper.min.js"></script>
              <script src="js/bootstrap.min.js"></script>
              <script src="js/jquery.sticky.js"></script>
              <script src="js/main.js"></script>
        </div>

        
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>

  <script>
    var counter = 0;
    function addBarang() {
      counter++;
      var selectBox = document.getElementById("inputnamabarang");
      let selectedValue = selectBox.options[selectBox.selectedIndex].value;
      const myArray = selectedValue.split("|"); 
      let htm = "<tr id=fulldel_"+ counter +"><td id='"+ myArray[0] +"' name='data_"+ myArray[0] +"' value='"+ myArray[0] +"'><input type='hidden' name='td_"+counter +"' value='"+ myArray[0] +"'>"+ myArray[1] +"</td> <td><input type='text' name='total_" +counter+ "'></td> <td><input type=button id='del_"+counter+"' value='cancel'><input type='hidden' name='list_id[]' value = '"+ counter +"'></td></tr>";
      document.getElementById("isi_barang_minta").innerHTML += htm;
      // document.getElementById("tempat_tambah_list_id["+ counter-1 +"]").innerHTML = counter;
    }

    document.addEventListener("click", function(event) {
      if (event.target.getAttribute('type') === 'button' && event.target.getAttribute('id').includes('del_')) {
        const idTarget = event.target.getAttribute('id');
        const id_saja = idTarget.replace(/del_/g, "");
        const id_delete = "fulldel_" + id_saja
        // window.alert(id_delete)
        document.getElementById(id_delete).remove();
        //idElement.remove();
      }
    })

    var counterDiketahui = 0;
    function addDiketahui() {
      counterDiketahui++;
      var selectBox = document.getElementById("inputdiketahui");
      let selectedValue = selectBox.options[selectBox.selectedIndex].value;
      const myArray = selectedValue.split("|"); 
      let htm = "<tr id=fulldeltahu_"+ counterDiketahui +"><td id='"+ myArray[0] +"' name='datatahu_"+ myArray[0] +"' value='"+ myArray[0] +"'><input type='hidden' name='tdtahu_"+counterDiketahui +"' value='"+ selectedValue +"'>"+ myArray[1] +"</td> <td><input type=button id='deltahu_"+counterDiketahui+"' value='cancel'><input type='hidden' name='listtahu_id[]' value = '"+ counterDiketahui +"'></td></tr>";
      document.getElementById("isi_diketahui").innerHTML += htm;
      // document.getElementById("tempat_tambah_list_id["+ counter-1 +"]").innerHTML = counter;
    }

    document.addEventListener("click", function(event) {
      if (event.target.getAttribute('type') === 'button' && event.target.getAttribute('id').includes('deltahu_')) {
        const idTarget = event.target.getAttribute('id');
        const id_saja = idTarget.replace(/deltahu_/g, "");
        const id_delete = "fulldeltahu_" + id_saja
        // window.alert(id_delete)
        document.getElementById(id_delete).remove();
        //idElement.remove();
      }
    })

    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.js-example-basic-single2').select2();
    $('.js-example-basic-single3').select2();
    });
    </script>

  

</body>

</html>