<?php
function bindTypes($data) {
    $types ='';
    $keys = array_keys($data);
    foreach ($keys as $key => $value ) {
        if (is_int($data[$value][0])) {
            $types .= "i"; // Integer
        } elseif (is_float($data[$value][0])) {
            $types .= "d"; // Double/Float
        } elseif (is_string($data[$value][0])) {
            $types .= "s";
        }
    }
    return $types;
}

function bindTypes2($data) {
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

?>