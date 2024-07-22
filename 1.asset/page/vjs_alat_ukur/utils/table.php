<?php
$main_table = [
    'id'=> 'table_index', 
    'class'=>'w-screen',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Date',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]',
            ],
            'td'=>[
                'data_attr'=>['field::eff_date'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]'
            ],
            'inp'=>[
                'type_attr'=>'date', 
                'disable'=>'',
                'name'=> 'eff_date', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'User',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[40vw]'
            ],
            'td'=>[
                'data_attr'=>['field::user_input'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[40vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'user_input', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[20vw]'
            ],
            'td'=>[
                'name'=>'loc',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[20vw]'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Approval',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[14vw]'
            ],
            'td'=>[
                'name'=>'approval_by',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[14vw]'
            ],
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Detail',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[6vw]'
            ],
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[6vw]'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::open'],
                    'class'=>'w-6 h-6 arrow_right_black'
                ]
            ]
        ],
    ]
];


$detail_table = [
    'id'=> 'detail_table', 
    'class'=>'w-full',
    'row_count'=>20,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'sn_id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'category'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'no_asset'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'eff_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'data_group'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'user_input'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'decision'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'approval_by'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Poin Cek',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[27vw]'
            ],
            'td'=>[
                'data_attr'=>['field::check_point'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[27vw]',
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'check_point', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Standard',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[55vw]'
            ],
            'td'=>[
                'data_attr'=>['field::standard'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[55vw]',
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'standard', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ]
        ],
        [
            'type'=>'option',
            'th'=>[
                'body'=>'Result',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[18vw]'
            ],
            'td'=>[
                'data_attr'=>['field::result'],
                'class'=>'bg-slate-300 flex flex-row whitespace-normal border-2 text-sm border-black w-[18vw]',
            ],
            'opt'=>[
                [
                    'data_attr'=>['field::result'],
                    'class'=>'bg-blue-300 whitespace-normal border-2 text-sm border-black w-[9vw]',
                    'body'=>'OK'
                ],
                [
                    'data_attr'=>['field::result'],
                    'class'=>'bg-blue-300 whitespace-normal border-2 text-sm border-black w-[9vw]',
                    'body'=>'NG'
                ],
            ]
        ],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'result'],
    ],
    'add_row'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'sn_id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'category'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'standard'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'no_asset'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'eff_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'data_group'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'user_input'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'decision'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'approval_by'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::check_point'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[27vw]',
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'check_point', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'cols'=>'2',
                'data_attr'=>['field::result'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[10vw]',
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'check_point', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ]
        ],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'result'],
    ]
];
