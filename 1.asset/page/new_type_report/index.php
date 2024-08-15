<?php 
require_once '../../index.php';
require_once 'utils/custom.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$nav_array['title'] = 'New Type Report';

createHTML([
    'name'=>'index', 
    'title'=>"New Type Report",
    'path'=>'new_type_report',
    'body'=>
        $load2."
        ".Comp::nav([
            'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
            'body'=>navi($nav_array)
        ])."
        " 
        // main view
        .Comp::header([
            'class'=>'fixed top-[5vh] flex flex-row gap-4 w-screen bg-slate-700 h-[5vh] items-center pl-4',
            'body'=>[
                Comp::input([
                    'id'=>'input__jig',
                    'placeholder'=>'input jig disini',
                    'autocomplete'=>'off',
                    'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[40vw]'
                ]),
                Comp::button([
                    'id'=>'search_jig',
                    'body'=>'search',
                    'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                ]),
            ]
        ])."
        ".Comp::main([
            'class'=>'fixed flex flex-col top-[10vh] bg-slate-300 w-screen h-[85vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full h-full ',
                    'body'=>[
                        table_create2($main_table)
                    ]
                ])
            ]
        ])."
        ".Comp::footer([
            'class'=>'fixed flex flex-row bottom-0 bg-slate-700 w-screen h-[5vh]',
            'body'=>pagination_create('main_page', '')
        ])."
        "
        // hidden div 
        .Comp::div([
            'id'=>'detail',
            'class'=>'z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400 custom_scroll',
            'body'=>[
                Comp::div([
                    'class'=>'w-full h-[10vh] bg-blue-700 flex items-center',
                    'body'=>[
                        Comp::title([
                            'id'=>'detail_title',
                            'class'=>'text-white px-4 font-bold text-xl whitespace-pre-line',
                        ])
                    ]
                ]),
                Comp::div([
                    'class'=>'w-full h-[45vh]',
                    'body'=>table_create2($id_table)
                ]),
                Comp::div([
                    'class'=>'w-full h-[5vh] bg-slate-700 flex flex-row',
                    'body'=>[
                        Comp::div([
                            'class'=>'justify-center py-2 px-4 items-center w-[30%]',
                            'body'=>[
                                Comp::button([
                                    'id'=>'close_btn',
                                    'data_attr'=>['method::close'],
                                    'class'=>'cursor-pointer w-full bg-slate-200 rounded hover:bg-slate-400 duration-300 hover:font-bold h-full',
                                    'body'=>'close'
                                ])
                            ]
                        ]),
                        Comp::div([
                            'class'=>'w-[70%] h-full flex items-center justify-center',
                            'body'=>[
                                pagination_create('id_page', '')
                            ]
                        ])
                    ]
                ]),
            ]
        ])."
        <script type='module' src='./client_process/index.js';></script>
        "
]);
    