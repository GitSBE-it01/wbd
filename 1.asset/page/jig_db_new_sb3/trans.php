<?php 
require_once '../../index.php';
require_once 'utils/jig_db_table.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
UPDATE HTML
=============================================================================== */
$nav_array_new['title'] = 'Jig Transaction';
$trans = Comp::dtlist(['id'=>'loc_list'])
    .$load2."
    ".Comp::div([
        'data_attr'=>['card::detail'],
        'class'=>'z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400 custom_scroll flex flex-col',
        'body'=>[
            Comp::div([
                'class'=>'w-full h-[55vh] scrollable-y',
                'body'=>table_create($trans_detail_table),
            ]),
            Comp::div([
                'class'=>'w-full h-[5vh] bg-slate-700 flex flex-row ',
                'body'=>[
                    Comp::div([
                        'class'=>'w-[40%] h-full flex items-center justify-center',
                        'body'=>[
                        Comp::button([
                            'id'=>'close_detail',
                            'class'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300 mx-4',
                            'body'=>'cancel'
                        ]),
                        ]
                    ]),
                    Comp::div([
                        'class'=>'w-[60%] h-full align-right',
                        'body'=>[pagination_create('trans_detail_page', '')]
                    ])
                ]
            ])
            
        ]
    ])."
    ".Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>navi($nav_array_new)
    ])."
    ".Comp::header([
        'class'=>'fixed top-[5vh] flex flex-row gap-4 w-screen bg-slate-700 h-[5vh] items-center pl-4',
        'body'=>[
            Comp::input([
                'id'=>'input__jig',
                'placeholder'=>'input jig disini',
                'autocomplete'=>'off',
                'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-400 focus:ring-width-4 focus:outline focus:outline-teal-400 duration-300 right-10 shadow-md w-[40vw]'
            ]),
            Comp::button([
                'id'=>'search_jig',
                'body'=>'search',
                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
            ]),
        ]
    ])."
    ".Comp::main([
        'class'=>'fixed flex flex-col top-[10vh] bg-slate-300 w-screen h-[85vh] scrollable-y',
        'body'=>[
            table_create($trans_header_table)
        ]
    ])."
    ".Comp::footer([
        'class'=>'fixed bottom-0 bg-slate-700 w-screen h-[5vh]',
        'body'=>[
            Comp::div([
                'id'=>'type_page_div',
                'class'=>'w-full h-full',
                'body'=>pagination_create('trans_page', ''),
            ]),
        ]
    ])."
    <script type='module' src='./client_process/trans.js';></script>
    ";

createHTML([
'body'=>$trans, 
'name'=>'trans', 
'title'=>"Jig Transaction",
'path'=>'jig_db_new_sb3'
]);



