<?php

$main_table = [
    'id'=> 'table_index', 
    'class'=>'w-screen scrollable-y',
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
                'list'=>'item_list',
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
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
                [
                    'data_attr'=>['method::edit'],
                    'class'=>'w-6 h-6 ml-2 edit'
                ],
            ]
        ],
    ]
];

$template_new = [
    'id'=> 'new_main', 
    'class'=>'hidden',
    'row_count'=>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::item_number'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'item_number', 
                'disable'=>'',
                'list'=>'item_list',
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
                'disable'=>'',
                'name'=> '_desc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::	fo_before_brk_in'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'fo_before_brk_in',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::tol_fo_before'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'tol_fo_before', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::fo_after_brk_in'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'fo_after_brk_in', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::tol_fo_after'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'tol_fo_after', 
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
                    'data_attr'=>['method::open'],
                    'class'=>'w-6 h-6 arrow_right_black'
                ],
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 ml-2 minus'
                ],
            ]
        ],
    ]
];

$detail_table = [
    'id'=> 'detail_table', 
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
                'list'=>'item_list',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'ID',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::wo_id'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'wo_id',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'FO Before',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::fo_act_before'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'fo_act_before', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'FO After',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'td'=>[
                'data_attr'=>['field::fo_act_after'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black '
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'fo_act_after', 
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
                    'body'=>'detail',
                    'data_attr'=>['method::detail'],
                    'class'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300 mx-4',
                ],
            ]
        ],
    ]
];