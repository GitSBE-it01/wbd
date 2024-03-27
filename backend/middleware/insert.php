<?php
function insert($req) {
    // query
    $db = $req['db'];
    $table = $req['table'];
    $data = $req['data'];

    $keys = array();

    $params = '(';
    $wholeQuery = 'INSERT INTO ' . $table . "(";
    foreach($data as $key=>$value) {
        if(!in_array($key,$keys)) {
            $keys[] = $key;
            $wholeQuery .= $key . ", ";
            $params .= "?, " ;
        }
    }

    $params = rtrim($params, ", ");
    $wholeQuery = rtrim($wholeQuery, ", ") . ") VALUES " . $params . ")";
    $types = bindTypes($data);

    $result =array();    
    for($i=0; $i<count($data[$keys[0]]); $i++) {
        $bindParams = array();
        foreach($keys as $value) {
            $bindParams[] = &$data[$value][$i]; 
        }
        $result[] = executeQuery($db, $wholeQuery, $types, $bindParams);

    }
    return $result;
}