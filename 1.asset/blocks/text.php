<?php

function text($txtArr) {
    $init ="<div ";
        if (isset($txtArr['data']) && count($txtArr['data'])>0) {
            foreach($txtArr['data'] as $key=>$value) {
                $data = 'data-' . $key .'="' . $value . '" ' ;
                $init .= $data;
            }
        }
    $id = '';
        if(isset($txtArr['id']) && $txtArr['id'] !=='') {$id = 'id="' . $txtArr['id'] . '" ';}
    $class = 'class="p-2" ';
        if(isset($txtArr['style']) && $txtArr['style'] !== '') {$class = 'class="' . $txtArr['style'] . '" ' ;}
    $textCont = '>submit';
        if(isset($txtArr['text']) && $txtArr['text'] !=='') {
            $textCont = '>
                ' . $txtArr['text'];
        }
    $end = '
        </div>
    ';

    $finish = $init 
        .$id
        .$class 
        .$textCont 
        .$end;
    return $finish;
}

/*
    example 
    $btnArr = [
        'data => [
            'detail' => 'main',
            'field' => 'dua',
        ],
        'id'=>'',
        'style'=>''
        'text'=>'',
    ]
*/