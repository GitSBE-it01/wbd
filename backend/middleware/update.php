<?php
require_once "../index.php";
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
    $bindParams = ($data);
    echo $wholeQuery;
    echo $types;
    echo '<pre>';
    print_r($bindParams);
    echo '</pre>';

    // $result = executeQuery($db, $wholeQuery, $types, $bindParams);
    // return $result;
    return;
}