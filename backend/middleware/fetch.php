<?php
require_once "../index.php";

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
        $bindParams = array();
        foreach ($req['filter'] as $key => $value ) {
            $bindParams[] = &$req['filter'][$key]; 
        }
    }
    $result = executeQuery($req['db'], $wholeQuery, $types, $bindParams);
    return $result;
}