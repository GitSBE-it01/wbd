<?php 
require_once '../../1.asset/index.php';
require_once './js_template.php';

// create index.html
$index = '
    <nav class="fixed flex flex-row top-0 items-center bg-slate-950 w-screen h-[5vh]">'
        .nav([
            'title'=>'template',
            'links'=>[
                ['text'=>'test1', 'href'=>'#section1'],
                ['text'=>'test2', 'href'=>'#section2'],
            ]
        ]) 
    .'</nav>'
    // header
    .'<header class="fixed flex flex-row top-[5vh] bg-slate-700 w-screen h-[5vh]">'
        .'<div>
            testing 123
        </div>'
    .'</header>'
    // aside
    .'<aside class="fixed flex flex-row top-[10vh] left-0 bg-teal-700 w-[25vw] h-[90vh]">'
        .'<div>
            testing 123
        </div>'
    .'</aside>'
    // main
    .'<main class="fixed flex flex-row top-[10vh] bg-slate-300 w-[75vw] h-[90vh] right-0">'
        .'<div>
            testing 123
        </div>'
    .'</main>'
    //footer
    .'<footer class="fixed flex flex-row bottom-0 bg-slate-300 w-screen h-[5vh]">'
    .'</footer>'
    .$init_js
    .'</script>';

createHTML(['body'=>$index, 'name'=>'index', 'title'=>'template']);