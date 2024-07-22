<?php

$detail_form = [
    'formset'=> [
        'id'=>'detail_form',
        'class'=>'flex flex-col w-full h-full',
    ],
    'form'=>[
        [
            'type'=>'text',
            'label'=>[
                'for'=>'desc_alat',
                'class'=>'inline-block mt-1 w-[25vw] text-white text-xl',
                'body'=>'Deskripsi Alat'],
            'input'=>[
                'id'=>'desc_alat',
                'name'=>'desc_alat',
                'class'=>'w-[50vw] bg-transparent text-white text-xl font-bold ml-4'
            ]
        ],
        [
            'type'=>'text',
            'label'=>[
                'for'=>'cat',
                'class'=>'inline-block mt-1 w-[25vw] text-white text-xl',
                'body'=>'Kategori'],
            'input'=>[
                'id'=>'cat',
                'name'=>'cat',
                'class'=>'w-[50vw] bg-transparent text-white text-xl font-bold ml-4'
            ]
        ],
        [
            'type'=>'text',
            'label'=>[
                'for'=>'seri',
                'class'=>'inline-block mt-1 w-[25vw] text-white text-xl',
                'body'=>'No Seri'
            ],
            'input'=>[
                'id'=>'seri',
                'name'=>'sn_id',
                'class'=>'w-[50vw] bg-transparent text-white text-xl font-bold ml-4'
            ]
        ],
        [
            'type'=>'text',
            'label'=>[
                'for'=>'asset',
                'class'=>'inline-block mt-1 w-[25vw] text-white text-xl',
                'body'=>'No Asset'
            ],
            'input'=>[
                'id'=>'asset',
                'name'=>'no_asset',
                'class'=>'w-[50vw] bg-transparent text-white text-xl font-bold ml-4'
            ]
        ],
    ]
];