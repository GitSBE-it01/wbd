<?php

$main_table = [
    'id'=> 'main_table', 
    'class'=>'w-full scrollable-y',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Item Number',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[15vw]',
            ],
            'td'=>[
                'data_attr'=>['field::item_number'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'item_number', 
                'disable'=>'',
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
                'disable'=>'',
                'name'=> '_desc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'FO before Break In',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[10vw]'
            ],
            'td'=>[
                'data_attr'=>['field::fo_before_brk_in'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=>'fo_before_brk_in',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Toleransi FO before',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[10vw]'
            ],
            'td'=>[
                'data_attr'=>['field::tol_fo_before'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'tol_fo_before', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'FO after Break In',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[10vw]'
            ],
            'td'=>[
                'data_attr'=>['field::fo_after_brk_in'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'fo_after_brk_in', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Toleransi FO after',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[10vw]'
            ],
            'td'=>[
                'data_attr'=>['field::tol_fo_after'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'tol_fo_after', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Detail',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[5vw]'
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
                    'data_attr'=>['method::edit'],
                    'class'=>'w-6 h-6 ml-2 edit'
                ],
            ]
        ],
    ]
];

$id_table = [
    'id'=> 'id_table', 
    'class'=>'w-full',
    'row_count' =>10,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_number'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'create_date'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'ID',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::wo_id'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'wo_id', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Release Date',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::rel_date'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'rel_date', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Due Date',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::due_date'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'due_date', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'WO status',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::_status'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> '_status', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Qty Order',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::qty_ord'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'qty_ord', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Detail',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::data_group'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::link'],
                    'class'=>'w-6 h-6 enter'
                ]
            ]
        ],
    ]
];


$detail_table = [
    'id'=> 'detail_table', 
    'class'=>'w-screen scrollable-y',
    'row_count' =>100,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Item Number',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[15vw]',
            ],
            'td'=>[
                'data_attr'=>['field::item_number'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'item_number', 
                'disable'=>'',
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
                'disable'=>'',
                'name'=> '_desc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'FO before Break In',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::fo_before_brk_in'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=>'fo_before_brk_in',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Toleransi FO before',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::tol_fo_before'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'tol_fo_before', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'FO after Break In',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::fo_after_brk_in'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'fo_after_brk_in', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Toleransi FO after',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::tol_fo_after'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'tol_fo_after', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
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
                    'data_attr'=>['method::edit'],
                    'class'=>'w-6 h-6 ml-2 edit'
                ],
            ]
        ],
    ]
];

$browse_table = [
    'id'=> 'browse_table_temp', 
    'class'=>'hidden',
    'row_count' =>100,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'type'=>'text',
            'th'=>[
                'body'=>'',
                'data_attr'=>['graph::cpk'],
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 cursor-pointer hover:text-xl duration-300 h-[10vh] w-[8vw] underline'
            ],
            'td'=>[
                'name'=>'no_repeat',
                'class'=>'bg-slate-400 whitespace-normal border-2 py-2 px-4 border-black'
            ]
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Result',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[10vw]'
            ],
            'td'=>[
                'name'=>'result',
                'class'=>'bg-slate-300 whitespace-normal border-2 py-2 px-4 border-black'
            ]
        ],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'repeat_code'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'hd_code'],
    ]
];