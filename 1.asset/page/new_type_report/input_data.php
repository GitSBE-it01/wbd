<?php 
require_once '../../index.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$nav_array['title'] = 'Input Data';
$input = 
    $load2."
    ".Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>navi($nav_array)
    ])."
    ".Comp::header([
        'class'=>'fixed px-2 top-[5vh] bg-slate-700 w-screen h-[10vh] flex flex-row scrollable-y',
        'body'=>[
            Comp::div([
                'id'=>'search_div',
                'class'=>'w-[70%] h-full flex flex-col gap-4',
                'body'=>[
                    Comp::div([
                        'class'=>'w-full flex flex-row gap-4',
                        'body'=>[
                            Comp::select([
                                'id'=>'search__key',
                                'class'=>'rounded px-2 h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[15vw] my-3',
                            ]),
                            Comp::div([
                                'class'=>'items-center flex text-white font-xl mx-4',
                                'body'=>" = "
                            ]),
                            Comp::input([
                                'id'=>'search__data',
                                'placeholder'=>'input value',
                                'class'=>'rounded px-2 h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[40vw] my-3'
                            ]),
                        ]
                    ])
                ]
            ]),
            Comp::div([
                'class'=>'w-[30%] h-full flex flex-row pt-4',
                'body'=>[
                    Comp::button([
                        'id'=>'search_btn',
                        'body'=>'search',
                        'class'=>'rounded bg-gray-300 text-sm h-[1.6rem] mx-2 px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300'
                    ]),
                    Comp::button([
                        'id'=>'add_filter',
                        'body'=>'add filter',
                        'class'=>'rounded bg-gray-300 text-sm h-[1.6rem] mx-2 px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300'
                    ]),
                    Comp::button([
                        'id'=>'add_new',
                        'body'=>'add data',
                        'class'=>'rounded bg-gray-300 text-sm h-[1.6rem] mx-2 px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300'
                    ])
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
                    table_create($main_table),
                    table_create($template_new)
                ]
            ]),
            Comp::div([
                'id'=> 'detail',
                'class'=>'w-full h-full hidden flex flex-row',
                'body'=>[
                    Comp::div([
                        'class'=>'h-full w-[20vh] bg-blue-200',
                        'body'=>[
                            table_create($template_new)
                        ]
                    ]),
                    Comp::div([
                        'class'=>'h-full w-[80vh] bg-blue-200',
                        'body'=>[
                            table_create($template_new)
                        ]
                    ]),
                ]
            ]),
        ]
    ])."
    ".Comp::footer([
        'class'=>'fixed flex flex-row bottom-0 bg-slate-700 w-screen h-[5vh]',
        'body'=>pagination_create('main_page', '')
    ])."
    <script type='module' src='./client_process/input.js';></script>
    ";

createHTML([
    'body'=>$input, 
    'name'=>'input', 
    'title'=>"New Type Report",
    'path'=>'new_type_report'
]);

