<?php
function inputText($inpTxtArr) {
    $init ="<input ";
        if (isset($inpTxtArr['data']) && count($inpTxtArr['data'])>0) {
            foreach($inpTxtArr['data'] as $key=>$value) {
                $data = "data-" . $key ."='" . $value . "' " ;
                $init .= $data;
            }
        }
    $id = "";
        if(isset($inpTxtArr['id']) && $inpTxtArr['id'] !=='') {$id = "id='" . $inpTxtArr['id'] . "' ";}
    $type = "type='text' ";
    $disable = "";
        if(isset($inpTxtArr['disable'])) {$disable = "disabled ";}
    $value_inp = "";
        if(isset($inpTxtArr['value']) && $inpTxtArr['value'] !=='') {$value_inp = "value='" . $inpTxtArr['value'] . "' ";} 
    $placeholder = "";
        if(isset($inpTxtArr['placeholder']) && $inpTxtArr['placeholder'] !=='') {$placeholder = "placeholder='" . $inpTxtArr['placeholder'] . "' ";} 
    $list = "";
        if(isset($inpTxtArr['list']) && $inpTxtArr['list'] !=='') {$list = 'list="' . $inpTxtArr['list'] . '" ';} 
    $class = "class='rounded ml-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300' ";
        if(isset($inpTxtArr['inp_style']) && $inpTxtArr['inp_style'] !== '') {$class = "class='" . $inpTxtArr['inp_style'] . "' " ;}
        
    $label_class = "class='rounded m-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300' ";
        if(isset($inpTxtArr['label_style']) && $inpTxtArr['label_style'] !== '') {$label_class = "class='" . $inpTxtArr['label_style'] . "' " ;}
    $text = "label";
        if(isset($inpTxtArr['text']) && $inpTxtArr['text'] !== '') {$text = $inpTxtArr['text'];}

    $finish = "<label ".$label_class.">".$text."
                ".$init.$id.$type.$disable.$value_inp .$placeholder .$list .$class.">
            </label>";
    return $finish;
}
/*
    example 
    $inpTxtArr = [
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

function textarea($inpTxtArr) {
    $init ="<textarea ";
    if (isset($inpTxtArr['data']) && count($inpTxtArr['data'])>0) {
        foreach($inpTxtArr['data'] as $key=>$value) {
            $data = "data-" . $key ."='" . $value . "' " ;
            $init .= $data;
        }
    }
    $id = "";
        if(isset($inpTxtArr['id']) && $inpTxtArr['id'] !=='') {$id = "id='" . $inpTxtArr['id'] . "' ";}
    $disable = '';
        if(isset($inpTxtArr['disable'])) {$disable = "disabled ";}
    $value_inp = '';
        if(isset($inpTxtArr['value']) && $inpTxtArr['value'] !=='') {$value_inp = "value='" . $inpTxtArr['value'] . "' ";} 
    $placeholder = '';
        if(isset($inpTxtArr['placeholder']) && $inpTxtArr['placeholder'] !=='') {$placeholder = "placeholder='" . $inpTxtArr['placeholder'] . "' ";} 
    $rows = '';
        if(isset($inpTxtArr['rows']) && $inpTxtArr['rows'] !=='') {$rows = "rows='" . $inpTxtArr['rows'] . "' ";} 
    $cols = '';
        if(isset($inpTxtArr['cols']) && $inpTxtArr['cols'] !=='') {$cols = "cols='" . $inpTxtArr['cols'] . "' ";} 
    $maxlength = '';
        if(isset($inpTxtArr['maxlength']) && $inpTxtArr['maxlength'] !=='') {$maxlength = "maxlength='" . $inpTxtArr['maxlength'] . "' ";} 
    $class = "class='rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300' ";
        if(isset($inpTxtArr['style']) && $inpTxtArr['style'] !== '') {$class = "class='" . $inpTxtArr['style'] . "' " ;}

    $label_class = "class='rounded m-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300' ";
        if(isset($inpTxtArr['label_style']) && $inpTxtArr['label_style'] !== '') {$label_class = "class='" . $inpTxtArr['label_style'] . "' " ;}
    $text = "label";
        if(isset($inpTxtArr['text']) && $inpTxtArr['text'] !== '') {$text = $inpTxtArr['text'];}

    $finish =  "<label ".$label_class.">".$text."
                ".$init.$id.$rows.$cols.$maxlength.$value_inp.$placeholder.$class.$disable."></textarea>
            </label>";

    return $finish;
}

/*
    example 
    $inpTxtArr = [
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