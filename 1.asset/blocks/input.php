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

function input_radio($input_array) {
    $label_class = 'cursor-pointer inline-block';
    if(isset($input_array['label_style']) && $input_array['label_style']!=='' ) {
        $label_class = $input_array['label_style'];
    }
    $inp_class = 'appearance-none';
    if(isset($input_array['inp_style']) && $input_array['inp_style']!=='' ) {
        $inp_class = $input_array['inp_style'];
    }
    $option = [];
    if(isset($input_array['option']) && $input_array['option']!=='' ) {
        $option = $input_array['option'];
    }
    $inp_name = "radio_input";
    if(isset($input_array['inp_name']) && $input_array['inp_name']!=='' ) {
        $inp_name = $input_array['inp_name'];
    }
    $input_all ="";
    foreach($option as $opt) {
        $input_all .="
        <label class='".$label_class."'>".$opt."
            <input type='radio' name='".$inp_name."' class='".$inp_class."'>
        </label>";
    }
    return $input_all;
}

function logical_radio($input_array) {
    $text = "label";
        if(isset($input_array['text']) && $input_array['text'] !== '') {$text = $input_array['text'];}
    $label_class = 'cursor-pointer inline-block';
    if(isset($input_array['label_style']) && $input_array['label_style']!=='' ) {
        $label_class = $input_array['label_style'];
    }
    $inp_class = 'appearance-none';
    if(isset($input_array['inp_style']) && $input_array['inp_style']!=='' ) {
        $inp_class = $input_array['inp_style'];
    }
    $div_class = 'appearance-none';
    if(isset($input_array['div_style']) && $input_array['div_style']!=='' ) {
        $div_class = $input_array['div_style'];
    }
    $option = ['OK', 'NG', '-'];
    $inp_name = "radio_input";
    if(isset($input_array['field']) && $input_array['field']!=='' ) {
        $inp_name = $input_array['field'];
    }
    $input_all ="";
    foreach($option as $opt) {
        $input_all .="
        <label class='".$label_class."'>".$opt."
            <span class=''></span>
        </label>
        <input type='radio' name='".$inp_name."' class='".$inp_class."'>
        ";
    }

    $fix_all = "<fieldlist>
    <div data-logic='".$inp_name."' class='".$div_class."'>".$text."</div>
    <div data-result='".$inp_name."' class='".$div_class."'>".$text."</div>
    ".$input_all."
    </fieldlist>";
    return $fix_all;
}