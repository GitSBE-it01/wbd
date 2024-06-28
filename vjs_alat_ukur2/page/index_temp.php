<?php

$textArray = [['text'=>'Deskripsi Alat', 'id'=>'desc_alat'], 
        ['text'=>'Kategori', 'id'=>'cat'],
        ['text'=>"No Seri", 'id'=>'seri'],
        ['text'=>"No Asset",'id'=>'asset']
    ];

$text ='';
foreach($textArray as $set ){
    $text .= "
            ".inputText([
        'disable'=>'',
        'text'=>$set['text'],
        'id'=>$set['id'],
        'inp_style'=>'w-[60%] bg-transparent text-white text-xl font-bold ml-4',
        'label_style'=>'mx-2 mt-2 w-full w-[20vw] flex-1 text-white text-xl',
    ])."
            ";
}

$btnOpen = button([
    'id'=>'open_dtlist',
    'text'=>'',
    'style'=>'fixed z-20 right-2 top-[6vh] w-6 h-6 rounded bg-transparent open_white'
]);

$main_form_tbl = [
    'table'=> [
        'id'=> 'main_form_table', 
        'style'=>'w-full'
    ],
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'check_point', 
            'header'=>'Point',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[22vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'standard',
            'header'=>'Standard',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[50vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[50vw]'
        ],
        [
            'type'=>'set_btn',
            'field'=> '',
            'set'=>'ok ng',
            'header'=>'Option',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[6vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black p-2 w-[6vw]',
            'btn_style'=>'w-6 h-6'
        ],
        [
            'type'=>'text',
            'field'=> 'result',
            'header'=>'Result',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[22vw]'
        ],
    ]
];


$mainTable = [
    'table'=> [
        'id'=> 'table_index', 
        'style'=>'w-screen'
    ],
    'th_row_style'=>'hidden',
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'created_date', 
            'header'=>'Date',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[22vw]'
        ],
        [
            'type'=>'input',
            'field'=> 'user_input',
            'header'=>'Standard',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[50vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[50vw]'
        ],
        [
            'type'=>'input',
            'field'=> 'approval_by',
            'header'=>'Approval',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[50vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[50vw]'
        ],
        [
            'type'=>'set_btn',
            'field'=> 'data_group',
            'set'=>'open_right',
            'header'=>'Detail',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black p-2 w-[22vw]',
            'btn_style'=>'w-6 h-6'
        ]
    ]
];


