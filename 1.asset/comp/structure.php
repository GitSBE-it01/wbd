<?php
$div = new Component([
    'element'=>'div',
]);

$load = $div->create(['class'=>'loading z-40']);
$load2 = $div->create([
    'id'=>'load',
    'class'=>'w-screen h-screen absolute z-40 flex justify-center items-center',
    'body'=>[
        $div->create([
            'class'=>'h-full w-full opacity-75 absolute bg-slate-400'
        ]),
        $div->create([
            'class'=>'loading2'
        ]),
    ]
]);

$nav = new Component([
    'element'=>'nav',
    'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
]);

$header = new Component([
    'element'=>'header',
    'class'=>'fixed top-[5vh] bg-slate-700 w-screen h-[5vh]'
]);

$main = new Component([
    'element'=>'main',
    'class'=>'fixed flex flex-col top-[10vh] bg-slate-300 w-screen h-[85vh] custom_scroll'
]);

$aside = new Component([
    'element'=>'aside',
    'class'=>'fixed flex flex-row top-[10vh] left-0 bg-teal-700 w-[25vw] h-[85vh]'
]);

$footer = new Component([
    'element'=>'footer',
    'class'=>'fixed bottom-0 bg-slate-500 w-screen h-[5vh]'
]);