<?php
header('Access-Control-Allow-Origin: *' );
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handling preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    function json_to_excel($json_data, $filename) {
        // Convert JSON data to PHP array
        $dt = json_decode($json_data, true);

        // Check if JSON decoding was successful
        if ($dt === null) {
            echo "Error: Invalid JSON data.";
            return;
        }

        // Generate Excel content
        $excel_content = '';
        foreach ($dt as $row) {
            $excel_content .= implode("\t", $row) . "\n"; // Separate columns by tabs
        }

        // Set headers for Excel file download
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename");

        // Output the Excel content
        echo $excel_content;
    }
}
?>