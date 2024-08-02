<?php 
require_once '../../index.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
tool HTML
=============================================================================== */
$nav_array['title'] = 'Reference';
$reff = $load2."
    ".Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>nav($nav_array)
    ])."
    ".Comp::main([
        'class'=>'fixed flex flex-row top-[5vh] bg-slate-300 w-screen h-[95vh] scrollable-y',
        'body'=>[
            Comp::div([
                'class'=>'flex flex-col w-[50vw] h-full border-r-2 border-black',
                'body'=>[
                    Comp::div([
                        'id'=>'title_loc',
                        'class'=>'w-full h-[5vh] ml-4 flex items-center gap-2',
                        'body'=> [
                            Comp::label([
                                'for'=>'loc_inp',
                                'body'=>'Lokasi'
                            ]),
                            Comp::input([
                                'id'=>'loc_inp',
                                'class'=>'rounded p-2 focus:ring h-[1.6rem] focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md'
                            ]),
                            Comp::button([
                                'id'=>'submit_loc_btn',
                                'body'=>'submit',
                                'class'=>'rounded bg-gray-300 text-sm my-3 mx-2 px-4 border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ]),
                            Comp::button([
                                'id'=>'add_loc_btn',
                                'body'=>'add',
                                'class'=>'rounded bg-gray-300 text-sm my-3 mx-2 px-4 border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ])
                        ]
                    ]),
                    Comp::div([
                        'id'=>'table_loc',
                        'class'=>'w-full h-[85vh] scrollable-y',
                        'body'=> [
                            table_create($loc_table),
                            table_create($new_loc_table)
                        ]
                    ]),
                    Comp::div([
                        'id'=>'footer_loc',
                        'class'=>'w-full h-[5vh] bg-slate-700',
                        'body'=>pagination_create('loc_page', '')
                    ]),
                ]
            ]),
            Comp::div([
                'class'=>'flex flex-col w-[50vw] h-full',
                'body'=>[
                    Comp::div([
                        'id'=>'title_reff',
                        'class'=>'w-full h-[5vh] ml-4 flex items-center gap-2',
                        'body'=> [
                            Comp::label([
                                'for'=>'reff_inp',
                                'body'=>'Reff'
                            ]),
                            Comp::input([
                                'id'=>'reff_inp',
                                'class'=>'rounded p-2 focus:ring h-[1.6rem] focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md'
                            ]),
                            Comp::button([
                                'id'=>'submit_reff_btn',
                                'body'=>'submit',
                                'class'=>'rounded bg-gray-300 text-sm my-3 mx-2 px-4 border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ]),
                            Comp::button([
                                'id'=>'add_reff_btn',
                                'body'=>'add',
                                'class'=>'rounded bg-gray-300 text-sm my-3 mx-2 px-4 border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ])
                        ]
                    ]),
                    Comp::div([
                        'id'=>'table_reff',
                        'class'=>'w-full h-[85vh] scrollable-y',
                        'body'=> [
                            table_create($reff_table),
                            table_create($new_reff_table)
                        ]
                    ]),
                    Comp::div([
                        'id'=>'footer_reff',
                        'class'=>'w-full h-[5vh] bg-slate-700',
                        'body'=>pagination_create('reff_page', '')
                    ]),
                ]
            ]),
        ]
    ])."
    <script type='module' src='./client_process/reff_vjs.js';></script>
    ";

createHTML([
    'body'=>$reff, 
    'name'=>'reff_vjs', 
    'title'=>"Data Reference",
    'path'=>'vjs_alat_ukur'
]);