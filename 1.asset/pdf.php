<?php
include_once 'external_library/mpdf/mpdf.php';

function pdf_import($body) {
    $mpdf = new mPDF();
    $mpdf->charset_in = 'iso-8859-4';
    $mpdf->WriteHTML($body);
    $mpdf->Output();
    return;
}

?>