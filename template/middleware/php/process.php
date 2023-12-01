<?php
/*==================================================================================================================
global
==================================================================================================================*/
/*------------------------------------------------------
cek user
------------------------------------------------------*/
function cekUser($user_log, $prog) {
    $conn = connectToDatabase();
    $query = "SELECT user, role FROM access_config.access_wbd WHERE user = '$user_log' AND prog= '$prog'";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        $userRole = $result->fetch_assoc();
        return $userRole["role"];
    } else {
        return null; // User not found or error occurred
    }
}

function getArrayList($arrList, $input) {
    $preResult = true;
    foreach ($arrList as $key=>$value) {
        if ($input == $key) {
            $result = $value;
            $preResult = false;
            return $result;
            break;
        }
    }
    if ($preResult) {
        echo "theres is no such";
    }
}


function is_variable($var) {
    return is_scalar($var) || (is_object($var) && method_exists($var, '__toString'));
}

/*=============================================================================
get all data
=============================================================================*/
function getData($query) {
    $conn = connectToDatabase();
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

/*=============================================================================
fetch data with filter
=============================================================================*/
function fetchDataFilter($query, $filterValues) {
    $conn = connectToDatabase();
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

/*=============================================================================
insert data
=============================================================================*/
function insertData($query, $filterValues) {
    $conn = connectToDatabase();
    $counter = 0;   
    $count = count($filterValues);
    $keysParam = array();

    // making array for each data
    for ($i=0; $i<$count; $i++){
        $cek = array_keys($filterValues[$i]);
        $test = array_values($cek);
        ${'inputKeys' . $counter} = $test[0];
        $keysParam[$test[0]] = array();
        foreach (array_values($filterValues[$i]) as $key => $values) {
            // Create variable names like $input1, $input2, etc.
            ${'input' . $counter} = array();
            foreach ($values as $key2 => $value) {
                // Extract 'value' from subarray and add to the variable
                ${'input' . $counter}[] = $value;
            }
            $counter++;
        }
    }

    // Build the WHERE clause based on filter values
    $params = '(';
    $bind = ' (';
    $types = '';
    for ($i=0; $i<$counter; $i++){
        $params .=  ${'inputKeys' . $i} . ", ";
        $bind .= "?, ";
        if (is_int(${'input' . $i}[0])) {
            $types .= "i"; // Integer
        } elseif (is_float(${'input' . $i}[0])) {
            $types .= "d"; // Double/Float
        } elseif (is_string(${'input' . $i}[0])) {
            $types .= "s";
        }
    }
    $params = rtrim($params, ', ');
    $bind = rtrim($bind, ', ');
    $params .= ")";
    $bind .= ")";
    $wholeQuery = $query . $params ." VALUES" . $bind;

    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!empty($types)) {
        for ($i=0; $i<count($input0); $i++){
            $bindParams = array();
            for ($ii=0; $ii<$counter; $ii++){
                ${'keyBind_' . $ii} = &${'input' . $ii}[$i];
                $bindParams[] = &${'keyBind_' . $ii};
            }
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            } else {
                echo "success";
            }
        }
    }
}

