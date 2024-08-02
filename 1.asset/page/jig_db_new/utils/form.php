<?php

$detail_form = [
    'formset'=> [
        'id'=>'detail_form',
        'class'=>'flex flex-col gap-4 w-full h-full pl-4',
    ],
    'form'=>[
        [
            'type'=>'text',
            'label'=>['for'=>'item_jig','class'=>'hidden'],
            'input'=>['id'=>'item_jig','name'=>'item_jig','class'=>'hidden']
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'desc_jig','body'=>'Deskripsi'],
            'input'=>[
                'id'=>'desc_jig',
                'name'=>'desc_jig',
                'disable'=>'',
                'class'=> 'rounded text-white bg-slate-600 px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'status_jig','body'=>'Status'],
            'input'=>['id'=>'status_jig','name'=>'status_jig',
                'disable'=>'',
                'class'=> 'rounded text-white bg-slate-600 px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'material','body'=>'Material'],
            'input'=>['id'=>'material','name'=>'material',
                'disable'=>'',
                'class'=> 'rounded text-white bg-slate-600 px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'type','body'=>'Tipe Jig'],
            'input'=>['id'=>'type','name'=>'type',
                'disable'=>'',
                'class'=> 'rounded text-white bg-slate-600 px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'drawing','body'=>'Drawing'],
            'input'=>['id'=>'drawing','name'=>'drawing',
                'disable'=>'',
                'class'=> 'rounded text-white bg-slate-600 px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
    ]
];