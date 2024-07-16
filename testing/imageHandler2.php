<?php
if ($_FILES['file']['name']) {
    // Ensure the uploads directory exists
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        // Return the URL of the uploaded image
        echo json_encode(['url' => $targetFile]);
    } else {
        echo json_encode(['error' => 'Failed to upload image.']);
    }
} else {
    echo json_encode(['error' => 'No file uploaded.']);
}
?>