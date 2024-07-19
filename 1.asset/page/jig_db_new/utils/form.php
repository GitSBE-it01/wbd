<?php

$detail_form = [
    'formset'=> [
        'id'=>'detail_form',
        'class'=>'flex flex-col w-full h-full pl-4',
    ],
    'form'=>[
        [
            'label'=>['for'=>'item_jig','class'=>'hidden'],
            'input'=>['id'=>'item_jig','name'=>'item_jig','class'=>'hidden']
        ],
        [
            'label'=>['for'=>'desc_jig','body'=>'Deskripsi'],
            'input'=>['id'=>'desc_jig','name'=>'desc_jig',]
        ],
        [
            'label'=>['for'=>'status_jig','body'=>'Status'],
            'input'=>['id'=>'status_jig','name'=>'status_jig',]
        ],
        [
            'label'=>['for'=>'material','body'=>'Material'],
            'input'=>['id'=>'material','name'=>'material',]
        ],
        [
            'label'=>['for'=>'type','body'=>'Tipe Jig'],
            'input'=>['id'=>'type','name'=>'type',]
        ],
        [
            'label'=>['for'=>'drawing','body'=>'Drawing'],
            'input'=>['id'=>'drawing','name'=>'drawing',]
        ],
    ]
];