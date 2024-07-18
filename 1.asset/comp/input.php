<?php
$input_text = new Component([
    'element'=> 'input',
    'type_attr'=> 'text',
    'placeholder'=> 'input text here',
    'class'=> 'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 z-30 shadow-md w-[40vw] my-3',
    'end'=>''
]);

$input_hidden = new Component([
    'element'=> 'input',
    'type_attr'=> 'hidden',
    'end'=>''
]);

$search_bar = new Component([
    'element'=> 'div',
    'class'=> 'w-full h-[5vh] flex flex-row gap-2 bg-slate-950',
    'body'=>[
        $input_text->create([]),
        $button->create(['body'=>'search'])
    ]
]);

$label = new Component([
    'element'=>'label',
])