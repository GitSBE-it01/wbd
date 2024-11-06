<?php 
require_once '../../index.php';
require_once 'utils/jig_db_table.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
UPDATE HTML
=============================================================================== */
$nav_array_new['title'] = 'Jig Usage History';
$usage = 
    $load2
    .Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>navi($nav_array_new)
    ])."
".Comp::header([
        'class'=>'fixed top-[5vh] flex flex-col w-screen h-[10vh]',
        'body'=>[
            Comp::div([
                'class'=>'flex flex-row h-[5vh] w-full bg-blue-700 gap-4 items-center',
                'body'=>[
                    Comp::div([
                        'class'=>'text-white text-lg font-bold',
                        'body'=>'From Date'
                    ]),
                    Comp::input([
                        'type_attr'=>'date',
                        'id'=>'date1',
                        'class'=>'cursor-pointer rounded px-2 justify-center bg-slate-200 items-center duration-300 ',
                    ]),
                    Comp::div([
                        'class'=>'text-white text-lg font-bold',
                        'body'=>'To Date'
                    ]),
                    Comp::input([
                        'type_attr'=>'date',
                        'id'=>'date2',
                        'class'=>'cursor-pointer rounded px-2 justify-center bg-slate-200 items-center duration-300 ',
                    ]),
                    Comp::button([
                        'id'=>'search_type',
                        'body'=>'search',
                        'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                    ]),
                    Comp::button([
                        'id'=>'dl_excel',
                        'body'=>'dl excel',
                        'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                    ]),
                ]
            ]),
            Comp::div([
                'class'=>'gap-4 p-2 h-[5vh] w-full bg-slate-700 items-center',
                'body'=>[
                    Comp::div([
                        'id'=>'usage_div_search',
                        'class'=>'flex flex-row gap-4 h-full w-full items-center',
                        'body'=>[
                            Comp::input([
                                'id'=>'input__usage',
                                'placeholder'=>'input jig disini',
                                'autocomplete'=>'off',
                                'list'=>'jig_list',
                                'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[40vw]'
                            ]),
                            Comp::button([
                                'id'=>'search_usage',
                                'body'=>'search',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-blue-200 duration-300'
                            ]),
                        ]
                    ]),
                ]
            ])
        ]
    ])."
    ".Comp::main([
        'class'=>'fixed flex flex-col top-[15vh] bg-slate-300 w-screen h-[80vh] scrollable-y',
        'body'=>table_create($usage_table),
    ])."
    ".Comp::footer([
        'class'=>'fixed bottom-0 bg-slate-700 w-screen h-[5vh]',
        'body'=>pagination_create('usage_page', ''),
    ])
."<script type='module' src='./client_process/usage.js';></script>
    ";

createHTML([
    'body'=>$usage, 
    'name'=>'usage', 
    'title'=>"Update Data Jig",
    'path'=>'jig_db_new3'
]);

