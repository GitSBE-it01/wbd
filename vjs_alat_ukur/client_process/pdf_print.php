<?php
include_once "../../1.asset/pdf.php";

pdf_import('
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                #controls, .footer, .footerarea{ display: none; }*/
            html, body {
            /*changing width to 100% causes huge overflow and wrap*/
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
        <title>Document</title>
    </head>
    <body>
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
    </body>
    </html>
');

?>
