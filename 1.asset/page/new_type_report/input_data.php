<?php 
require_once '../../index.php';
require_once 'utils/custom.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$nav_array['title'] = 'Input Measurement Data';

createHTML([
    'name'=>'input', 
    'title'=>"Input Data",
    'path'=>'new_type_report',
    'body'=>
        Comp::dtlist(['id'=>'item_list'])
        .Comp::dtlist(['id'=>'wo_list'])
        .$load2."
        ".Comp::nav([
            'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
            'body'=>navi($nav_array)
        ])."
        " 
        // main view
        .Comp::header([
            'class'=>'fixed top-[5vh] flex flex-col w-screen bg-slate-700 h-[5vh] pl-4',
            'body'=>[
                Comp::div([
                    'class'=>'w-full h-[5vh] gap-2 items-center flex flex-row',
                    'body'=>[
                        Comp::input([
                            'id'=>'id_input',
                            'placeholder'=>'Pilih ID disini',
                            'autocomplete'=>'off',
                            'list'=>'wo_list',
                            'require'=>'',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[10vw]'
                        ]),
                        Comp::div([
                            'class'=>'bg-transparent w-[30vw] flex flex-row mx-2 text-white',
                            'body'=>[
                                Comp::div([
                                    'class'=>'bg-transparent mx-2 text-white',
                                    'body'=>'Item Parent : '
                                ]),
                                Comp::div([
                                    'id'=>'item_nbr',
                                    'class'=>'bg-transparent mx-2 text-white',
                                ]),
                            ]
                        ]),
                        Comp::div([
                            'class'=>'bg-transparent w-[30vw] flex flex-row mx-2 text-white',
                            'body'=>[
                                Comp::div([
                                    'class'=>'bg-transparent mx-2 text-white',
                                    'body'=>'Description : '
                                ]),
                                Comp::div([
                                    'id'=>'_desc',
                                    'class'=>'bg-transparent mx-2 text-white',
                                ]),
                            ]
                        ]),
                        Comp::button([
                            'id'=>'add_new',
                            'class'=>'h-6 w-6 plus fixed right-2 opacity-25',
                            'disable'=>'',
                            'method'=>'add'
                        ])
   
                    ]
                ])
            ]
        ])."
        ".Comp::main([
            'class'=>'fixed flex flex-col top-[10vh] bg-slate-300 w-screen h-[90vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full h-full',
                    'body'=>[
                        Comp::div([
                            'id'=>'template',
                            'data_attr'=>['detail::template'],
                            'class'=>'my-2 hidden w-full flex flex-row bg-blue-200',
                            'body'=>[
                                Comp::div([
                                    'id'=>'detail',
                                    'class'=>'w-[50%] bg-blue-600 flex flex-col gap-4 p-4',
                                    'body'=>[
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'create_date',
                                        ]),
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'item_number',
                                        ]),
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'id',
                                        ]),
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'part_prod',
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::label([
                                                    'for'=>'comp',
                                                    'class'=>'text-white bg-transparent w-[30%]',
                                                    'body'=>'Item Komponen'
                                                ]),
                                                Comp::input([
                                                    'id'=>'comp',
                                                    'type_attr'=>'text',
                                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[70%]',
                                                    'name'=>'item_comp',
                                                    'require'=>"",
                                                    'list'=>'item_list'
                                                ]),
                                            ]
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::label([
                                                    'for'=>'comp_item',
                                                    'class'=>'text-white bg-transparent w-[30%]',
                                                    'body'=>'Desc Komponen'
                                                ]),
                                                Comp::input([
                                                    'id'=>'comp_item',
                                                    'data_attr'=>['name::desc_comp'],
                                                    'type_attr'=>'text',
                                                    'disable'=>'',
                                                    'class'=>'px-2 text-sm h-[1.6rem] bg-transparent underline text-bold text-white right-10 w-[70%]',
                                                ]),
                                            ]
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::label([
                                                    'for'=>'measure',
                                                    'class'=>'text-white bg-transparent w-[30%]',
                                                    'body'=>'Tipe Pengukuran'
                                                ]),
                                                Comp::input([
                                                    'id'=>'measure',
                                                    'type_attr'=>'text',
                                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[70%]',
                                                    'require'=>"",
                                                    'name'=>'measure'
                                                ]),
                                            ]
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::label([
                                                    'for'=>'um',
                                                    'class'=>'text-white bg-transparent w-[30%]',
                                                    'body'=>'Satuan'
                                                ]),
                                                Comp::input([
                                                    'id'=>'um',
                                                    'type_attr'=>'text',
                                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[70%]',
                                                    'name'=>'um'
                                                ]),
                                            ]
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::label([
                                                    'for'=>'no_lot',
                                                    'class'=>'text-white bg-transparent w-[30%]',
                                                    'body'=>'No Lot'
                                                ]),
                                                Comp::input([
                                                    'id'=>'no_lot',
                                                    'type_attr'=>'text',
                                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[70%]',
                                                    'name'=>'no_lot'
                                                ]),
                                            ]
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::label([
                                                    'for'=>'std_min',
                                                    'class'=>'text-white bg-transparent w-[30%]',
                                                    'body'=>'Min'
                                                ]),
                                                Comp::input([
                                                    'id'=>'std_min',
                                                    'type_attr'=>'text',
                                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[70%]',
                                                    'name'=>'std_min'
                                                ]),
                                            ]
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::label([
                                                    'for'=>'std_max',
                                                    'class'=>'text-white bg-transparent w-[30%]',
                                                    'body'=>'Max'
                                                ]),
                                                Comp::input([
                                                    'id'=>'std_max',
                                                    'type_attr'=>'text',
                                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[70%]',
                                                    'name'=>'std_max'
                                                ]),
                                            ]
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::label([
                                                    'for'=>'sample',
                                                    'class'=>'text-white bg-transparent w-[30%]',
                                                    'body'=>'Jumlah Sample'
                                                ]),
                                                Comp::input([
                                                    'id'=>'sample',
                                                    'type_attr'=>'text',
                                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[70%]',
                                                ]),
                                            ]
                                        ]),
                                        Comp::div([
                                            'class'=>'w-full flex flex-row gap-2',
                                            'body'=>[
                                                Comp::button([
                                                    'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:bg-slate-600 hover:font-semibold duration-300',
                                                    'id'=>'submit_btn',
                                                    'body'=>'submit'
                                                ]),
                                                Comp::button([
                                                    'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:bg-slate-600 hover:font-semibold duration-300',
                                                    'id'=>'edit_btn',
                                                    'body'=>'edit'
                                                ]),
                                                Comp::button([
                                                    'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:bg-slate-600 hover:font-semibold duration-300',
                                                    'id'=>'del_btn',
                                                    'body'=>'delete'
                                                ]),
                                            ]
                                        ])
                                    ]
                                ]),
                                Comp::div([
                                    'class'=>'w-[50%]',
                                    'id'=>'data_input',
                                    'body'=>input_spc(10,10)
                                ])
                            ]
                        ]),
                    ]
                ])
            ]
        ])."
        <script type='module' src='./client_process/input.js';></script>
        "
]);
    