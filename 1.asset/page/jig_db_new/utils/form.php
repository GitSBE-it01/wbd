<?php

$detail_form = [
    'formset'=> [
        'id'=>'detail_form',
        'class'=>'flex flex-col gap-4 w-full h-full pl-4',
    ],
    'form'=>[
        [
            'type'=>'hidden',
            'input'=>['id'=>'trans_date','name'=>'trans_date', 'type_attr'=>'hidden'
            ]
        ],
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

$add_jig_form = [
    'formset'=> [
        'id'=>'add_jig_form',
        'class'=>'flex flex-col gap-4 w-full pl-4',
    ],
    'form'=>[
        [
            'type'=>'hidden',
            'input'=>['id'=>'trans_date','name'=>'trans_date', 'type_attr'=>'hidden'
            ]
        ],
        [
            'type'=>'hidden',
            'input'=>['id'=>'remark','name'=>'remark', 'type_attr'=>'hidden', 'value'=>'data awal'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'item_jig', 'body'=>'Item Number Jig'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'item_jig',
                'name'=>'item_jig',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'desc_jig','body'=>'Deskripsi'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'desc_jig',
                'name'=>'desc_jig',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'status_jig','body'=>'Status'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'status_jig','name'=>'status_jig',
                'disable'=>'',
                'value'=>'active',
                'class'=> 'rounded text-white px-2 h-full bg-slate-700 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'material','body'=>'Material'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'material','name'=>'material',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'type','body'=>'Tipe Jig'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'type','name'=>'type',
                'list'=>'jig_type_list',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'drawing','body'=>'Drawing'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'drawing','name'=>'drawing',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
    ]
];

$add_jig_loc_form = [
    'formset'=> [
        'id'=>'add_jig_loc_form',
        'class'=>'flex flex-col gap-4 w-full pl-4 mb-4',
    ],
    'form'=>[
        [
            'type'=>'text',
            'label'=>['for'=>'qty_total', 'body'=>'Qty Total'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'qty_total',
                'disable'=>'',
                'class'=> 'rounded text-white px-2 h-full bg-slate-700 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'tol','body'=>'Toleransi'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'tol',
                'name'=>'toleransi',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
    
    ]
];

$add_speaker_jig_form = [
    'formset'=> [
        'id'=>'add_speaker_jig_form',
        'class'=>'flex flex-col gap-4 w-full pl-4 mb-4',
    ],
    'form'=>[
        [
            'type'=>'text',
            'label'=>['for'=>'item_type','body'=>'Item Number Speaker'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'item_type',
                'name'=>'item_type',
                'list'=>'type_list',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
    
    ]
];

$add_location_form = [
    'formset'=> [
        'id'=>'add_location_form',
        'class'=>'flex flex-col gap-4 w-full pl-4 mb-4',
    ],
    'form'=>[
        [
            'type'=>'text',
            'label'=>['for'=>'item_type','body'=>'Location Name'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'item_type',
                'name'=>'name',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
    
    ]
];

$add_jig_type_form = [
    'formset'=> [
        'id'=>'add_jig_type_form',
        'class'=>'flex flex-col gap-4 w-full pl-4 mb-4',
    ],
    'form'=>[
        [
            'type'=>'text',
            'label'=>['for'=>'type_jig','body'=>'Jig Type'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'type_jig',
                'name'=>'type_jig',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'std_lftm','body'=>'Standard Lifetime'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'std_lftm',
                'name'=>'mtnc_std_lifetime',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'lftm_unit','body'=>'Unit of Measurement'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'lftm_unit',
                'name'=>'lftm_unit',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'mtnc_by','body'=>'Maintenance By'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'mtnc_by',
                'name'=>'mtnc_by',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
    ]
];

$user_role = [
    'formset'=> [
        'id'=>'user_role',
        'class'=>'flex flex-col gap-4 w-full pl-4 mb-4',
    ],
    'form'=>[
        [
            'type'=>'text',
            'label'=>['for'=>'absen','body'=>'No Absen'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'absen',
                'name'=>'absen',
                'list'=>'users',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'abs_name','body'=>'Nama User'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'abs_name',
                'name'=>'abs_name',
                'disable'=>'',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
        [
            'type'=>'text',
            'label'=>['for'=>'role','body'=>'Role'],
            'input'=>[
                'autocomplete'=>'off',
                'id'=>'role',
                'name'=>'role',
                'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]'
            ]
        ],
    ]
];