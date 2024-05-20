<?php
/*=============================================================================
Delete data
=============================================================================*/
function deleteData($db, $query, $delete) {
    $conn = connectToDatabase($db);
    $wholeQuery = $query . " WHERE ";
    $types = '';
    $bindParams = array();
    foreach($delete as $key=>$value) {
        $wholeQuery .= $key . "=? AND ";
        if (is_int($value)) {
            $types .= "i"; // Integer
        } elseif (is_float($value)) {
            $types .= "d"; // Double Float
        } elseif (is_string($value)) {
            $types .= "s";
        }
        ${'param' . $key} = $value;
        $bindParams[] = &${'param' . $key};
    }
    $wholeQuery = rtrim($wholeQuery, ' AND ');
    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    set_time_limit(3600);
    array_unshift($bindParams, $types);
    call_user_func_array([$stmt, 'bind_param'], $bindParams);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    } else {
        $data = "success ";
    }
    $stmt->close();
    $conn->close();
    return $data;
}
?>