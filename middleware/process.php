<?php
/*=============================================================================
get all data
=============================================================================*/

function joinQuery($table) {
    $add = ' JOIN ';
    $count = count($table['tbl']);
    for ($i=1; $i<$count; $i++) {
        $add .= $table['tbl'][$i] . 
        " ON " . 
        $table['tbl'][0] .  
        '.' .  
        $table['key'] . 
        " = " . 
        $table['tbl'][$i] .
        '.' .  
        $table['key'] ;
    }
    return $add;
}

function whereClause($data) {
    $whereClause = '';
    $ii=0;
    foreach ($data as $key => $value ) {
        if (count($value) === 1) {
            if ($value === NULL) {
                $whereClause .= " $key is NULL AND";
            } elseif ($value === 'IS NOT NULL') {
                $whereClause .= " $key IS NOT NULL AND";
            } else {
                $whereClause .= " $key = ? AND";
            }
            $ii++;
        } else {      
            for ($i=0; $i<count($value); $i++) {
                if ($i === 0) {
                    $whereClause .= " $key BETWEEN ? AND";
                    $bindParams[$ii] = &$data[$key][$i];
                } else {
                    $whereClause .= " ? AND";
                }
            }
            $ii++;
        }
    }
    $whereClause = rtrim($whereClause, 'AND');
    return $whereClause;
}

function bindTypes($data) {
    $types ='';
    $ii = 0;
    foreach ($data as $key => $value ) {
        if (count($value) === 1) {
            if (is_int($value)) {
                $types .= "i"; // Integer
            } elseif (is_float($value)) {
                $types .= "d"; // Double/Float
            } elseif (is_string($value)) {
                $types .= "s";
            }
            $ii++;
        } else {
            for ($i=0; $i<count($value); $i++) {
                if (is_int($value[$i])) {
                    $types .= "i"; // Integer
                } elseif (is_float($value[$i])) {
                    $types .= "d"; // Double/Float
                } elseif (is_string($value[$i])) {
                    $types .= "s";
                }
            }
            $ii++;
        }
    }
    return $types;
}

function bindParam($data) {
    $bindParams = array();
    $ii = 0;
    foreach ($data as $key => $value ) {
        if (count($value) === 1) {
            $bindParams[$ii] = &$data[$key]; // Pass the value by reference
            $ii++;
        } else {
            for ($i=0; $i<count($value); $i++) {
                if ($i===0) {
                    $bindParams[$ii] = &$data[$key][$i];
                } else {
                    $bindParams[$ii] = &$data[$key][$i];
                }
            }
            $ii++;
        }
    }
    return $bindParams;
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

function fetch($req) {
    $wholeQuery = 'SELECT * FROM ' . $req['table'];
    if(is_array($req['table'])) {
        $add = joinQuery($req['table']);
        $wholeQuery .= $add;
    }
    // whereClause or data : 
    if($req['filter']) {
        $whereClause = whereClause($req['filter']);
        $wholeQuery .= " WHERE" . $whereClause;
        $types = bindTypes($req['filter']);
        $bindParams = bindParam($req['filter']);
    }

    $result = executeQuery($req['db'], $wholeQuery, $types, $bindParams);
    return $result;
}

function insert($db, $table, $data) {
    // query
    $wholeQuery = 'INSERT INTO ' . $table;
    // whereClause or data : 
    $whereClause = whereClause($data);
    $wholeQuery .= " WHERE" . $whereClause;

    $types = bindTypes($data);
    $bindParams = bindParam($data);
    echo $wholeQuery;
    echo $types;
    echo '<pre>';
    print_r($bindParams);
    echo '</pre>';

    // $result = executeQuery($db, $wholeQuery, $types, $bindParams);
    // return $result;
    return;
}

function update($db, $table, $data) {
    // query
    $wholeQuery =  'UPDATE ' . $table . ' SET ';
    if(is_array($table)) {
        $add = joinQuery($table);
        $wholeQuery .= $add;
    }
    // whereClause or data : 
    $whereClause = whereClause($data);
    $wholeQuery .= " WHERE" . $whereClause;

    $types = bindTypes($data);
    $bindParams = bindParam($data);
    echo $wholeQuery;
    echo $types;
    echo '<pre>';
    print_r($bindParams);
    echo '</pre>';

    // $result = executeQuery($db, $wholeQuery, $types, $bindParams);
    // return $result;
    return;
}

function delete($db, $table, $data) {
    // query
    $wholeQuery =  'DELETE FROM ' . $table . ' SET ';
    if(is_array($table)) {
        $add = joinQuery($table);
        $wholeQuery .= $add;
    }
    // whereClause or data : 
    $whereClause = whereClause($data);
    $wholeQuery .= " WHERE" . $whereClause;

    $types = bindTypes($data);
    $bindParams = bindParam($data);
    echo $wholeQuery;
    echo $types;
    echo '<pre>';
    print_r($bindParams);
    echo '</pre>';

    // $result = executeQuery($db, $wholeQuery, $types, $bindParams);
    // return $result;
    return;
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