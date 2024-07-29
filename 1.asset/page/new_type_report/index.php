<?php 
require_once '../../index.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */

$index = Comp::dtlist(['id'=>'wo_list'])
    .Comp::dtlist(['id'=>'item_list'])
    .$load2."
    ".Comp::div([
        'id'=>'input_data',
        'class'=>'z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400 custom_scroll',
        'body'=>[
            Comp::title([
                'body'=>'masukkan data disini'
            ]),
            Comp::textarea([
                'title'=>'copy paste angkanya dari excel',
                'class'=>'w-full h-[[40vh]'
            ]),
            Comp::div([
                'class'=>'w-full h-[5vh] bg-slate-700 flex items-center',
                'body'=>[
                    Comp::button([
                        'id'=>'submit_form_btn',
                        'class'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300 mx-4',
                        'body'=>'submit'
                    ]),
                    Comp::button([
                        'id'=>'close_form_btn',
                        'class'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300',
                        'body'=>'cancel'
                    ]),
                ]
            ])
            
        ]
    ])."
    ".Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>nav($nav_array)
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
    <script type='module' src='./client_process/index.js';></script>
    ";

createHTML([
    'body'=>$index, 
    'name'=>'index', 
    'title'=>"New Type Report",
    'path'=>'new_type_report'
]);

