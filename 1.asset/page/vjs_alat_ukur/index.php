<?php 
require_once '../../index.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */

$index = $datalist->create(['id'=>'alat_list'])
    .Comp::dtlist(['id'=>'user_list'])
    .Comp::dtlist(['id'=>'loc_list'])
    .$load2."
    ".$div->create([
        'data_attr'=>['card::detail'],
        'class'=>'z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400 custom_scroll',
        'body'=>[
            table_create($detail_table),
            table_create($add_table),
            Comp::div([
                'class'=>'w-full h-[5vh] bg-slate-700 flex items-center',
                'body'=>[
                    $button->create([
                        'id'=>'submit_form_btn',
                        'class'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300 mx-4',
                        'body'=>'submit'
                    ]),
                    $button->create([
                        'id'=>'close_form_btn',
                        'class'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300',
                        'body'=>'cancel'
                    ]),
                ]
            ])
            
        ]
    ])."
    ".$nav->create([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>nav($nav_array)
    ])."
    ".$header->create([
        'class'=>'fixed px-2 top-[5vh] flex flex-col bg-slate-700 w-screen h-[18vh]',
        'body'=>[
            $title->create([
                'class'=>'text-2xl underline w-full capitalize font-bold text-slate-200',
                'body'=>'Detail Form'
            ]),
            Comp::input([
                'id'=>'input__alat_search',
                'list'=>'alat_list',
                'placeholder'=>'input alat disini',
                'autocomplete'=>'off',
                'require'=>'',
                'class'=>'rounded hidden px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 fixed top-[6vh] z-30 duration-300 right-10 shadow-md w-[40vw]'
            ]),
            $div->create([
                'class'=>'flex flex-row w-full h-full justify-center items-center',
                'body'=>create_formset($detail_form)
            ]),
            $button->create([
                'id'=>'open_dtlist',
                'class'=>'fixed z-20 right-2 top-[6vh] w-6 h-6 rounded bg-transparent open_white'
            ]),
            $button->create([
                'id'=>'new__data',
                'disable'=>'',
                'class'=>'fixed z-20 right-2 top-[10vh] w-6 h-6 rounded bg-transparent opacity-50 plus'
            ])
        ]
    ])."
    ".$main->create([
        'class'=>'fixed flex flex-col top-[23vh] bg-slate-300 w-screen h-[72vh] scrollable-y',
        'body'=>[
            table_create($main_table),
            table_create($template_new)
        ]
    ])."
    ".$footer->create([
        'class'=>'fixed flex flex-row bottom-0 bg-slate-700 w-screen h-[5vh]',
        'body'=>pagination_create('main_page', '')
    ])."
    <script type='module' src='./client_process/index.js';></script>
    ";

createHTML([
    'body'=>$index, 
    'name'=>'index', 
    'title'=>"VJS Alat ukur",
    'path'=>'vjs_alat_ukur'
]);

