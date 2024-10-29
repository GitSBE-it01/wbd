<?php
require_once '../1.asset/external_library/mpdf/mpdf.php';
require_once 'pdf_template/index.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the POST request (if needed)
    $data = json_decode(file_get_contents('php://input'), true);
    $filter_data = $data['Data'];
    $reff = explode("/",$_SERVER['HTTP_REFERER']);
    $html = pdf_template($filter_data, $reff[4]);
    $mpdf = new mPDF();
    $mpdf->WriteHTML($html);
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="document.pdf"');
    $mpdf->Output();
}

?>