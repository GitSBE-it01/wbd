<?php
/*=============================================================================
get all data
=============================================================================*/
function getData($db, $query) {
    $conn = connectToDatabase($db);
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $result = $stmt->get_result();
    $data = array(); 
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }
    $result->free();
    $stmt->close();
    $conn->close();
    return $data;
}

?>