<?php
function inputText($inpTxtArr) {
    $init ='<input ';
        if (isset($inpTxtArr['data']) && count($inpTxtArr['data'])>0) {
            foreach($inpTxtArr['data'] as $key=>$value) {
                $data = 'data-' . $key .'="' . $value . '" ' ;
                $init .= $data;
            }
        }
    $id = '';
        if(isset($inpTxtArr['id']) && $inpTxtArr['id'] !=='') {$id = 'id="' . $inpTxtArr['id'] . '" ';}
    $type = 'type="text" ';
        if(isset($inpTxtArr['type']) && $inpTxtArr['type'] !=='') {$type = 'type="'.$inpTxtArr['type'] . '" ';}
    $disable = '';
        if(isset($inpTxtArr['disable']) && $inpTxtArr['disable'] !=='') {$disable = 'disabled ';}
    $value_inp = '';
        if(isset($inpTxtArr['value']) && $inpTxtArr['value'] !=='') {$value_inp = 'value="' . $inpTxtArr['value'] . '" ';} 
    $placeholder = '';
        if(isset($inpTxtArr['placeholder']) && $inpTxtArr['placeholder'] !=='') {$placeholder = 'placeholder="' . $inpTxtArr['placeholder'] . '" ';} 
    $list = '';
        if(isset($inpTxtArr['list']) && $inpTxtArr['list'] !=='') {$list = 'list="' . $inpTxtArr['list'] . '" ';} 
    $class = 'class = "rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300"';
        if(isset($inpTxtArr['style']) && $inpTxtArr['style'] !== '') {$class = 'class="' . $inpTxtArr['style'] . '" ' ;}
    $end = '>';

    $finish = $init 
        .$id
        .$type
        .$disable
        .$value_inp 
        .$placeholder 
        .$list 
        .$class 
        .$end;
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
    $init ='<textarea ';
        if (isset($inpTxtArr['data']) && count($inpTxtArr['data'])>0) {
            foreach($inpTxtArr['data'] as $key=>$value) {
                $data = 'data-' . $key .'="' . $value . '" ' ;
                $init .= $data;
            }
        }
    $id = '';
        if(isset($inpTxtArr['id']) && $inpTxtArr['id'] !=='') {$id = 'id="' . $inpTxtArr['id'] . '" ';}
    $type = 'type="text" ';
        if(isset($inpTxtArr['type']) && $inpTxtArr['type'] !=='') {$type = 'type="'.$inpTxtArr['type'] . '" ';}
    $disable = '';
        if(isset($inpTxtArr['disable']) && $inpTxtArr['disable'] !=='') {$disable = 'disabled ';}
    $value_inp = '';
        if(isset($inpTxtArr['value']) && $inpTxtArr['value'] !=='') {$value_inp = 'value="' . $inpTxtArr['value'] . '" ';} 
    $placeholder = '';
        if(isset($inpTxtArr['placeholder']) && $inpTxtArr['placeholder'] !=='') {$placeholder = 'placeholder="' . $inpTxtArr['placeholder'] . '" ';} 
    $class = 'class = "rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300"';
        if(isset($inpTxtArr['style']) && $inpTxtArr['style'] !== '') {$class = 'class="' . $inpTxtArr['style'] . '" ' ;}
    $end = '>
            </textarea>
        ';

    $finish = $init 
        .$id
        .$type
        .$disable
        .$value_inp 
        .$placeholder 
        .$class 
        .$end;
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