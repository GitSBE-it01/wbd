<?php
/*=============================================================================
insert data
=============================================================================*/
function insertData($db, $query, $data) {
    $conn = connectToDatabase($db);
    $params = '(';
    $bind = ' (';
    $types = '';

    foreach($data[0] as $key=>$value) {
        $params .= $key . ", ";
        $bind .= "?, ";
        if (is_int($value)) {
            $types .= "i"; // Integer
        } elseif (is_float($value)) {
            $types .= "d"; // Double/Float
        } elseif (is_string($value)) {
            $types .= "s";
        }
    }
    $params = rtrim($params, ', ') . ")";
    $bind = rtrim($bind, ', ') . ")";
    $wholeQuery = $query . $params ." VALUES" . $bind;
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