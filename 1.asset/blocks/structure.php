<?php

function frame($strArr) {
    $init ='<'.$strArr['el'] . ' ';
        if (isset($strArr['data']) && count($strArr['data'])>0) {
            foreach($strArr['data'] as $key=>$value) {
                $data = 'data-' . $key .'="' . $value . '" ' ;
                $init .= $data;
            }
        }
    $id = '';
        if(isset($strArr['id']) && $strArr['id'] !=='') {$id = 'id="' . $strArr['id'] . '" ';}
    $class = 'class="h-full w-full" ';
        if(isset($strArr['style']) && $strArr['style'] !== '') {$class = 'class="' . $strArr['style'] . '" ';}
    $isi = '>
        ' .$strArr['isi'];
    $end = '
            </' .$strArr['el'] .'>
        ';

    $finish = $init 
        .$id
        .$class 
        .$isi
        .$end;
    return $finish;
}

/*
    example 
    $strArr = [
        'el'=>'',
        'data => [
            'detail' => 'main',
            'field' => 'dua',
        ],
        'id'=>'',
        'style'=>'',
        'isi'=>''
    ]
*/
