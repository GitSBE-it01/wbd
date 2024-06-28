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
            'field'=> 'check_point', 
            'header'=>'Point',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[30vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'standard',
            'header'=>'Standard',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[30vw]'
        ],
        [
            'type'=>'logic_inp',
            'field'=> 'result',
            'header'=>'Hasil',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[6vw]',
            'td_style'=>'bg-slate-300 whitespace-normal flex flex-col border-2 text-sm border-black p-2 w-[6vw]',
        ]
    ]
];


