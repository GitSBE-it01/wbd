<?php
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
    return $data;
}

?>