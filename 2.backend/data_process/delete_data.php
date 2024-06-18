<?php
/*=============================================================================
Delete data
=============================================================================*/
function deleteData($db, $query, $data) {
    $conn = connectToDatabase($db);
    $wholeQuery = $query . " WHERE ";
    $types = '';
    $bindParams = array();
    foreach($data[0] as $key=>$value) {
        $wholeQuery .= $key . "=? AND ";
        if (is_int($value)) {
            $types .= "i"; // Integer
        } elseif (is_float($value)) {
            $types .= "d"; // Double Float
        } elseif (is_string($value)) {
            $types .= "s";
        }
    }
    $wholeQuery = rtrim($wholeQuery, ' AND ');
    $result = $wholeQuery;
    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    set_time_limit(3600);
    foreach($data as $set) {
        $bindParams = array();
        foreach($set as $key=>$value) {
            ${'param' . $key} = $value;
            $bindParams[] = &${'param' . $key};
        }
        array_unshift($bindParams, $types);
        call_user_func_array([$stmt, 'bind_param'], $bindParams);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        } else {
            $result = "success ";
        }
    }
    $stmt->close();
    $conn->close();
    return $result;
}
?>