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
            'class'=>'fixed top-[5vh] flex flex-col w-screen bg-slate-700 h-[15vh] pl-4',
            'body'=>[
                Comp::div([
                    'class'=>'w-full h-[5vh] px-2 gap-2 items-center flex flex-row',
                    'body'=>[
                        Comp::input([
                            'id'=>'id_input',
                            'placeholder'=>'input jig disini',
                            'autocomplete'=>'off',
                            'list'=>'wo_list',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[25vw]'
                        ]),
                        Comp::input([
                            'id'=>'item_nbr',
                            'disable'=>'',
                            'class'=>'bg-transparent mx-2 text-white'
                        ]),
                        Comp::input([
                            'id'=>'_desc',
                            'disable'=>'',
                            'class'=>'bg-transparent mx-2 text-white'
                        ]),
                    ]
                ]),
                Comp::div([
                    'class'=>'w-full h-[10vh] px-2 gap-2 mt-2 flex flex-col',
                    'body'=>[
                        Comp::input([
                            'id'=>'comp_item',
                            'placeholder'=>'input komponen disini',
                            'autocomplete'=>'off',
                            'list'=>'wo_list',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[25vw]'
                        ]),
                        Comp::div([
                            'class'=>'w-full h-[5vh] gap-2 flex flex-row',
                            'body'=>[
                                Comp::input([
                                    'id'=>'jenis_ukur',
                                    'placeholder'=>'pengukuran',
                                    'autocomplete'=>'off',
                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[25vw]'
                                ]),
                                Comp::input([
                                    'id'=>'um',
                                    'placeholder'=>'satuan',
                                    'autocomplete'=>'off',
                                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[10vw]'
                                ]),
                            ]
                        ])
                    ]
                ])
            ]
        ])."
        ".Comp::main([
            'class'=>'fixed flex flex-col top-[20vh] bg-slate-300 w-screen h-[80vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full h-full ',
                    'body'=>input_spc(10,10)
                ])
            ]
        ])."
        <script type='module' src='./client_process/index.js';></script>
        "
]);
    