<?php 
require_once '../../index.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$nav_array['title'] = 'pick now';

createHTML([
    'name'=>'index', 
    'title'=>"pick now",
    'path'=>'pick_now',
    'body'=>
        $load2."
        ".Comp::nav([
            'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
            'body'=>navi($nav_array)
        ])."
        " 
        .Comp::header([
            'class'=>'fixed top-[5vh] flex flex-row gap-4 w-screen bg-slate-700 h-[5vh] items-center pl-4',
            'body'=>[
                Comp::div([
                    'id'=>'',
                    'class'=>'flex flex-row gap-4',
                    'body'=>[
                        Comp::label([
                            'for'=>'filter__dept_pick',
                            'class'=>'text-lg font-semibold mr-4 text-slate-200 float left-0 top-4',
                            'body'=>'Pilih Department'
                        ]),
                        Comp::select([
                            'id'=>'filter__dept_pick',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-40',
                            'body'=>[
                                Comp::option(['value'=>'P1.ASSY','body'=>'Prod1']),
                                Comp::option(['value'=>'PROD1.VC','body'=>'VC']),
                                Comp::option(['value'=>'WH_ASSY','body'=>'WHPR']),
                                Comp::option(['value'=>'SBE3','body'=>'SBE3']),
                                Comp::option(['value'=>'PROD2','body'=>'Prod2']),
                                Comp::option(['value'=>'PROD3','body'=>'Prod3']),
                                Comp::option(['value'=>'QA','body'=>'Servis']),
                                Comp::option(['value'=>'SUBCON','body'=>'Subcon']),
                                Comp::option(['value'=>'WOODWORK','body'=>'WWA']),
                            ]
                        ])
                    ]
                ]),
                Comp::div([
                    'id'=>'',
                    'class'=>'flex flex-row fixed items-center right-0 gap-4',
                    'body'=>[
                        Comp::input([
                            'id'=>'search_input',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[15vw]'
                        ]),
                        Comp::button([
                            'id'=>'search_btn',
                            'body'=>'search',
                            'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                        ]),
                        Comp::button([
                            'id'=>'dl_btn',
                            'body'=>'download',
                            'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                        ]),
                    ]
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
        <script type='module' src='./client_process/index.js';></script>
        "
]);


