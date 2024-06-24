<?php

function createTxt($tableArr) {
    $init = '<div class="';
    $id = '';
    $class = 'class="p-2" ';
    $textCont = '>submit';
    $end = '
        </div>
    ';

    if (count($tableArr['data'])>0) {
        foreach($tableArr['data'] as $key=>$value) {
            $data = 'data-' . $key .'="' . $value . '" ' ;
            $init .= $data;
        }
    }
    if($tableArr['id'] !=='') {$id = 'id="' . $tableArr['id'] . '" ';}
    if($tableArr['style'] !== '') {$class = 'class="' . $tableArr['style'] . '" ' ;}
    if($tableArr['text'] !=='') {
        $textCont = '>
            ' . $tableArr['text'];
    }

    $finish = $init 
        .$id
        .$class 
        .$textCont 
        .$end;
    return $finish;
}

/*
$dtlistArr = [
        'target'=> `body`, 
        'ID' => '',
        'src' =>src,
        "style"=> {
            dtlist: 'w-[50%] h-[90%] ml-4 pl-4 top-[1vh] rounded scrollable absolute bg-slate-400 z-40 hidden right-8 whitespace-pre-line',
            separator: 'w-[50%] h-[.2vh] bg-blue-200 flex items-center my-2'
        },
        'field' => ['no seri = sn_id', 'kategori alat = new_subcat', 'asset = no_asset', 'deskripsi alat = _desc']
    ]
*/