/*=============================================================================
update data
=============================================================================*/
function updateData($query, $filterValues, $filterValues2) {
    $conn = connectToDatabase();
    $counter = 0;   
    $count = count($filterValues);
    $keysParam = array();
    $count2 = count($filterValues2);

    // making array for each data
    for ($i=0; $i<$count; $i++){
        $cek = array_keys($filterValues[$i]);
        $test = array_values($cek);
        ${'inputKeys' . $counter} = $test[0];
        $keysParam[$test[0]] = array();
        foreach (array_values($filterValues[$i]) as $key => $values) {
            // Create variable names like $input1, $input2, etc.
            ${'input' . $counter} = array();
            foreach ($values as $key2 => $value) {
                // Extract 'value' from subarray and add to the variable
                ${'input' . $counter}[] = $value;
            }
            $counter++;
        }
    }

    $counter2 = 0;   
    for ($i=0; $i<$count2; $i++){
        $cek = array_keys($filterValues2[$i]);
        $test = array_values($cek);
        ${'inputKeysFlt' . $counter2} = $test[0];
        $keysParam2[$test[0]] = array();
        foreach (array_values($filterValues2[$i]) as $key => $values) {
            // Create variable names like $input1, $input2, etc.
            ${'inputFlt' . $counter2} = array();
            foreach ($values as $key2 => $value) {
                // Extract 'value' from subarray and add to the variable
                ${'inputFlt' . $counter2}[] = $value;
            }
            $counter2++;
        }
    }
    
    // Build the WHERE clause based on filter values
    $types = '';
    $params = '';
    for ($i=0; $i<$count; $i++){
        $params .=  ${'inputKeys' . $i} . " = ?, ";
        if (is_int(${'input' . $i}[0])) {
            $types .= "i"; // Integer
        } elseif (is_float(${'input' . $i}[0])) {
            $types .= "d"; // Double/Float
        } elseif (is_string(${'input' . $i}[0])) {
            $types .= "s";
        }
    }

    $filter = '';
    for ($i=0; $i<$count2; $i++){
        $filter .=  ${'inputKeysFlt' . $i} . "=?, ";
        if (is_int(${'inputFlt' . $i}[0])) {
            $types .= "i"; // Integer
        } elseif (is_float(${'inputFlt' . $i}[0])) {
            $types .= "d"; // Double/Float
        } elseif (is_string(${'inputFlt' . $i}[0])) {
            $types .= "s";
        }
    }

    $params = rtrim($params, ', ');
    $filter = rtrim($filter, ', ');
    $wholeQuery = $query ." SET " . $params . " WHERE " . $filter;

    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!empty($types)) {
        for ($i=0; $i<count($input0); $i++){
            $bindParams = array();
            for ($ii=0; $ii<$counter; $ii++){
                ${'keyBind_' . $ii} = &${'input' . $ii}[$i];
                $bindParams[] = &${'keyBind_' . $ii};
            }
            for ($ii=0; $ii<$counter2; $ii++){
                ${'keyBind_' . $ii} = &${'inputFlt' . $ii}[$i];
                $bindParams[] = &${'keyBind_' . $ii};
            }
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            } else {
                echo "success";
            }
        }
    }
}

/*=============================================================================
delete data
=============================================================================*/
function deleteData($query, $filterValues) {
    $conn = connectToDatabase();
    $counter = 0;   
    $count = count($filterValues);
    $keysParam = array();

    // making array for each data
    for ($i=0; $i<$count; $i++){
        $cek = array_keys($filterValues[$i]);
        $test = array_values($cek);
        ${'inputKeys' . $counter} = $test[0];
        $keysParam[$test[0]] = array();
        foreach (array_values($filterValues[$i]) as $key => $values) {
            // Create variable names like $input1, $input2, etc.
            ${'input' . $counter} = array();
            foreach ($values as $key2 => $value) {
                // Extract 'value' from subarray and add to the variable
                ${'input' . $counter}[] = $value;
            }
            $counter++;
        }
    }
    
    // Build the WHERE clause based on filter values
    $types = '';
    $params = '';
    for ($i=0; $i<$count; $i++){
        $params .=  ${'inputKeys' . $i} . " = ?, ";
        if (is_int(${'input' . $i}[0])) {
            $types .= "i"; // Integer
        } elseif (is_float(${'input' . $i}[0])) {
            $types .= "d"; // Double/Float
        } elseif (is_string(${'input' . $i}[0])) {
            $types .= "s";
        }
    }

    $params = rtrim($params, ', ');
    $filter = rtrim($filter, ', ');
    $wholeQuery = $query ." WHERE " . $params;

    $stmt = $conn->prepare($wholeQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!empty($types)) {
        for ($i=0; $i<count($input0); $i++){
            $bindParams = array();
            for ($ii=0; $ii<$counter; $ii++){
                ${'keyBind_' . $ii} = &${'input' . $ii}[$i];
                $bindParams[] = &${'keyBind_' . $ii};
            }
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            } else {
                echo "success";
            }
        }
    }
}
?>