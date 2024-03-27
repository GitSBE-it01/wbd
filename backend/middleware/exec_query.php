<?php
function executeFetch($db, $wholeQuery, $types, $bindParams) {
    $conn = connectToDatabase($db);
    
    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!empty($types)) {
        array_unshift($bindParams, $types);
        call_user_func_array([$stmt, 'bind_param'], $bindParams);
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

function executeQuery($db, $wholeQuery, $types, $bindParams) {
    $conn = connectToDatabase($db);
    
    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!empty($types)) {
        array_unshift($bindParams, $types);
        call_user_func_array([$stmt, 'bind_param'], $bindParams);
    }

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    } else {
        $data = 'success';
    }

    $stmt->close();
    $conn->close();
    return $data;
}

function executeFetch2($db, $wholeQuery) {
    $conn = connectToDatabase($db);
    
    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    } else {
        $data = 'success';
    }

    $stmt->close();
    $conn->close();
    return $data;
}