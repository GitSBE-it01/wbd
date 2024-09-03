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
        ".Comp::main([
            'class'=>'fixed flex flex-col top-[5vh] bg-slate-300 w-screen h-[90vh] scrollable-y',
            'body'=>[
                Comp::div([
                    'id'=> 'primary',
                    'class'=>'w-full h-full flex justify-center',
                    'body'=> Comp::div([
                        'class'=>'h-full w-[80vw]',
                        'body'=>table_create2($reff_table),
                    ])
                ]),
                Comp::div([
                    'class'=>'fixed top-[6vh] right-10',
                    'body'=> [
                        Comp::button([
                            'id'=>'submit',
                            'data_attr'=>['method::submit'],
                            'class'=>'w-6 h-6 enter mx-2'
                        ]),
                        Comp::button([
                            'id'=>'add',
                            'data_attr'=>['method::add'],
                            'class'=>'w-6 h-6 plus'
                        ]),
                    ]
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
    