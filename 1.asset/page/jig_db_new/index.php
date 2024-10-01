<?php 
require_once '../../index.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$nav_array_new['title'] = 'Jig Database';
$index = 
    $load2."
    ".Comp::div([
        'data_attr'=>['card::detail'],
        'class'=>'z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400 custom_scroll',
        'body'=>[
            Comp::div([
                'class'=>'w-full h-[5vh] flex flex-row',
                'body'=>[
                    Comp::div([
                        'id'=>'detail_loc_switch',
                        'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[5vh] w-[50%] items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-600 text-xl font-bold',
                        'body'=>'Detail Lokasi'
                    ]),
                    Comp::div([
                        'id'=>'detail_type_switch',
                        'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[5vh] w-[50%] items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 ',
                        'body'=>'Detail Usage'
                    ]),
                ]
            ]),
            Comp::div([
                'class'=>'w-full h-[50vh] scrollable',
                'body'=>[
                    table_create($detail_loc_jig),
                    table_create($detail_type_jig),
                ]
            ]),
            Comp::div([
                'class'=>'w-full h-[5vh] flex items-center',
                'body'=>[
                    Comp::div([
                        'class'=>'w-[20%] bg-slate-700 z-10 h-full items-center justify-center flex',
                        'body'=>
                            Comp::button([
                                'id'=>'close_detail',
                                'class'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300 mx-4',
                                'body'=>'close'
                            ])
                    ]),
                    Comp::div([
                        'class'=>'w-[80%] h-full bg-slate-700 z-10 items-end',
                        'body'=>[
                            pagination_create('detail_loc_jig_page', ''),
                            pagination_create('detail_type_jig_page', ''),
                        ]
                    ])
                ]
            ])
            
        ]
    ])."
    ".Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>navi($nav_array_new)
    ])."
    ".Comp::header([
        'class'=>'fixed top-[5vh] flex flex-col w-screen h-[10vh]',
        'body'=>[
            Comp::div([
                'class'=>'flex flex-row h-[5vh] w-full bg-blue-700 items-center',
                'body'=>[
                    Comp::div([
                        'id'=>'jig_switch',
                        'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[5vh] w-[50vw] items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-600 text-xl font-bold',
                        'body'=>'Jig Based Search'
                    ]),
                    Comp::div([
                        'id'=>'type_switch',
                        'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[5vh] w-[50vw] items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 ',
                        'body'=>'Speaker Based Search'
                    ]),
                ]
            ]),
            Comp::div([
                'class'=>'gap-4 p-2 h-[5vh] w-full bg-slate-700 items-center',
                'body'=>[
                    Comp::div([
                        'id'=>'jig_div_search',
                        'class'=>'flex flex-row gap-4 h-full w-full items-center',
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
                            Comp::button([
                                'id'=>'dl_jig',
                                'body'=>'dl excel',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ])
                        ]
                    ]),
                    Comp::div([
                        'id'=>'type_div_search',
                        'class'=>'flex flex-row gap-4 h-full w-full items-center hidden',
                        'body'=>[
                            Comp::input([
                                'id'=>'input__type',
                                'placeholder'=>'input type disini',
                                'autocomplete'=>'off',
                                'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[40vw]'
                            ]),
                            Comp::button([
                                'id'=>'search_type',
                                'body'=>'search',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ]),
                            Comp::button([
                                'id'=>'dl_type',
                                'body'=>'dl excel',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ])
                        ]
                    ])
                ]
            ])
        ]
    ])."
    ".Comp::main([
        'class'=>'fixed flex flex-col top-[15vh] bg-slate-300 w-screen h-[80vh] scrollable-y',
        'body'=>[
            table_create($jig_table),
            table_create($type_table)
        ]
    ])."
    ".Comp::footer([
        'class'=>'fixed bottom-0 bg-slate-700 w-screen h-[5vh]',
        'body'=>[
            Comp::div([
                'id'=>'jig_page_div',
                'class'=>'w-full h-full',
                'body'=>pagination_create('jig_page', ''),
            ]),
            Comp::div([
                'id'=>'type_page_div',
                'class'=>'w-full h-full hidden',
                'body'=>pagination_create('type_page', ''),
            ]),

        ]
    ])."
    <script type='module' src='./client_process/index.js';></script>
    ";

createHTML([
    'body'=>$index, 
    'name'=>'index', 
    'title'=>"Jig Database",
    'path'=>'jig_db_new'
]);


