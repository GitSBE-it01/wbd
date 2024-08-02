<?php 
require_once '../../index.php';
require_once 'utils/jig_db_table.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
UPDATE HTML
=============================================================================== */

$nav_array_new['title'] = 'Add Data Jig';
$add = Comp::dtlist(['id'=>'loc_list'])
    .Comp::dtlist(['id'=>'type_list'])
    .$load2."
    ".Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>navi($nav_array_new)
    ])."
    ".Comp::aside([
        'class'=>'fixed top-[5vh] flex flex-col gap-4 w-[25vw] bg-slate-700 h-[95vh] items-center pl-4',
        'body'=>[
            table_create($table_list)
        ]
    ])."
    ".Comp::main([
        'class'=>'fixed flex flex-col top-[5vh] right-0 bg-slate-300 w-[75vw] h-[95vh] scrollable-y',
        'body'=>[
            Comp::div([
                'id'=>'add_jig',
                'class'=>'w-full h-full flex flex-col',
                'body'=>create_formset($detail_form)
            ]),
            Comp::div([
                'id'=>'add_speaker',
                'class'=>'w-full h-full flex flex-col',
                'body'=>create_formset($detail_form)
            ]),
            Comp::div([
                'id'=>'add_loc',
                'class'=>'w-full h-full flex flex-col',
                'body'=>create_formset($detail_form)
            ]),
            Comp::div([
                'id'=>'add_type_jig',
                'class'=>'w-full h-full flex flex-col',
                'body'=>create_formset($detail_form)
            ]),
            Comp::div([
                'id'=>'add_mtnc',
                'class'=>'w-full h-full flex flex-col',
                'body'=>create_formset($detail_form)
            ]),
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
    <script type='module' src='./client_process/add.js';></script>
    ";

createHTML([
'body'=>$add, 
'name'=>'add_new', 
'title'=>"Reference",
'path'=>'jig_db_new3'
]);



