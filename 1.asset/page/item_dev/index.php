<?php 
require_once '../../index.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$nav_array['title'] = 'item development';

createHTML([
    'name'=>'index', 
    'title'=>"item development",
    'path'=>'item_develop',
    'body'=>
        $load2."
        ".Comp::nav([
            'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
            'body'=>navi($nav_array)
        ])."
        " 
        .Comp::header([
            'class'=>'fixed top-[5vh] flex flex-col w-screen h-[10vh]',
            'body'=>[
                Comp::div([
                    'id'=>'head_switch',
                    'class'=>'flex flex-row flex-1 w-full bg-blue-700 items-center',
                    'body'=>[
                        Comp::div([
                            'id'=>'idev',
                            'body'=>'Parent',
                            'data_attr' => ['switch::idev'],
                            'class'=>'flex flex-1 h-full cursor-pointer hover:bg-blue-600 justify-center items-center items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-600 text-xl font-bold'
                        ]),
                        Comp::div([
                            'id'=>'master',
                            'body'=>'Komponen',
                            'data_attr' => ['switch::master'],
                            'class'=>'flex flex-1 h-full cursor-pointer hover:bg-blue-600 justify-center items-center items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 '
                        ])
                    ]
                ]),
                Comp::div([
                    'id'=>'idev_div',
                    'class'=>'flex flex-row flex-1 gap-4 w-screen bg-slate-700 h-[5vh] items-center pl-4',
                    'body'=>[
                        Comp::input([
                            'id'=>'idev_search',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 shadow-md w-[15vw]'
                        ]),
                        Comp::button([
                            'id'=>'idev_search_btn',
                            'body'=>'search',
                            'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                        ]),
                        Comp::button([
                            'id'=>'idev_dl_btn',
                            'body'=>'download',
                            'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                        ]),
                    ]
                ]),
                Comp::div([
                    'id'=>'master_div',
                    'class'=>'flex flex-row flex-1 gap-4 w-screen bg-slate-700 h-[5vh] items-center hidden pl-4',
                    'body'=>[
                        Comp::input([
                            'id'=>'master_search',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 shadow-md w-[15vw]'
                        ]),
                        Comp::button([
                            'id'=>'master_search_btn',
                            'body'=>'search',
                            'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                        ]),
                        Comp::button([
                            'id'=>'master_dl_btn',
                            'body'=>'download',
                            'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                        ]),
                    ]
                ]),
            ]
        ])."
        ".Comp::main([
            'class'=>'fixed flex flex-col top-[15vh] bg-slate-300 w-screen h-[80vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full h-full ',
                    'body'=>[
                        table_create2($main_table),
                        table_create2($main_table2)
                    ]
                ])
            ]
        ])."
        ".Comp::footer([
            'class'=>'fixed flex flex-row bottom-0 bg-slate-700 w-screen h-[5vh]',
            'body'=>[
                Comp::div([
                    'id'=>'idev_page_div',
                    'class'=>' flex flex-row bg-slate-700 w-full h-full',
                    'body'=>pagination_create('idev_page', '')
                ]),
                Comp::div([
                    'id'=>'master_page_div',
                    'class'=>' flex flex-row bg-slate-700 w-full h-full hidden',
                    'body'=>pagination_create('master_page', '')
                ]),
            ]
        ])."
        <script type='module' src='./client_process/index.js';></script>
        "
]);


