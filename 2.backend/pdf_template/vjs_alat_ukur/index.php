<?php
function body_vjs_alat_ukur($filter) {
    $query = 'SELECT hd.eff_date, hd.decision, lg.check_point, lg.standard, lg.result, hd.approval_by FROM dbvjs_online.new_vjs_hd hd JOIN dbvjs_online.new_vjs_log lg on hd.data_group = lg.data_group WHERE hd.sn_id=? AND hd.period=?';
    $type = 'ss';
    $fltr = [
      'sn_id'=>$filter['sn_id'],
      'period'=>$filter['period']
    ];
    $data = DB::execQuery($query, $type , $fltr);
    $test = [];
    $count = 1;
    $appr = '';
    foreach($data as $set) {
      if($appr === '') {
        $appr = $set['approval_by'];
      }
      $date = explode('-', $set['eff_date']);
      if(!$test[$set['check_point']]) {
        $test[$set['check_point']] = [
          'check_point'=> $set['check_point'],
          'standard'=> $set['standard'],
          "$date[2]"=>$set['result'],
        ];
      } else {
        $test[$set['check_point']]["$date[2]"] =$set['result'];
      }
      if(!$test['decision']) {
        $test['decision'] = [
          'check_point'=> 'Decision',
          'standard'=> "",
          "$date[2]"=>$set['decision'],
        ];
      } else {
        $test['decision']["$date[2]"] =$set['decision'];
      }
    }
    $cek = array_keys($test);
    sort($cek);
    $fix = [];
    foreach($cek as $val) {
      $dt = $test["$val"];
      $dt['no'] = $count;
      $fix[]=$dt;
      $count++;
    }
    $tbody = '';
    foreach($fix as $set) {
      for($i=0; $i<32; $i++) {
        if($i<10) {
          $ct = 0+$i;
        } else {
          $ct = $i;
        }
        if(!$set["$ct"]) {
          $set["ct"] = '';
        }
      }
      if($set['check_point'] !== 'remark') {
        $tr = "
        <tr>
          <td>".$set['no']."</td>
          <td>".$set['check_point']."</td>
          <td>".$set['standard']."</td>
          <td>".$set['01']."</td>
          <td>".$set['02']."</td>
          <td>".$set['03']."</td>
          <td>".$set['04']."</td>
          <td>".$set['05']."</td>
          <td>".$set['06']."</td>
          <td>".$set['07']."</td>
          <td>".$set['08']."</td>
          <td>".$set['09']."</td>
          <td>".$set['10']."</td>
          <td>".$set['11']."</td>
          <td>".$set['12']."</td>
          <td>".$set['13']."</td>
          <td>".$set['14']."</td>
          <td>".$set['15']."</td>
          <td>".$set['16']."</td>
          <td>".$set['17']."</td>
          <td>".$set['18']."</td>
          <td>".$set['19']."</td>
          <td>".$set['20']."</td>
          <td>".$set['21']."</td>
          <td>".$set['22']."</td>
          <td>".$set['23']."</td>
          <td>".$set['24']."</td>
          <td>".$set['25']."</td>
          <td>".$set['26']."</td>
          <td>".$set['27']."</td>
          <td>".$set['28']."</td>
          <td>".$set['29']."</td>
          <td>".$set['30']."</td>
          <td>".$set['31']."</td>
        </tr>";
        $tbody .= $tr;
      }
    }

    $nama_alat = $filter['nama_alat'];
    $no_seri = $filter['no_seri'];
    $month = $filter['month'];
    $year = $filter['year'];
    $template  ="
    <html>
    <head>
    <style>
      body {
        margin: 0; 
        padding: 0;
        width: 100%; 
        overflow-x: hidden;
        font-size: 1rem;
      }

      table {
        border-collapse: collapse;
      }

      th {
          border: 1px solid black;
          height: 2rem;
          font-size: large;
          font-weight: 500;
          padding: .2rem .8rem;
      }

      td {
          border: 1px solid black;
          height: 2rem;
          font-weight: 400;
          padding: .2rem .8rem;
      }
    </style>
    </head>
      <body>
          <header>
              <div style='font-size: xx-large; font-weight: bold; margin-bottom: .4rem;'>
                  CV. Sinar Baja Electric
              </div>
              <div style='font-size: x-large; font-weight: bold; margin-bottom: .5rem;'>
                  Verification Job Setup & Daily Maintenance alat ukur / alat test
              </div>
          </header>

          <div id='reference' style='margin: 2.5rem 0 1rem 0;'>
              <div>
                  <strong>Form No</strong> : SBE-1010/C-01
              </div>
              <div>
                  <strong>Rev</strong> : 0
              </div>
              <div>
                  <strong>Date</strong> : 20.05.2019
              </div>
          </div>

          <main style='height: 80vh;'>
              <div id='separator' style='width: 99%; height: .1rem; background-color: black;'></div>

              <div id='detail' style='margin: 1rem 0 0 0;'>
                <div style='margin: 0 0 .5rem 0; font-size: large;'>
                  Nama Alat = $nama_alat
                </div>
                <div style='margin: 0 0 .5rem 0; font-size: large;'>
                  No Seri = $no_seri
                </div>
              </div>

              <table style='width: 99%;'>
                  <thead>
                      <tr>
                          <th rowspan='3' style='width: 4rem; font-size: large;'>No</th>
                          <th rowspan='3' style='width: 25rem; font-size: large;'>Check Point</th>
                          <th rowspan='3' style='width: 20rem; font-size: large;'>Standard</th>
                          <th colspan='15' style='text-align: left; padding-left: .5rem;'>
                              Bulan $month
                          </th>
                          <th colspan='16' style='text-align: left; padding-left: .5rem;'>
                              Tahun $year
                          </th>
                      </tr>
                      <tr>
                          <th colspan='31' style='text-align: left; padding-left: .5rem'>Tanggal</th>
                      </tr>
                      <tr>
                          <th>1</th>
                          <th>2</th>
                          <th>3</th>
                          <th>4</th>
                          <th>5</th>
                          <th>6</th>
                          <th>7</th>
                          <th>8</th>
                          <th>9</th>
                          <th>10</th>
                          <th>11</th>
                          <th>12</th>
                          <th>13</th>
                          <th>14</th>
                          <th>15</th>
                          <th>16</th>
                          <th>17</th>
                          <th>18</th>
                          <th>19</th>
                          <th>20</th>
                          <th>21</th>
                          <th>22</th>
                          <th>23</th>
                          <th>24</th>
                          <th>25</th>
                          <th>26</th>
                          <th>27</th>
                          <th>28</th>
                          <th>29</th>
                          <th>30</th>
                          <th>31</th>
                      </tr>
                  </thead>
                  <tbody>
                    $tbody
                  </tbody>
              </table>
          </main>
          <footer>
            <div style='width: 48.3%; margin: 0 .5rem .5rem .5rem; padding: .5rem; border: 2px solid black;border-collapse:collapse; height: 4.8rem; position: absolute; bottom: 12.3rem; left: 0; font-size: large; font-weight: bold'>
              Inspector
            </div>
            <div style='width: 48.3%; margin: 0 .5rem .5rem .5rem; padding: .5rem; border: 2px solid black;border-collapse:collapse; height: 11.5rem; position: absolute; bottom: 0; left: 0;'>
              Need Approval / Reject By: 
            </div>
            <div style='width: 48.3%; margin: 0 .5rem .5rem .5rem; padding: .5rem; border: 2px solid black;border-collapse:collapse; height: 4.8rem; position: absolute; bottom: 12.3rem; right: 0; font-size: large; font-weight: bold'>
              Supervisor
            </div>
            <div style='width: 48.3%; margin: 0 .5rem .5rem .5rem; padding: .5rem; border: 2px solid black;border-collapse:collapse; height: 11.5rem; position: absolute; bottom: 0; right: 0;'>
              <div> Need Approval / Reject By: </div>
              <div style='font-size: xx-large; font-weight: bold'>$appr</div>
            </div>
          </footer>
      </body>
      </html
    ";
    return $template;
}

