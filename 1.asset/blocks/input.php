<?php

function input_text($input_array) {
    $id = "";
        if(isset($input_array['id']) && $input_array['id'] !=='') {$id = $input_array['id'];}

    // label
    $label = "";
    if(isset($input_array['text']) && $input_array['text'] !=='') {
        $label_class = "m-2 w-[10vw] inline-block ";
            if(isset($input_array['label_style']) && $input_array['label_style'] !== '') {$label_class = $input_array['label_style'];}
        $text = "label";
            if(isset($input_array['text']) && $input_array['text'] !== '') {$text = $input_array['text'];}
        $label = "<label for='".$id."' class='".$label_class."'>".$text."</label>
    ";
    }

    // input
    $field = "";
        if(isset($input_array['field']) && $input_array['field']) {$field = $input_array['field'];}
    $placeholder = "";
        if(isset($input_array['placeholder']) && $input_array['placeholder'] !=='') {$placeholder = "placeholder='" . $input_array['placeholder'] . "' ";} 
    $list = "";
        if(isset($input_array['list']) && $input_array['list'] !=='') {$list = 'list="' . $input_array['list'] . '" ';} 
    $value_inp = "";
        if(isset($input_array['value']) && $input_array['value'] !=='') {$value_inp = "value='" . $input_array['value'] . "' ";} 
    $disable = "";
        if(isset($input_array['disable'])) {$disable = "disabled ";}
    $inp_class = "rounded w-[30vw] bg-transparent focus:ring focus:ring-blue-200 focus:ring-width-4 focus:outline focus:outline-blue-200";
        if(isset($input_array['inp_style']) && $input_array['inp_style'] !== '') {$inp_class = $input_array['inp_style'];}
    $input = "<input type='text' id='".$id."' name='".$field."' ".$placeholder.$list.$value_inp.$disable." class='".$inp_class."'>";

    $all = $label.$input;
    return $all;
}
/*
    example 
    $input_array = [
        'data => [
            'detail' => 'main',
            'field' => 'dua',
        ],
        'id'=>'',
        'type'=>'',
        'disable'=>''
        'value'=>''
        'placeholder'=>'',
        'list'=>'',
        'inp_style'=>'',
        'label_style'=>'',
        'text'=>''
    ]
*/

function textarea($input_array) {
    $id = "";
    if(isset($input_array['id']) && $input_array['id'] !=='') {$id = $input_array['id'];}

    // label
    $label = "";
    if(isset($input_array['text']) && $input_array['text'] !=='') {
        $label_class = "m-2 w-full inline-block ";
            if(isset($input_array['label_style']) && $input_array['label_style'] !== '') {$label_class = $input_array['label_style'];}
        $text = "label";
            if(isset($input_array['text']) && $input_array['text'] !== '') {$text = $input_array['text'];}
        $label .= "<label for='".$id."' class='".$label_class."'>".$text."</label>
    ";
    }

    // input
    $field = "";
        if(isset($input_array['field']) && $input_array['field']) {$field = $input_array['field'];}
    $placeholder = "";
        if(isset($input_array['placeholder']) && $input_array['placeholder'] !=='') {$placeholder = "placeholder='" . $input_array['placeholder'] . "' ";} 
    $rows = '';
        if(isset($input_array['rows']) && $input_array['rows'] !=='') {$rows = "rows='" . $input_array['rows'] . "' ";} 
    $cols = '';
        if(isset($input_array['cols']) && $input_array['cols'] !=='') {$cols = "cols='" . $input_array['cols'] . "' ";} 
    $maxlength = '';
        if(isset($input_array['maxlength']) && $input_array['maxlength'] !=='') {$maxlength = "maxlength='" . $input_array['maxlength'] . "' ";} 
    $value_inp = "";
        if(isset($input_array['value']) && $input_array['value'] !=='') {$value_inp = "value='" . $input_array['value'] . "' ";} 
    $disable = "";
        if(isset($input_array['disable'])) {$disable = "disabled ";}
    $inp_class = "rounded w-full mx-2 bg-transparent focus:ring focus:ring-blue-200 focus:ring-width-4 focus:outline focus:outline-blue-200";
        if(isset($input_array['inp_style']) && $input_array['inp_style'] !== '') {$inp_class = $input_array['inp_style'];}
    $input = "<textarea type='text' id='".$id."' name='".$field."' ".$placeholder.$rows.$cols.$maxlength.$value_inp.$disable." class='".$inp_class."'></textarea>";

    $all = $label.$input;
    return $all;
}

/*
    example 
    $input_array = [
        'data => [
            'detail' => 'main',
            'field' => 'dua',
        ],
        'id'=>'',
        'type'=>'',
        'disable'=>''
        'value'=>''
        'placeholder'=>'',
        'list'=>'',
        'style'=>''
    ]
*/


function input_date($input_array) {
    $id = "";
        if(isset($input_array['id']) && $input_array['id'] !=='') {$id = $input_array['id'];}

    // label
    $label = "";
    if(isset($input_array['text']) && $input_array['text'] !=='') {
        $label_class = "m-2 w-[10vw] inline-block ";
            if(isset($input_array['label_style']) && $input_array['label_style'] !== '') {$label_class = $input_array['label_style'];}
        $text = "label";
            if(isset($input_array['text']) && $input_array['text'] !== '') {$text = $input_array['text'];}
        $label = "<label for='".$id."' class='".$label_class."'>".$text."</label>
    ";
    }

    // input
    $field = "";
        if(isset($input_array['field']) && $input_array['field']) {$field = $input_array['field'];}
    $placeholder = "";
        if(isset($input_array['placeholder']) && $input_array['placeholder'] !=='') {$placeholder = "placeholder='" . $input_array['placeholder'] . "' ";} 
    $value_inp = "";
        if(isset($input_array['value']) && $input_array['value'] !=='') {$value_inp = "value='" . $input_array['value'] . "' ";} 
    $disable = "";
        if(isset($input_array['disable'])) {$disable = "disabled ";}
    $inp_class = "rounded w-[30vw] bg-transparent focus:ring focus:ring-blue-200 focus:ring-width-4 focus:outline focus:outline-blue-200";
        if(isset($input_array['inp_style']) && $input_array['inp_style'] !== '') {$inp_class = $input_array['inp_style'];}
    $input = "<input type='text' id='".$id."' name='".$field."' ".$placeholder.$value_inp.$disable." class='".$inp_class."'>";
    $all = $label.$input;
    return $all;
}