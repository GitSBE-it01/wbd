<?php
include('conn_form_pinjam.php');


$sql = "SELECT * FROM datapeminta";
$result = $conn_form_pinjam->query($sql);


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
              
              <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col">Nama Peminjam</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Tanggal Minta</th>
                  <th scope="col">Tenggat Waktu</th>
                  <th scope="col">Status</th>
                  <th scope="col">Edit</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                  echo '
                  <tr> 
                      <td scope="row">'.$row["nama_peminta"].'</td> 
                      <td>'.$row["nama_barang"].'</td> 
                      <td>'.$row["tanggal_awal"].'</td> 
                      <td>'.$row["tanggal_akhir"].'</td>';
                  if ($row["verifikasi"] == 0){
                    echo'
                    <td><img src="assets/img/pending.png" class="rounded-circle" style="width: 30px"></td> 
                    ';
                  }
                  else if($row["verifikasi"] == 1){
                    echo'
                    <td><img src="assets/img/greencheck.png" class="rounded-circle" style="width: 30px"></td>
                    ';
                  }
                  else{
                    echo'
                    <td><img src="assets/img/redcross.png" class="rounded-circle" style="width: 30px"></td>
                    ';
                  }
                  if ($row["verifikasi"] == 0){
                    echo'
                    <td><a href="verifikasihistory.php?id='.$row["id"].'"><img src="assets/img/editpng.png" style="width: 30px"></a></td> 
                    </tr>';
                  }
                }
                $result->free();
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
</script>


</body>

</html>