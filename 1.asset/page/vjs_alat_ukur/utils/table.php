<?php
$template_new = [
    'id'=> 'new_main', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'data_group'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'sn_id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'no_asset'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'period'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'category'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::eff_date'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[15vw]',
            ],
            'inp'=>[
                'type_attr'=>'date', 
                'name'=> 'eff_date', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],[
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::user_input'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[30vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'user_input', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],[
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::loc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[15vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'list'=>'loc_list',
                'name'=>'loc',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],[
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::approval_by'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[15vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'approval_by', 
                'list'=> 'user_list', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],[
            'type'=>'select',
            'td'=>[
                'data_attr'=>['field::decision'],
                'class'=>'bg-slate-300 flex flex-row whitespace-normal border-2 border-black h-[10vh] justify-center items-center font-lg',
            ],
            'select'=>[
                'name'=> 'decision', 
                'class'=>'w-[12vw] h-[10vh] hidden flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ],
            'option'=>[
                ['value'=>'-', 'body'=>'-', 'select'=>''],
                ['value'=>'OK', 'body'=>'OK'],
                ['value'=>'NG', 'body'=>'NG'],
            ]
            /*
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::decision'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'decision', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]*/
        ],[
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[10vw]'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::open'],
                    'class'=>'w-6 h-6 arrow_right_black'
                ],
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ],
];

$main_table = [
    'id'=> 'table_index', 
    'class'=>'w-screen',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'data_group'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'sn_id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'no_asset'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'period'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'category'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Date',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[15vw]',
            ],
            'td'=>[
                'data_attr'=>['field::eff_date'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'date', 
                'name'=> 'eff_date', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'User',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]'
            ],
            'td'=>[
                'data_attr'=>['field::user_input'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'user_input', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::loc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'list'=>'loc_list',
                'name'=>'loc',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Approval',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::approval_by'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'approval_by', 
                'list'=> 'user_list', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'select',
            'th'=>[
                'body'=>'Decision',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]'
            ],
            'td'=>[
                'data_attr'=>['field::decision'],
                'class'=>'bg-slate-300 flex flex-row whitespace-normal border-2 border-black h-[10vh] justify-center items-center font-lg',
            ],
            'select'=>[
                'name'=> 'decision', 
                'class'=>'w-[12vw] h-[10vh] hidden flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ],
            'option'=>[
                ['value'=>'-', 'body'=>'-', 'select'=>''],
                ['value'=>'OK', 'body'=>'OK'],
                ['value'=>'NG', 'body'=>'NG'],
            ]
            /*
            'type'=>'input',
            'th'=>[
                'body'=>'Decision',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::decision'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'decision', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]*/
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Detail',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[10vw]'
            ],
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::open'],
                    'class'=>'w-6 h-6 arrow_right_black'
                ],
                [
                    'data_attr'=>['method::delete', 'role::admin'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];



$detail_table = [
    'id'=> 'detail_table', 
    'class'=>'w-full h-[45vh] scrollable-y',
    'row_count'=>20,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'data_group'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Poin Cek',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::check_point'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[15vw]',
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'check_point', 
                'class'=>'w-full h-full hidden flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Standard',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[40vw]'
            ],
            'td'=>[
                'data_attr'=>['field::standard'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[40vw]',
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'standard', 
                'class'=>'w-full h-full hidden flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ]
        ],
        [
            'type'=>'select',
            'th'=>[
                'body'=>'Result',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]'
            ],
            'td'=>[
                'data_attr'=>['field::result'],
                'class'=>'bg-slate-300 flex flex-row whitespace-normal border-2 text-sm border-black w-[12vw] h-full justify-center items-center font-lg',
            ],
            'select'=>[
                'name'=> 'result', 
                'class'=>'w-[12vw] h-full hidden flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ],
            'option'=>[
                ['value'=>'-', 'body'=>'-', 'select'=>''],
                ['value'=>'OK', 'body'=>'OK'],
                ['value'=>'NG', 'body'=>'NG'],
            ]
        ],
    ]
];


