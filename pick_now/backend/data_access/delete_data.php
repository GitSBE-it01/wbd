<?php
/*=============================================================================
Delete data
=============================================================================*/
function deleteData($db, $query, $filter, $filter2) {
    $conn = connectToDatabase($db);

    // Build the WHERE clause based on filter values
    $params = $filter . " = ?";

    if (is_int($filter2)) {
        $types = "i"; // Integer
    } elseif (is_float($filter2)) {
        $types = "d"; // Double/Float
    } elseif (is_string($filter2)) {
        $types = "s";
    }
    $wholeQuery = $query . " WHERE " . $params;
    echo $wholeQuery;
    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $idFIlter = $filter2;
    $bindParams = [$idFIlter];
    array_unshift($bindParams, $types);
    $refs = array();
    foreach($bindParams as $key => $value) {
        $refs[$key] = &$bindParams[$key];
    }
    call_user_func_array([$stmt, 'bind_param'], $bindParams);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    } else {
        echo "success";
    }
}
?>