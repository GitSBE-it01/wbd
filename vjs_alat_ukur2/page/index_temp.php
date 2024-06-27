<?php

$textArray = ['Deskripsi Alat', 'Kategori', "No Seri", "No Asset"];
$text ='';
foreach($textArray as $value ){
    $text .= "
            ".inputText([
        'disable'=>'',
        'text'=>$value,
        'inp_style'=>'w-[60%] bg-transparent text-white text-xl font-bold ml-4',
        'label_style'=>'mx-2 mt-2 w-full w-[20vw] flex-1 text-white text-xl',
    ])."
            ";
}

$btnOpen = button([
    'id'=>'open_dtlist',
    'text'=>'',
    'style'=>'fixed z-20 right-2 top-[20vh] w-6 h-6 rounded bg-transparent open_white'
]);

$mainTable = [
    'table'=> [
        'id'=> 'table_index ', 
        'style'=>'w-full'
    ],
    'data_src'=> '',
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'created_date', 
            'pk'=>'',
            'header'=>'Date',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[24vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[23vw]'
        ],
        [
            'type'=>'input',
            'field'=> 'user_input',
            'header'=>'User',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[50vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[50vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'approval-by',
            'header'=>'Approval',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[24vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black p-2 w-[23vw]'
        ]
    ]
];