$add_table = [
    'id'=> 'add_table', 
    'class'=>'w-full h-[10vh] scrollable-y',
    'row_count'=>1,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
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
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[15vw]',
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'check_point', 
                'class'=>'w-full h-full flex hidden justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::result'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[55vw]',
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'result', 
                'class'=>'w-full h-full flex hidden justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
            ]
        ],
    ]
];



$tool_table = [
    'id'=> 'tool_table', 
    'class'=>'w-screen',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'cat'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'subcat'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'No Seri',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[15vw]',
            ],
            'td'=>[
                'data_attr'=>['field::sn_id'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'sn_id', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Kategori',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]'
            ],
            'td'=>[
                'data_attr'=>['field::new_subcat'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'new_subcat', 
                'list'=> 'reff_list', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'No Asset',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]'
            ],
            'td'=>[
                'data_attr'=>['field::no_asset'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'no_asset', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Deskripsi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]'
            ],
            'td'=>[
                'data_attr'=>['field::_desc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> '_desc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Merek',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]'
            ],
            'td'=>[
                'data_attr'=>['field::merk'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'merk', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]'
            ],
            'td'=>[
                'data_attr'=>['field::loc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'loc', 
                'list'=>'loc_list',
                'require'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black hidden'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete', 'role::admin'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];

$tool_new = [
    'id'=> 'tool_new', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>'bg-blue-200'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'cat'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'subcat'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::sn_id'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'sn_id', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::new_subcat'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'new_subcat', 
                'list'=> 'reff_list', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::no_asset'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'no_asset', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::_desc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> '_desc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::merk'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'merk', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::loc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'loc', 
                'list'=>'loc_list',
                'require'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black hidden'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete', 'role::admin'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];

$point_table = [
    'id'=> 'point_table', 
    'class'=>'w-screen',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'alat'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Kategori',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[15vw]',
            ],
            'td'=>[
                'data_attr'=>['field::new_cat'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'new_cat', 
                'disable'=>'',
                'list'=>'reff_list',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Point Pengecekan',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]'
            ],
            'td'=>[
                'data_attr'=>['field::check_point'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'check_point', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Standard',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[30vw]'
            ],
            'td'=>[
                'data_attr'=>['field::standard'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'standard', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'piliihan'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status', 'value'=>''],
        [
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black hidden'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete', 'role::admin'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];

$point_new = [
    'id'=> 'point_new', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>'bg-blue-200'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'alat'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::new_cat'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'new_cat', 
                'list'=>'reff_list',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::check_point'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'check_point', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::standard'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'standard', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'piliihan'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status', 'value'=>''],
        [
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black hidden'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete', 'role::admin'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];


$loc_table = [
    'id'=> 'loc_table', 
    'class'=>'w-full',
    'row_count' =>50,
    'tr'=>['class'=>''],
    'data_array'=> [
        [    
            'type'=>'input',
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[45vw]',
            ],
            'td'=>[
                'data_attr'=>['field::location'],
                'class'=>'bg-slate-200 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'location', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Del',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[5vw]',
            ],
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];

$reff_table = [
    'id'=> 'reff_table', 
    'class'=>'w-full',
    'row_count' =>50,
    'tr'=>['class'=>''],
    'data_array'=> [
        [    
            'type'=>'input',
            'th'=>[
                'body'=>'Kategori',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[45vw]',
            ],
            'td'=>[
                'data_attr'=>['field::subcat'],
                'class'=>'bg-slate-200 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'subcat', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Del',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[5vw]',
            ],
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];


$new_loc_table = [
    'id'=> 'new_loc_table', 
    'class'=>'hidden',
    'row_count'=>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        [    
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::location'],
                'class'=>'bg-slate-200 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'location', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];

$new_reff_table = [
    'id'=> 'new_reff_table', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        [    
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::subcat'],
                'class'=>'bg-slate-200 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'subcat', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];