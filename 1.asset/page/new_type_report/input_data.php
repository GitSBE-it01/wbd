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
            'class'=>'fixed top-[5vh] flex flex-col w-screen bg-slate-700 h-[20vh] pl-4',
            'body'=>[
                Comp::div([
                    'class'=>'w-full h-[5vh] px-2 gap-2 items-center flex flex-row',
                    'body'=>[
                        Comp::input([
                            'id'=>'id_input',
                            'placeholder'=>'input WO ID disini',
                            'autocomplete'=>'off',
                            'list'=>'wo_list',
                            'require'=>'',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[45vw]'
                        ]),
                        Comp::div([
                            'id'=>'item_nbr',
                            'class'=>'bg-transparent mx-2 text-white'
                        ]),
                        Comp::div([
                            'id'=>'_desc',
                            'class'=>'bg-transparent mx-2 text-white'
                        ]),
                    ]
                ]),
                Comp::div([
                    'class'=>'w-full h-[15vh] px-2 mt-2 flex flex-col',
                    'body'=>[
                        Comp::div([
                            'class'=>'w-full h-[5vh] gap-2 flex flex-row',
                            'body'=>[
                            Comp::input([
                                'id'=>'comp_item',
                                'placeholder'=>'input komponen disini',
                                'autocomplete'=>'off',
                                'list'=>'item_list',
                                'disable'=>'',
                                'require'=>'',
                                'class'=>'rounded bg-slate-700 text-white px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[25vw]'
                            ]),
                            Comp::div([
                                'id'=>'comp_desc',
                                'class'=>'bg-transparent mx-2 text-white'
                            ])
                            ]
                        ]),
                        Comp::div([
                            'class'=>'w-full h-[5vh] gap-2 flex flex-row',
                            'body'=>[
                            Comp::input([
                                'id'=>'lot',
                                'placeholder'=>'No lot',
                                'autocomplete'=>'off',
                                'disable'=>'',
                                'require'=>'',
                                'class'=>'rounded bg-slate-700 text-white px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[25vw]'
                            ]),
                            ]
                        ]),
                        Comp::div([
                            'class'=>'w-full h-[5vh] gap-2 flex flex-row',
                            'body'=>[
                                Comp::select([
                                    'id'=>'jenis_ukur',
                                    'disable'=>'',
                                    'require'=>'',
                                    'class'=>'rounded bg-slate-700 text-white  px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[25vw]'
                                ]),
                                Comp::input([
                                    'id'=>'um',
                                    'placeholder'=>'satuan',
                                    'autocomplete'=>'off',
                                    'disable'=>'',
                                    'require'=>'',
                                    'class'=>'rounded bg-slate-700 text-white  px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[10vw]'
                                ]),
                                Comp::button([
                                    'id'=>'add_check',
                                    'body'=>'add',
                                    'disable'=>'',
                                    'class'=>'rounded bg-gray-300 text-white  w-[10vw] h-[1.6rem] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                                ]),
                            ]
                        ])
                    ]
                ])
            ]
        ])."
        ".Comp::main([
            'class'=>'fixed flex flex-col top-[25vh] bg-slate-300 w-screen h-[75vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full h-full ',
                    'body'=>[
                        Comp::div([
                            'id'=>'template',
                            'class'=>'hidden m-2 pb-2 border-2 border-slate-300',
                            'body'=>[
                                Comp::div([
                                    'data_attr'=>['detail::dtl'],
                                    'class'=>'rounded-t w-full h-[5vh] bg-blue-600 flex items-center px-4',
                                    'body'=>[
                                        Comp::div([
                                            'data_attr'=> ['detail::title'],
                                            'class'=>'font-bold underline text-white text-lg flex items-center'
                                        ]),
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'hd_code'
                                        ]),
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'msr_type'
                                        ]),
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'um'
                                        ]),
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'item_comp'
                                        ]),
                                        Comp::input([
                                            'type_attr'=>'hidden',
                                            'name'=>'no_lot'
                                        ]),
                                        Comp::button([
                                            'data_attr'=>['method::submit'],
                                            'body'=>'submit',
                                            'class'=>'rounded bg-gray-300 text-white  w-[10vw] h-[1.6rem] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                                        ]),
                                    ]
                                ]),
                                input_spc(10,10)
                            ]
                        ]),
                    ]
                ])
            ]
        ])."
        <script type='module' src='./client_process/input.js';></script>
        "
]);
    