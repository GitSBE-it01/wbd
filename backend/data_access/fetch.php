<?php
function search($req) {
    $wholeQuery = 'SELECT * FROM ' . $req['table'];
    if(is_array($req['table'])) {
        $add = joinQuery($req['table']);
        $wholeQuery .= $add;
    }
    // whereClause or data : 
    if($req['filter'][0] !== '') {
        $wholeQuery .= ' WHERE ';
        foreach($req['filter'] as $value) {
            $splt = explode("=", $value);
            $wholeQuery .= $splt[0] . "="."'$splt[1]', ";
        }
        $wholeQuery = rtrim($wholeQuery, ", ");
        $bindParams = array();
        foreach ($req['filter'] as $key => $value ) {
            $bindParams[] = &$req['filter'][$key]; 
        }
        $result = executeFetch($req['db'], $wholeQuery);
        return $result;
    }
    $result = executeFetch($req['db'], $wholeQuery);
    return $result;
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