<?php 
require_once '../../index.php';
require_once 'utils/custom.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$nav_array['title'] = 'Data Browse';

createHTML([
    'name'=>'browse', 
    'title'=>"Detail Data",
    'path'=>'new_type_report',
    'body'=>
        $load2
        .Comp::header([
            'class'=>'fixed top-0 flex flex-col w-screen bg-slate-700 h-[10vh] pl-4',
            'body'=>[
                Comp::div([
                    'class'=>'w-full h-[5vh] px-2 gap-2 items-center flex flex-row',
                    'body'=>[
                        Comp::div([
                            'class'=>'w-[50%] h-full flex flex-row',
                            'body'=>[
                                Comp::div([
                                    'class'=>'w-[30%] text-white text-lg font-semibold h-full flex items-center',
                                    'body'=>'Item Number : '
                                ]),
                                Comp::div([
                                    'id'=>'item',
                                    'class'=>'w-[70%] text-white text-lg font-semibold  h-full flex items-center',
                                ]),
                            ]
                        ]),
                        Comp::div([
                            'class'=>'w-[50%] h-full flex flex-row',
                            'body'=>[
                                Comp::div([
                                    'class'=>'w-[30%] text-white text-lg font-semibold  h-full flex items-center',
                                    'body'=>'Description : '
                                ]),
                                Comp::div([
                                    'id'=>'_desc',
                                    'class'=>'w-[70%] text-white text-lg font-semibold  h-full flex items-center',
                                ]),
                            ]
                        ]),
      
                      ]
                ]),
                Comp::div([
                    'class'=>'w-[50%] h-[5vh] px-2 gap-2 items-center flex flex-row',
                    'body'=>[
                        Comp::div([
                            'class'=>'w-[30%] h-full text-white text-lg font-semibold flex items-center',
                            'body'=>'ID : '
                        ]),
                        Comp::div([
                            'id'=>'wo_id',
                            'class'=>'w-[70%] h-full text-white text-lg font-semibold flex items-center',
                        ]),
                      ]
                ]),
            ]
        ])."
        ".Comp::main([
            'class'=>'fixed flex flex-col top-[10vh] bg-slate-300 w-screen h-[90vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full flex flex-row scrollable-y',
                    'body'=>[
                        
                        table_create2($browse_table)
                    ]
                ])
            ]
        ])."
        <script type='module' src='./client_process/browse.js';></script>
        "
]);
    