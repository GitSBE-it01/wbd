<?php
function button($btnArr) {
    $init ='<button ';
        if (isset($btnArr['data']) && count($btnArr['data'])>0) {
            foreach($btnArr['data'] as $key=>$value) {
                $data = 'data-' . $key .'="' . $value . '" ' ;
                $init .= $data;
            }
        }
    $id = '';
        if(isset($btnArr['id']) && $btnArr['id'] !=='') {$id = 'id="' . $btnArr['id'] . '" ';}
    $type = 'type="button" ';
    $disable = '';
        if(isset($btnArr['disable']) && $btnArr['disable'] !=='') {$disable = 'disabled ';}
    $class = 'class = "rounded bg-slate-100 px-4 py-1 text-sm ml-2 hover:border-b-4 hover:border-r-4 border-teal-200 text-slate-800  hover:font-bold hover:pt-[.2rem] hover:pb-0 duration-200"';
        if(isset($btnArr['style']) && $btnArr['style'] !== '') {$class = 'class="' . $btnArr['style'] . '" ' ;}
    $textCont = '>
        submit';
        if(isset($btnArr['text']) && $btnArr['text'] !=='') {$textCont = '>' . $btnArr['text'];} 
    $end = '</button>
        ';

    $finish = $init 
        .$id
        .$type
        .$disable
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
        'disable'=>''
        'style'=>''
        'text'=>'',
    ]
*/