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
    'name'=>'tracker', 
    'title'=>"item development",
    'path'=>'item_develop',
    'body'=>
        $load2."
        ".Comp::nav([
            'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
            'body'=>navi($nav_array)
        ])."
        ".Comp::header([
            'class'=>'fixed flex flex-row bg-slate-700 items-center top-[5vh] w-screen h-[5vh] pl-4 gap-4',
            'body'=>[
                Comp::input([
                    'id'=>'main_track_search',
                    'list'=>'tracker_list',
                    'class'=>'flex rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 shadow-md w-[30vw]'
                ]),
                Comp::button([
                    'id'=>'main_track_search_btn',
                    'body'=>'search',
                    'class'=>'flex rounded justify-center bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                ]),
                Comp::button([
                    'id'=>'tracker_submit_btn',
                    'body'=>'submit',
                    'disable'=>'',
                    'class'=>'flex rounded justify-center bg-gray-300 w-[10vw] text-sm border-2 text-white border-slate-400 shadow-md duration-300'
                ]),
                Comp::button([
                    'id'=>'tracker_add_btn',
                    'body'=>'add new',
                    'disable'=>'',
                    'class'=>'flex rounded justify-center bg-gray-300 w-[10vw] text-sm border-2 text-white border-slate-400 shadow-md duration-300'
                ]),
                Comp::button([
                    'id'=>'tracker_dl_btn',
                    'body'=>'download',
                    'disable'=>'',
                    'class'=>'flex rounded justify-center bg-gray-300 w-[10vw] text-sm border-2 text-white border-slate-400 shadow-md duration-300'
                ]),

                Comp::div([
                    'class'=>'fixed flex flex-row block right-0 items-center',
                    'body'=>[
                        Comp::input([
                            'id'=>'tracker_search',
                            'class'=>'flex rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 shadow-md w-[10vw]'
                        ]),
                        Comp::button([
                            'id'=>'tracker_search_btn',
                            'class'=>'magnifier h-4 w-4 -translate-x-5'
                        ]),
                    ]
                ])
            ]
        ])."
        ".Comp::main([
            'class'=>'fixed flex flex-col top-[10vh] bg-slate-300 w-screen h-[85vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full h-full ',
                    'body'=>[
                        table_create2($tracker_table)
                    ]
                ])
            ]
        ])."
        ".Comp::footer([
            'class'=>'fixed flex flex-row bottom-0 bg-slate-700 w-screen h-[5vh]',
            'body'=>
                Comp::div([
                    'id'=>'tracker_page_div',
                    'class'=>' flex flex-row bg-slate-700 w-full h-full',
                    'body'=>pagination_create('tracker_page', '')
                ])
        ])."
        <script type='module' src='./client_process/tracker.js';></script>
        "
    ]);


