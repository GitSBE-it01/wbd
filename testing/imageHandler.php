<?php
// Check if the file was uploaded without errors
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload'])) {
    $file = $_FILES['upload'];

    // Check for errors during file upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'image/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $destination = $uploadDir . $file['name'];

        if (file_exists($destination)) {
            $filename = pathinfo($file['name'], PATHINFO_FILENAME); 
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION); 
            $counter = 1;
        
            while (file_exists($uploadDir . $filename . "($counter)." . $extension)) {
                $counter++;
            }
        
            $destination = $uploadDir . $filename . "($counter)." . $extension;
        }
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            echo json_encode(['url' => $destination]); 
        } else {
            echo json_encode(['error' => 'Failed to move the uploaded file']);
        }
    } else {
        echo json_encode(['error' => 'Error during file upload']);
    }
} else {
    echo json_encode(['error' => 'No file uploaded or invalid request method']);
}
?>
