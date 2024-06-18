<?php
/*=============================================================================
fetch data with filter
=============================================================================*/
function fetchDataFilter($db, $query, $filterValues) {
    $conn = connectToDatabase($db);
    // Build the WHERE clause based on filter values
    $whereClause = '';
    $types = '';
    $bindParams = array();
    foreach ($filterValues as $key => $value ) {
        if (is_int($value)) {
            $types .= "i"; // Integer
        } elseif (is_float($value)) {
            $types .= "d"; // Double/Float
        } elseif (is_string($value)) {
            if ($value !== 'IS NOT NULL') {
                $types .= "s";
            }
        }
        if ($value === NULL) {
            $whereClause .= "`$key` is NULL AND ";
        } elseif ($value === 'IS NOT NULL') {
            $whereClause .= "`$key` IS NOT NULL AND ";
        } else {
            $whereClause .= "`$key` = ? AND ";
            $bindParams[] = &$filterValues[$key]; // Pass the value by reference
        }
    }

    $whereClause = rtrim($whereClause, 'AND ');

    if (!empty($whereClause)) {
        $query .= " WHERE $whereClause";
    }
    $stmt = $conn->prepare($query);
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

?>