<?php 
require_once '../../index.php';
require_once 'utils/jig_db_table.php';
require_once 'utils/nav.php';

/* ===============================================================================
UPDATE HTML
=============================================================================== */

$update = $datalist->create(['id'=>'jig_list'])
    .$datalist->create(['id'=>'spk_list'])
    .$datalist->create(['id'=>'loc_list'])
    .$load
    .$nav->create([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>nav($nav_array)
    ])
    .$header->create([
        'class'=>'fixed top-[5vh] bg-slate-700 w-screen h-[10vh]',
        'body'=>[
            $div->create([
                'class'=>'flex flex-row w-full h-[5vh] justify-center items-center',
                'body'=>[
                    $div->create([
                        'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold bg-blue-700 text-xl font-bold',
                        'data_attr'=>['switch::stock'],
                        'body'=>'Update Stock'
                    ]),
                    $div->create([
                        'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold',
                        'data_attr'=>['switch::detail'],
                        'body'=>'Update Detail'
                    ]),
                    $div->create([
                        'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold',
                        'data_attr'=>['switch::use'],
                        'body'=>'Update Usage'
                    ]),
                ]
            ]),
            $div->create([
                'class'=>'flex flex-row w-full h-[5vh] bg-slate-500',
                'body'=>[
                    $search_bar->create([
                        'data_attr'=>['search::stock_div'],
                        'class'=>'w-full h-[5vh] flex flex-row pl-4 gap-2',
                        'body'=>[
                            $input_text->create(['id'=>'stock_search', 'list'=>'jig_list']),
                            $button->create(['id'=>'stock_btn', 'body'=>'search'])
                        ]
                    ]),
                    $search_bar->create([
                        'data_attr'=>['search::detail_div'],
                        'class'=>'w-full h-[5vh] flex flex-row pl-4 gap-2 hidden',
                        'body'=>[
                            $input_text->create(['id'=>'detail_search', 'list'=>'jig_list']),
                            $button->create(['id'=>'detail_btn','body'=>'search'])
                        ]
                    ]),
                    $search_bar->create([
                        'data_attr'=>['search::usage_div'],
                        'class'=>'w-full h-[5vh] flex flex-row pl-4 gap-2 hidden',
                        'body'=>[
                            $input_text->create(['id'=>'usage_search', 'list'=>'spk_list']),
                            $button->create(['id'=>'usage_btn','body'=>'search'])
                        ]
                    ]),
                ]
            ]),
        ]
    ])
    .$main->create([
        'class'=>'fixed flex flex-col top-[15vh] bg-slate-300 w-screen h-[85vh] custom_scroll',
        'body'=>[
            $div->create([
                'class'=>'h-full w-full',
                'body'=> [
                    $div->create([
                        'class'=>'w-full h-[40vh] scrollable',
                        'body'=>[
                            table_create($stock_table_new),
                            $div->create([
                                'class'=>'w-full h-[5vh] block bg-slate-500 fixed bottom-[45vh] z-20',
                                'body'=>pagination_create('stock_page', '')
                            ])
                        ]
                    ]),
                    $div->create([
                        'class'=>'w-full h-[45vh] scrollable',
                        'body'=>[
                            table_create($history_table_new),
                            $div->create([
                                'class'=>'w-full h-[5vh] block bg-slate-500 fixed bottom-[0%] z-20',
                                'body'=>pagination_create('hist_page', '')
                            ])
                        ]
                    ]),
                ]
            ]),
            $div->create([
                'class'=>'h-full w-full hidden',
                'body'=> [
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
    'path'=>'jig_db_new3'
]);
