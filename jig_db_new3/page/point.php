<?php
$point_search = "<input type='text' autocomplete='off' placeholder='input' class='rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 z-30 shadow-md w-[40vw] mt-2'data-input='input__point_search'>";


$point_table = [
    'table'=> [
        'id'=> 'table_point', 
        'style'=>'w-screen'
    ],
    'data_array'=> [
        [
            'type'=>'input', 
            'field'=> 'new_cat', 
            'header'=>'Kategori',
            'disable'=>'',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[22vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[22vw]'
        ],
        [
            'type'=>'input', 
            'field'=> 'check_point', 
            'header'=>'Poin Pengecekan',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[50vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[50vw]'
        ],
        [
            'type'=>'input',
            'field'=> 'standard',
            'header'=>'Standard',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[22vw]'
        ],
        ['type'=>'hidden','field'=>'alat'],
        ['type'=>'hidden','field'=>'pilihan'],
        ['type'=>'hidden','field'=>'status'],
    ]
];

