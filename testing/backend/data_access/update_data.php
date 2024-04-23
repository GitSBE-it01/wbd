<?php
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
            ${'input' . $counter} = array();
            if(is_array($values)) {
                foreach ($values as $key2 => $value) {
                    ${'input' . $counter}[] = $value;
                }
            } else {
                ${'input' . $counter}[] = $values;
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
            ${'inputFlt' . $counter2} = array();
            if(is_array($values)) {
                foreach ($values as $value) {
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

?>