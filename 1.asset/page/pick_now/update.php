<?php 
require_once '../../index.php';
require_once 'utils/jig_db_table.php';
require_once 'utils/nav.php';
require_once 'utils/form.php';
require_once 'utils/table.php';

/* ===============================================================================
UPDATE HTML
=============================================================================== */
$nav_array_new['title'] = 'Update Jig Data';
$update = Comp::dtlist(['id'=>'jig_list'])
    .Comp::dtlist(['id'=>'spk_list'])
    .Comp::dtlist(['id'=>'loc_list'])
    .$load2
    .Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>navi($nav_array_new)
    ])."
    ".Comp::header([
        'class'=>'fixed top-[5vh] flex flex-col w-screen h-[10vh]',
        'body'=>[
            Comp::div([
                'class'=>'flex flex-row h-[5vh] w-full bg-blue-700 items-center',
                'body'=>[
                    Comp::div([
                        'id'=>'stock_switch',
                        'class'=>'flex flex-1 cursor-pointer hover:bg-blue-600 justify-center items-center h-[5vh] items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-600 text-xl font-bold',
                        'body'=>'Detail Stock'
                    ]),
                    Comp::div([
                        'id'=>'detail_switch',
                        'class'=>'flex flex-1 cursor-pointer hover:bg-blue-600 justify-center items-center h-[5vh] items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 ',
                        'body'=>'Detail Jig'
                    ]),
                    Comp::div([
                        'id'=>'type_switch',
                        'class'=>'flex flex-1 cursor-pointer hover:bg-blue-600 justify-center items-center h-[5vh] items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 ',
                        'body'=>'Detail Speaker Usage Jig'
                    ]),
                ]
            ]),
            Comp::div([
                'class'=>'gap-4 p-2 h-[5vh] w-full bg-slate-700 items-center',
                'body'=>[
                    Comp::div([
                        'id'=>'stock_div_search',
                        'class'=>'flex flex-row gap-4 h-full w-full items-center',
                        'body'=>[
                            Comp::input([
                                'id'=>'input__stock',
                                'placeholder'=>'input jig disini',
                                'autocomplete'=>'off',
                                'list'=>'jig_list',
                                'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[40vw]'
                            ]),
                            Comp::button([
                                'id'=>'search_stock',
                                'body'=>'search',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-blue-200 duration-300'
                            ]),
                            Comp::button([
                                'id'=>'submit_stock',
                                'body'=>'submit',
                                'disable'=>'',
                                'class'=>'rounded text-slate-200 bg-gray-300 w-[10vw] text-sm border-2 hover:bg-blue-200 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ]),
                            Comp::button([
                                'id'=>'add_new_stock',
                                'body'=>'add new',
                                'class'=>'rounded bg-gray-300 hover:bg-blue-200 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300'
                            ]),
                        ]
                    ]),
                    Comp::div([
                        'id'=>'detail_div_search',
                        'class'=>'flex flex-row gap-4 h-full hidden w-full items-center',
                        'body'=>[
                            Comp::input([
                                'id'=>'input__detail',
                                'placeholder'=>'input jig disini',
                                'autocomplete'=>'off',
                                'list'=>'jig_list',
                                'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[40vw]'
                            ]),
                            Comp::button([
                                'id'=>'search_detail',
                                'body'=>'search',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                            ]),
                            Comp::button([
                                'id'=>'submit_detail',
                                'body'=>'submit',
                                'disable'=>'',
                                'class'=>'rounded text-slate-200 bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                            ]),
                            Comp::button([
                                'id'=>'edit_detail',
                                'body'=>'edit',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                            ]),
                        ]
                    ]),
                    Comp::div([
                        'id'=>'type_div_search',
                        'class'=>'flex flex-row gap-4 h-full w-full items-center hidden',
                        'body'=>[
                            Comp::select([
                                'id'=>'select__type',
                                'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[10vw]',
                                'body'=>[
                                    Comp::option([
                                        'value'=>'Speaker',
                                        'body'=>'Speaker'
                                    ]),
                                    Comp::option([
                                        'value'=>'Jig',
                                        'body'=>'Jig'
                                    ])
                                ]
                            ]),
                            Comp::input([
                                'id'=>'input__type',
                                'placeholder'=>'input type disini',
                                'autocomplete'=>'off',
                                'list'=>'spk_list',
                                'class'=>'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 duration-300 right-10 shadow-md w-[30vw]'
                            ]),
                            Comp::button([
                                'id'=>'search_type',
                                'body'=>'search',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                            ]),
                            Comp::button([
                                'id'=>'submit_type',
                                'body'=>'submit',
                                'disable'=>'',
                                'class'=>'rounded text-slate-200 bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                            ]),
                            Comp::button([
                                'id'=>'add_new_type',
                                'body'=>'add new',
                                'class'=>'rounded bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                            ]),
                            Comp::button([
                                'id'=>'del_type',
                                'body'=>'delete',
                                'disable'=>'',
                                'class'=>'rounded text-slate-200 bg-gray-300 w-[10vw] text-sm border-2 border-slate-400 shadow-md hover:font-semibold duration-300 hover:bg-blue-200'
                            ]),
                        ]
                    ])
                ]
            ])
        ]
    ])."
    ".Comp::main([
        'class'=>'fixed flex flex-col top-[15vh] bg-slate-300 w-screen h-[85vh] custom_scroll',
        'body'=>[
            Comp::div([
                'id'=>'stock_div',
                'class'=>'h-full w-full',
                'body'=> [
                    Comp::div([
                        'class'=>'w-full h-[40vh] scrollable',
                        'body'=>[
                            table_create($stock_table),
                            table_create($stock_table_new),
                            Comp::div([
                                'class'=>'w-full h-[5vh] block bg-slate-500 fixed bottom-[45vh] z-20',
                                'body'=>pagination_create('stock_page', '')
                            ])
                        ]
                    ]),
                    Comp::div([
                        'class'=>'w-full h-[45vh] scrollable',
                        'body'=>[
                            table_create($stock_table_hist),
                            Comp::div([
                                'class'=>'w-full h-[5vh] block bg-slate-500 fixed bottom-[0%] z-20',
                                'body'=>pagination_create('stock_hist_page', '')
                            ])
                        ]
                    ]),
                ]
            ]),
            Comp::div([
                'id'=>'detail_div',
                'class'=>'h-full w-full hidden',
                'body'=> [
                    Comp::div([
                        'class'=>'w-full h-[40vh] scrollable',
                        'body'=>create_formset($detail_form)
                    ]),
                    Comp::div([
                        'class'=>'w-full h-[45vh] scrollable',
                        'body'=>[
                            table_create($dtl_new_hist),
                            Comp::div([
                                'class'=>'w-full h-[5vh] block bg-slate-500 fixed bottom-[0%] z-20',
                                'body'=>pagination_create('detail_hist_page', '')
                            ])
                        ]
                    ]),
                ]
            ]),
            Comp::div([
                'id'=>'type_div',
                'class'=>'h-full w-full hidden',
                'body'=> [
                    Comp::div([
                        'class'=>'w-full h-[40vh]',
                        'body'=>[
                            Comp::div([
                                'class'=>'w-full h-[35vh] z-20 scrollable',
                                'body'=>[
                                    table_create($type_table_upd),
                                    table_create($type_table_new),
                                ]
                            ]),
                            Comp::div([
                                'class'=>'w-full h-[5vh] block bg-slate-500 fixed bottom-[45vh] z-20',
                                'body'=>pagination_create('type_page', '')
                            ])
                        ]
                    ]),
                    Comp::div([
                        'class'=>'w-full h-[45vh] ',
                        'body'=>[
                            Comp::div([
                                'class'=>'w-full h-[40vh] z-20 scrollable',
                                'body'=>[
                                    table_create($type_table_hist),
                                ]
                            ]),
                            Comp::div([
                                'class'=>'w-full h-[5vh] block bg-slate-500 fixed bottom-[0%] z-20',
                                'body'=>pagination_create('type_hist_page', '')
                            ])
                        ]
                    ]),
                ]
            ]),

        ]
    ])
."<script type='module' src='./client_process/update.js';></script>
    ";

createHTML([
    'body'=>$update, 
    'name'=>'update', 
    'title'=>"Update Data Jig",
    'path'=>'jig_db_new'
]);

