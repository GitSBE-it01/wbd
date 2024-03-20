<?php
/*==================================================================================================================
global
==================================================================================================================*/
/*------------------------------------------------------
cek user
------------------------------------------------------*/
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

/*=============================================================================
insert data
=============================================================================*/
function insertData($db, $query, $filterValues) {
    $conn = connectToDatabase($db);
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
    $stmt->close();
    $conn->close();
}

/*=============================================================================
update data
=============================================================================*/
function updateData($db, $query, $filterValues, $filterValues2) {
    $conn = connectToDatabase($db);
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
        foreach (array_values($filterValues2[$i]) as $values) {
            // Create variable names like $input1, $input2, etc.
            ${'inputFlt' . $counter2} = array();
            if(is_array($values)) {
                foreach ($values as $value) {
                    // Extract 'value' from subarray and add to the variable
                    ${'inputFlt' . $counter2}[] = $value;
                }
            } else {
                ${'inputFlt' . $counter2}[] = $values;
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
    
            for ($iii=0; $iii<$counter2; $iii++){
                $total = $ii +$iii;
                ${'keyBind_' . $total} = &${'inputFlt' . $iii}[$i];
                $bindParams[] = &${'keyBind_' . $total};
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
    $stmt->close();
    $conn->close();
}

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

function cekUser($db, $user_log, $prog) {
    $conn = connectToDatabase($db);
    $query = "SELECT user, role FROM access_config.access_wbd WHERE user = '$user_log' AND prog= '$prog'";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        $userRole = $result->fetch_assoc();
        return $userRole["role"];
    } else {
        return null;
    }
}
?>