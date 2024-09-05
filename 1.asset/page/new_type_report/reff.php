<?php 
require_once '../../index.php';
require_once 'utils/custom.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$nav_array['title'] = 'New Type Report';

createHTML([
    'name'=>'reff', 
    'title'=>"New Type Report",
    'path'=>'new_type_report',
    'body'=>
        $load2."
        ".Comp::nav([
            'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
            'body'=>navi($nav_array)
        ])."
        " 
        // header view
        .Comp::header([
            'class'=>'fixed top-[5vh] flex flex-row gap-4 w-screen bg-slate-700 h-[5vh] items-center pl-4',
            'body'=>[
                Comp::button([
                    'id'=>'submit',
                    'body'=>'Submit',
                    'disable'=>'',
                    'class'=>'rounded w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 bg-gray-300 text-slate-200'
                ]),
                Comp::button([
                    'id'=>'add',
                    'body'=>'Add New',
                    'data_attr'=>['method::add'],
                    'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                ]),

            ]
        ])."
        ".Comp::main([
            'class'=>'fixed flex flex-row top-[10vh] bg-slate-300 w-screen h-[85vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full h-full flex justify-center',
                    'body'=> Comp::div([
                        'class'=>'h-full w-[50%]',
                        'body'=>table_create2($reff_table),
                    ])
                ]),
            ]
        ])."
        ".Comp::footer([
            'class'=>'fixed flex flex-row bottom-0 bg-slate-700 w-screen h-[5vh]',
            'body'=>pagination_create('reff_page', '')
        ])."
        <script type='module' src='./client_process/reff.js';></script>
        "
]);
    