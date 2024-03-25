<?php
require_once "../index.php";

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