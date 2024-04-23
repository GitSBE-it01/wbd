<?php
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
            if(is_array($values)) {
                foreach ($values as $key2 => $value) {
                    ${'input' . $counter}[] = $value;
                }
            } else {
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

?>