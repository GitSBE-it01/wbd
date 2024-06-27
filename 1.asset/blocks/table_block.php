<?php
function td_input($set) {
    $field = "data-field='".$set['field']."' ";
    $class = 'class="w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4" ';
        if(isset($set['inp_style']) && $set['inp_style'] !== '') {$class = 'class="' . $set['inp_style'] . '" ';}
    $rows = "rows=1 ";
        if(isset($set['rows']) && $set['rows'] !=='') {$rows = "rows=" . $set['rows'] . " ";} 
    $cols = "cols=75 ";
        if(isset($set['cols']) && $set['cols'] !=='') {$cols = "cols=" . $set['cols'] . " ";} 
    $maxlength = "maxlength=50 ";
        if(isset($set['maxlength']) && $set['maxlength'] !=='') {$maxlength = "maxlength=" . $set['maxlength'] . " ";} 
    $value = "value=''";
        if(isset($set['value']) && $set['value'] !=='') {$value = "value='" . $set['value'] . "' ";} 
    $placeholder = '';
        if(isset($set['placeholder']) && $set['placeholder'] !=='') {$placeholder = "placeholder='" . $set['placeholder'] . "' ";} 

    $finish = "<textarea ".$field.$rows.$cols.$maxlength.$value.$placeholder.$class."></textarea>";
    return $finish;
}


