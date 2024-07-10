<?php

$tool_search = "<input type='text' autocomplete='off' placeholder='input' class='rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 z-30 shadow-md w-[40vw] my-3' data-input='input__tool_search'>";


$btn_search = button([
    'id'=>'search_btn',
    'text'=>'search',
    'style'=>'z-30 rounded bg-gray-300 text-sm my-3 px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300'
]);

$btn_submit_form2 = button([
    'id'=>'submit_form_btn',
    'text'=>'submit',
    'style'=>'z-30 rounded bg-gray-300 text-sm my-3 px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300'
]);

$btn_new2 = button([
    'id'=>'new__data',
    'text'=>'add new',
    'disable'=>'',
    'style'=>'z-30 rounded bg-gray-300 text-sm my-3 px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300'
]);

$tool_table = [
    'table'=> [
        'id'=> 'table_tool', 
        'style'=>'w-screen'
    ],
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'sn_id', 
            'header'=>'No Seri',
            'disable'=>'',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[22vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[22vw]'
        ],
        [
            'type'=>'text', 
            'field'=> 'new_subcat', 
            'header'=>'Kategori',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[50vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[50vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'no_asset',
            'header'=>'No Asset',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[22vw]'
        ],
        [
            'type'=>'text',
            'field'=> '_desc',
            'header'=>'Deskripsi',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[22vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'merk',
            'header'=>'Merek',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[22vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'loc',
            'header'=>'Lokasi',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[22vw]'
        ],
        ['type'=>'hidden','field'=>'cat'],
        ['type'=>'hidden','field'=>'subcat'],
    ]
];


