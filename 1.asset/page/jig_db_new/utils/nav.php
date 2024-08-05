<?php
// create index.html
$nav_array = [
    'links'=>[
        ['href'=> 'index.html', 'text'=> 'Home'],
        ['href'=> 'update.html', 'text'=> 'Update Data', 'data_attr'=>['role::admin']],
        ['href'=> 'trans.html', 'text'=> 'Transaction'],
        ['href'=> 'usage.html', 'text'=> 'Usage', 'data_attr'=>['role::admin']],
        ['href'=> 'add_new.html', 'text'=> 'Add New','data_attr'=>['role::admin'] ],
        ['href'=> 'user.html', 'text'=> 'User', 'data_attr'=>['role::super']],
    ]
];

$nav_array_new = [
    'links'=>[
        [
            'li'=>[
                'class'=>'h-full w-[10vw] justify-center items-center flex',
            ],
            'link'=>['href'=> 'index.html', 'body'=> 'Home']
        ],
        [
            'li'=>[
                'data_attr'=>['role::admin'],
                'class'=>'h-full w-[10vw] justify-center items-center flex',
            ],
            'link'=>['href'=> 'update.html', 'body'=> 'Update Data', 'data_attr'=>['role::admin']]
        ],
        [
            'li'=>[
                'class'=>'h-full w-[10vw] justify-center items-center flex',
            ],
            'link'=>['href'=> 'trans.html', 'body'=> 'Transaction']
        ],
        [
            'li'=>[
                'data_attr'=>['role::admin'],
                'class'=>'h-full w-[10vw] justify-center items-center flex',
            ],
            'link'=>['href'=> 'usage.html', 'body'=> 'Usage']
        ],
        [
            'li'=>[
                'data_attr'=>['role::admin'],
                'class'=>'h-full w-[10vw] justify-center items-center flex',
            ],
            'link'=>['href'=> 'add_new.html', 'body'=> 'Add New'] 
        ],
        [
            'li'=>[
                'data_attr'=>['role::user'],
                'class'=>'h-full w-[10vw] justify-center items-center flex',
            ],
            'link'=>['href'=> 'user.html', 'body'=> 'User']
        ],
    ]
];

$side_bar_data = [
    'ul'=> [
        'id'=>'sidebar',
        'class'=>'w-full h-full flex flex-col'
    ],
    'links'=>[
        [
            'li'=>[
                'class'=>'h-[10vh] w-full justify-center items-center flex',
            ],
            'link'=>[
                'href'=> '#jig_add', 
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-full w-full items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-600 text-xl font-bold',
                'body'=> 'New Jig'
            ]
        ],
        [
            'li'=>[
                'class'=>'h-[10vh] w-full justify-center items-center flex',
            ],
            'link'=>[
                'href'=> '#speaker_add', 
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-full w-full items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 ',
                'body'=> 'New Speaker'
            ]
        ],
        [
            'li'=>[
                'class'=>'h-[10vh] w-full justify-center items-center flex',
            ],
            'link'=>[
                'href'=> '#loc_add', 
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-full w-full items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 ',
                'body'=> 'New Location'
            ]
        ],
        [
            'li'=>[
                'class'=>'h-[10vh] w-full justify-center items-center flex',
            ],
            'link'=>[
                'href'=> '#type_jig_add', 
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-full w-full items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 ',
                'body'=> 'New Jig Type'
            ]
        ],
        [
            'li'=>[
                'data_attr'=>['role::super'],
                'class'=>'h-[10vh] w-full justify-center items-center flex',
            ],
            'link'=>[
                'href'=> '#user_add', 
                'class'=>'flex cursor-pointer hover:bg-blue-600 justify-center items-center h-full w-full items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800 ',
                'body'=> 'User'
            ]
        ],
    ]
];