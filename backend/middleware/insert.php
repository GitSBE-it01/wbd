<?php
require_once "../index.php";

function insert($db, $table, $data) {
    // query
    $wholeQuery = 'INSERT INTO ' . $table;
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
