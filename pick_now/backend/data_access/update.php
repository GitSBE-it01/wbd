<?php
function update($req) {
    // query
    $db = $req['db'];
    $table = $req['table'];
    $data = $req['data'];
    $filter = $req['filter'];
    $wholeQuery =  'UPDATE ' . $table . ' SET ';
    $keys = array();
    foreach($data as $key=>$value) {
        if(!in_array($key,$keys)) {
            $keys[] = $key;
            $wholeQuery .= $key . "=? ,";
        }
    }
    $keys2 = array();
    $whereClause = '';
    foreach($filter as $key=>$value) {
        if(!in_array($key,$keys2)) {
            $keys2[] = $key;
            $whereClause .= $key . "=? ,";
        }
    }

    $whereClause = rtrim($whereClause, ", ");
    $wholeQuery = rtrim($wholeQuery, ", ") . " WHERE " . $whereClause;
    $types = bindTypes($data);
    $types .= bindTypes($filter);
    $result =array();    
    
    for($i=0; $i<count($data[$keys[0]]); $i++) {
        $bindParams = array();
        foreach($keys as $value) {
            $bindParams[] = &$data[$value][$i]; 
        }
        foreach($keys2 as $value) {
            $bindParams[] = &$filter[$value][$i]; 
        }


        $result[] = executeQuery($db, $wholeQuery, $types, $bindParams);
    }
    return $result;
}