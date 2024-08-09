<?php
// create index.html
$nav_array2 = [
    'title'=>'New Type Report',
    'links'=>[
        ['href'=> 'index.html', 'text'=> 'Home'],
    ]
];

$nav_array = [
    'ul'=> [
        'class'=>'w-full h-full flex flex-row'
    ],
    'links'=>[
        [
            'link'=>[
                'href'=> 'index.html', 
                'body'=> 'Home'
            ]
        ],
        [
            'link'=>[
                'href'=> 'input.html', 
                'body'=> 'Input'
            ]
        ],
    ]
];