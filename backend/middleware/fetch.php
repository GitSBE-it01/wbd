<?php
function search($req) {
    $wholeQuery = 'SELECT * FROM ' . $req['table'];
    if(is_array($req['table'])) {
        $add = joinQuery($req['table']);
        $wholeQuery .= $add;
    }
    // whereClause or data : 
    if($req['filter'][0] !== '') {
        $whereClause = whereClause($req['filter']);
        $wholeQuery .= " WHERE" . $whereClause;
        $types = bindTypes2($req['filter']);
        $bindParams = array();
        foreach ($req['filter'] as $key => $value ) {
            $bindParams[] = &$req['filter'][$key]; 
        }
        // $result = executeFetch($req['db'], $wholeQuery, $types, $bindParams);
        $result = array('where'=>$whereClause, 'query'=>$wholeQuery);
        return $result;
    }
    // $result = executeFetch2($req['db'], $wholeQuery);
    return $req;
}

function fetch($data) {
    $split = explode("/", $data);
    $count = count($split)-1;
    $split2 = explode("?", $split[$count]);
    $database = explode(".", $split2[0]);
    $filter = explode("&", $split2[1]);
    $data = [
        'db'=> $database[0],
        'table'=> $database[1],
        'filter'=>$filter
    ];
    $result = search($data);
    return $result;
}