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
    .Comp::dtlist(['id'=>'jig_list'])
    .Comp::dtlist(['id'=>'users'])
    .Comp::dtlist(['id'=>'jig_type_list'])
    .$load2."
    ".Comp::nav([
        'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
        'body'=>navi($nav_array_new)
    ])."
    ".Comp::aside([
        'class'=>'fixed top-[5vh] w-[20vw] bg-blue-800 h-[95vh]',
        'body'=>[
            Comp::div([
                'id'=>'jig_switch',
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[10vh] w-full text-white items-center duration-300 hover:text-xl hover:font-bold bg-blue-600 text-xl font-bold',
                'body'=>'New Jig'
            ]),
            Comp::div([
                'id'=>'speaker_switch',
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[10vh] w-full text-white items-center duration-300 hover:text-xl hover:font-bold bg-blue-800 ',
                'body'=>'New Speaker'
            ]),
            Comp::div([
                'id'=>'loc_switch',
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[10vh] w-full text-white items-center duration-300 hover:text-xl hover:font-bold bg-blue-800 ',
                'body'=>'New Location'
            ]),
            Comp::div([
                'id'=>'type_jig_switch',
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[10vh] w-full text-white items-center duration-300 hover:text-xl hover:font-bold bg-blue-800 ',
                'body'=>'New Jig Type'
            ]),
            Comp::div([
                'id'=>'user_switch',
                'data_attr'=>['role::super'],
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-[10vh] w-full text-white items-center duration-300 hover:text-xl hover:font-bold bg-blue-800 ',
                'body'=>'User'
            ]),
        ]
    ])."
    ".Comp::main([
        'class'=>'fixed flex flex-col top-[5vh] right-0 bg-slate-300 w-[80vw] h-[90vh] scrollable-y',
        'body'=>[
            Comp::div([
                'id'=>'jig_add',
                'class'=>'w-full h-full flex flex-col scrollable-y',
                'body'=>[
                    Comp::title([
                        'class'=>'text-4xl font-bold underline my-4',
                        'body'=>'Add New Jig'
                    ]),
                    create_formset($add_jig_form),
                    Comp::title([
                        'class'=>'text-xl font-semibold m-2',
                        'body'=>'Detail Lokasi Jig'
                    ]),
                    create_formset($add_jig_loc_form),
                    table_create($new_loc_jig_form),
                    table_create($new_temp_loc_jig_form),
                    Comp::button([
                        'id'=>'add_loc_row',
                        'class'=>'border-2 bg-gray-400 hover:bg-blue-700 active:bg-blue-500 hover:text-white hover:font-bold hover:text-lg rounded broder-slate-300 duration-300',
                        'body'=>'add new location'
                    ]),
                    Comp::title([
                        'class'=>'text-xl font-semibold m-2',
                        'body'=>'Detail Penggunaan Jig'
                    ]),
                    table_create($new_type_jig_form),
                    table_create($new_temp_type_jig_form),
                    Comp::button([
                        'id'=>'add_type_row',
                        'class'=>'border-2 bg-gray-400 hover:bg-blue-700 active:bg-blue-500 hover:text-white hover:font-bold hover:text-lg rounded broder-slate-300 duration-300',
                        'body'=>'add new speaker'
                    ]),
                ]
            ]),
            Comp::div([
                'id'=>'speaker_add',
                'class'=>'w-full h-full hidden flex flex-col',
                'body'=>[
                    Comp::title([
                        'class'=>'text-4xl font-bold underline my-4',
                        'body'=>'Add New Speaker'
                    ]),
                    create_formset($add_speaker_jig_form),
                    table_create($add_speaker_type_jig_form),
                    table_create($add_new_speaker_type_jig_form),
                    Comp::button([
                        'id'=>'add_jig_row',
                        'class'=>'border-2 bg-gray-400 hover:bg-blue-700 active:bg-blue-500 hover:text-white hover:font-bold hover:text-lg rounded broder-slate-300 duration-300',
                        'body'=>'add new Jig'
                    ]),
                ]
            ]),
            Comp::div([
                'id'=>'loc_add',
                'class'=>'w-full h-full hidden flex flex-col',
                'body'=>[
                    Comp::title([
                        'class'=>'text-4xl font-bold underline my-4',
                        'body'=>'Add New Location'
                    ]),
                    create_formset($add_location_form)
                ]
            ]),
            Comp::div([
                'id'=>'type_jig_add',
                'class'=>'w-full h-full hidden flex flex-col',
                'body'=>[
                    Comp::title([
                        'class'=>'text-4xl font-bold underline my-4',
                        'body'=>'Add New Jig Type'
                    ]),
                    create_formset($add_jig_type_form)
                ]
            ]),
            Comp::div([
                'id'=>'user_add',
                'data_attr'=>['role::super'],
                'class'=>'w-full h-full hidden flex flex-col',
                'body'=>[
                    Comp::title([
                        'class'=>'text-4xl font-bold underline my-4',
                        'body'=>'User Role'
                    ]),
                    Comp::input([
                        'type_attr'=>'hidden',
                        'name'=>'apps'
                    ]),
                    create_formset($user_role)
                ]
            ]),
        ]
    ])."
    ".Comp::footer([
        'class'=>'fixed bottom-0 right-0 bg-slate-700 w-[80vw] h-[5vh] flex items-center',
        'body'=>[
            Comp::button([
                'id'=>'submit_button',
                'data_attr'=>['method::jig_submit'],
                'class'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300 mx-4',
                'body'=>'submit'
            ]),
        ]
    ])."
    <script type='module' src='./client_process/add.js';></script>
    ";

createHTML([
'body'=>$add, 
'name'=>'add_new', 
'title'=>"Reference",
'path'=>'jig_db_new'
]);