/*
<style type="text/css">
    .box-text {
        border-style: solid;
        padding: 5px;
    }

    .box-comment {
        border: 2px solid #7abaff;
        border-radius: 15px;
        padding: 15px;
    }

    .widthtab {
        width: 500px;
    }

    .form-right {
        display: flex;
        justify-content: flex-end;
    }
    @media print {
      @page { margin: 0;size: landscape; sheet-size: A4;}
      /* { margin: 0 !important; padding: 0 !important; }
        #controls, .footer, .footerarea{ display: none; }
        html, body {
            /*changing width to 100% causes huge overflow and wrap
                height:100%; 
                overflow: hidden;
                background: #FFF; 
                font-size: 9.5pt;
              }
        
              .template { width: auto; left:0; top:0; }
              img { width:100%; }
              li { margin: 0 0 10px 20px !important;}
            }
        </style>
        
        
        <!-- Content Row -->
        
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="x_panel">
                        <div class="x_content" >
                          <form class="" action="process.php?action=Create" method="post" enctype="multipart/form-data">
                            <div class="row" style="padding-bottom: 0;">
                              <div class="form-group col-sm-8">
                                <h3>
                                  <center>
                                    <strong>CV. Sinar Baja Electric</strong>
                                    <br>
                                    <strong>Verification Job Setup & Daily Maintenance alat ukur / alat test</strong>
                                  </center>
                                </h3>
                              </div>
                              <div class="form-group form-right col-sm-4">
                                  <table>
                                    <tr>
                                      <th>Form No</th>
                                      <td>: SBE-1010/C-01</td>
                                    </tr>
                                    <tr>
                                      <th>Rev</th>
                                      <td>: 0</td>
                                    </tr>
                                    <tr>
                                      <th>Date</th>
                                      <td>: 20.05.2019</td>
                                    </tr>
                                  </table>
                              </div>
                            </div>
                            <hr class="sidebar-divider">
                            
                            <table width="50%" class="dataTable">
                                <tr class="col-md-6">
                                    <td>Nama alat :</td>
                                    <td>'.$nama_alat.'</td>
                                </tr>
                                <tr>    
                                    <td>No Seri :</td>
                                    <td>'.$no_seri.'</td>
                                </tr>
                                <tr>
                                    <td>User :</td>
                                    <td>'.$user.'</td>
                                </tr>
                            </table>
                            <!-- <div  class="x_content" style="overflow-x:scroll; height:500px;"> -->
                              <table class="table table-bordered dataTable table-responsive" width="100%">
                                  <tr>
                                      <td rowspan="3">No</td>
                                      <td rowspan="3">Check Point</td>
                                      <td rowspan="3">Standard</td>
                                      <td colspan="16">Bulan : '.$month.'</td>
                                      <td colspan="15">Tahun : '.$year.'</td>
                                  </tr>
                                  <tr>
                                      <td colspan="32">Tanggal</td>
                                  </tr>
                                  <tr>';
                                      for($i=1; $i<=$lastdate; $i++){
                                          $HTMLText = $HTMLText.'
                                          <td>'.$i.'</td>
                                          ';
                                      }
                                      $HTMLText = $HTMLText.'
                                  </tr>';
                                  for($i=1;$i<=$countpoint;$i++){
                                    $idpointview  = $idpointarr[$i];
                                    $check_points = $pointdatarr[$idpointview][0];
                                    $standards    = $pointdatarr[$idpointview][1];
                                    $type         = $pointdatarr[$idpointview][2];
                                    $pilihan      = $pointdatarr[$idpointview][3];
                                    $HTMLText = $HTMLText."
                                    <tr>
                                      <td>".$i."</td>
                                      <td>".$check_points."</td>
                                      <td>".$standards."</td>";
                                        for($j=1; $j<=$lastdate; $j++){
                                          $HTMLText = $HTMLText."
                                          <td class='align-middle'>
                                            ".$answerdatarr[$i][$j]."
                                          </td>
                                            ";
                                        }
                                        $HTMLText = $HTMLText."
                                    </tr>";
                                  }
        
                                  $HTMLText = $HTMLText.'
                                  <tr>
                                    <td colspan="3">Decision</td>
                                    '; 
                                      for($i=1; $i<=$lastdate; $i++){
                                        $HTMLText = $HTMLText.'
                                        <td class="align-middle">
                                          '.$answerdatarr["decision"][$i].'
                                        </td>
                                          ';
                                      }
                                      $HTMLText = $HTMLText.'
                                  </tr>
        
                                  
                              </table>
                            <!-- </div> -->
        
                            <div class="form-group">
                            <table class="table table-striped table-bordered" style="width:99%">
                              <thead class="table-primary ">
                                <tr>
                                <th>Inspector</th>
                                <th>Supervisor</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>';
                                    $disabled = "disabled";
        
                                    if( $inspector_approval == 0 ){
                                        $HTMLText = $HTMLText.'
                                        <td>
                                        Need Approval / Reject by : 
                                        <br>
                                        <center>
                                        '.$inspector.'
                                        <br>
                                        </center>
                                        </td>';
                                    } 
                                    else if ($inspector_approval == 1) {
                                        $HTMLText = $HTMLText.'
                                        <td>
                                        <center>
                                        <img src="images/icons8-checked-checkbox.png">
                                        </center>
                                        <br>
                                        Approved by : 
                                        <br>
                                        <center>
                                        '.$inspector.'
                                        </center>
                                        </td>';
                                    }
                                    else{
                                      $HTMLText = $HTMLText.'
                                        <td>
                                        <center>
                                        <img src="images/icons8-close-window.png">
                                        </center>
                                        <br>
                                        Rejected by : 
                                        <br>
                                        <center>
                                        '.$inspector.'
                                        </center>
                                        <br>
                                        </td>';
                                    }
                                    if( $supervisor_approval == 0 ){
                                        $HTMLText = $HTMLText.'
                                        <td>
                                        Need Approval / Reject by : 
                                        <br>
                                        <center>
                                        '.$supervisor.'
                                        <br>
                                        </center>
                                        </td>';
                                    } 
                                    else if ($supervisor_approval == 1) {
                                        $HTMLText = $HTMLText.'
                                        <td>
                                        <center>
                                        <img src="images/icons8-checked-checkbox.png">
                                        </center>
                                        <br>
                                        Approved by : 
                                        <br>
                                        <center>
                                        '.$supervisor.'
                                        </center>
                                        </td>';
                                    }
                                    else{
                                      $HTMLText = $HTMLText.'
                                        <td>
                                        <center>
                                        <img src="images/icons8-close-window.png">
                                        </center>
                                        <br>
                                        Rejected by : 
                                        <br>
                                        <center>
                                        '.$supervisor.'
                                        </center>
                                        <br>
                                        </td>';
                                    }
                                    $HTMLText = $HTMLText.'
                                </tr>
                              </tbody>
                            </table>
                            </div>
        
        
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
        
        <div id="code"></div>
        
        <!-- Bootstrap core JavaScript-->
        <script src="../temp_startbootstrap/vendor/jquery/jquery.min.js"></script>
        <script src="../temp_startbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../temp_startbootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="../temp_startbootstrap/js/sb-admin-2.js"></script>
        <script src="../temp_startbootstrap/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../temp_startbootstrap/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="../temp_startbootstrap/js/moment.min.js"></script>
        <script src="../temp_startbootstrap/js/tempusdominus-bootstrap-4.js"></script>
        <script src="../temp_startbootstrap/js/bootstrap4-toggle.min.js"></script>
        <script src="../temp_startbootstrap/js/bootstrap-select.min.js"></script>
        <script type="text/javascript">
        </script>';


*/
?>