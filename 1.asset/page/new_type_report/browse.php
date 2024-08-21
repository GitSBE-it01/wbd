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
            'class'=>'fixed top-0 flex flex-col w-screen bg-slate-700 h-[5vh] pl-4',
            'body'=>[
                Comp::div([
                    'class'=>'w-full h-[5vh] px-2 gap-2 items-center flex flex-row',
                    'body'=>[
                        Comp::input([
                            'id'=>'id_input',
                            'placeholder'=>'input WO ID disini',
                            'autocomplete'=>'off',
                            'list'=>'wo_list',
                            'require'=>'',
                            'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[45vw]'
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
                        
                    ]
                ])
            ]
        ])."
        ".Comp::footer([
            'class'=>'fixed flex flex-row bottom-0 bg-slate-700 w-screen h-[5vh]',
            'body'=>pagination_create('detail_page', '')
        ])."
        <script type='module' src='./client_process/browse.js';></script>
        "
]);
    