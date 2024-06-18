<?php
function getArrayList($arrList, $input) {
    $preResult = true;
    foreach ($arrList as $key=>$value) {
        if ($input == $key) {
            $result = $value;
            $preResult = false;
            return $result;
            break;
        }
    }
    if ($preResult) {
        echo "theres is no such";
    }
}


function is_variable($var) {
    return is_scalar($var) || (is_object($var) && method_exists($var, '__toString'));
}




?>