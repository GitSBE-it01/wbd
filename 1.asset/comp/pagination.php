<?php

function pagination_create($id, $class) {
    global $div;
    global $button;

    $div_cls = 'flex flex-row m-2 w-full items-center justify-center';
    if(isset($class['div']) && $class['div'] !== '') {
        $div_cls = $class['div'];
    }
    $btn_cls_act = 'hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 justify-center items-center duration-300 flex text-white font-bold bg-blue-700';
    if(isset($class['btn_act']) && $class['btn_act'] !== '') {
        $btn_cls_act = $class['btn_act'];
    }
    $btn_cls = 'hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 justify-center items-center duration-300 flex bg-slate-200';
    if(isset($class['btn']) && $class['btn'] !== '') {
        $btn_cls = $class['btn'];
    }

    $full = $div->create([
        'id'=>$id,
        'class'=>$div_cls,
        'body'=> [
            $button->create([
                'data_attr'=>['group::'.$id, 'page::1', 'id::1'],
                'class'=>$btn_cls_act,
                'body'=>'1'
            ]),
            $button->create([
                'data_attr'=>['group::'.$id, 'page::2', 'id::2'],
                'class'=>$btn_cls,
                'body'=>'2'
            ]),
            $button->create([
                'data_attr'=>['group::'.$id, 'page::3', 'id::3'],
                'class'=>$btn_cls,
                'body'=>'3'
            ]),
            $button->create([
                'data_attr'=>['group::'.$id, 'page::4', 'id::4'],
                'class'=>$btn_cls,
                'body'=>'4'
            ]),
            $button->create([
                'data_attr'=>['group::'.$id, 'page::5', 'id::5'],
                'class'=>$btn_cls,
                'body'=>'5'
            ]),
            $button->create([
                'data_attr'=>['group::'.$id, 'page::6', 'id::6'],
                'class'=>$btn_cls,
                'body'=>'6'
            ]),
            $button->create([
                'data_attr'=>['group::'.$id, 'page::7', 'id::7'],
                'class'=>$btn_cls,
                'body'=>'7'
            ]),
        ]
    ]);
    return $full;
}
