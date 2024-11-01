<?php
require_once 'lib/mpdf/mpdf.php';
require_once 'pdf_template/index.php';
// mPDF($mode='',$format='A4',$default_font_size=0,$default_font='',$mgl=15,$mgr=15,$mgt=16,$mgb=16,$mgh=9,$mgf=9, $orientation='P') 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the POST request (if needed)
    $data = json_decode(file_get_contents('php://input'), true);
    $filter_data = $data['Data'];
    $reff = explode("/",$_SERVER['HTTP_REFERER']);
    $html = pdf_template($filter_data, $reff[4]);
    $orient = $_SERVER['HTTP_ORIENTATION']==='p' ? 'A4' : 'A4-L';
    $left = isset($_SERVER['HTTP_MARGIN_LEFT']) ? $_SERVER['HTTP_MARGIN_LEFT'] : 5;
    $right = isset($_SERVER['HTTP_MARGIN_RIGHT']) ? $_SERVER['HTTP_MARGIN_RIGHT'] : 5;
    $top = isset($_SERVER['HTTP_MARGIN_TOP']) ? $_SERVER['HTTP_MARGIN_TOP'] : 5;
    $btm = isset($_SERVER['HTTP_MARGIN_BTM']) ? $_SERVER['HTTP_MARGIN_BTM'] : 5;
    $hd = isset($_SERVER['HTTP_MARGIN_HD']) ? $_SERVER['HTTP_MARGIN_HD'] : 5;
    $ft = isset($_SERVER['HTTP_MARGIN_FT']) ? $_SERVER['HTTP_MARGIN_FT'] : 5;
    $mpdf = new mPDF('utf-8', $format=$orient, $mgl=$left, $mgr=$right, $mgt=$top,$mgb=$btm, $mgh=$hd, $mgf=$ft);
    $mpdf->charset_in = 'iso-8859-4';
    $mpdf->WriteHTML($html);
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="document.pdf"');
    $mpdf->Output();
    return;
}

?>