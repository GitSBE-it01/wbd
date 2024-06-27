<?php 
require_once '../../1.asset/index.php';
require_once 'index_temp.php';

// create index.html
$nav_array = [
    'title'=>'template',
    'links'=>[
        ['text'=>'test1', 'href'=>'#section1'],
        ['text'=>'test2', 'href'=>'#section2'],
    ]
];

$index = "
    <div class='loading'></div>
    <nav class='fixed flex flex-row top-0 items-center bg-slate-950 w-screen h-[5vh]'>
        ".nav($nav_array)."
    </nav>"
    /*header*/."

    <header class='fixed flex flex-col px-2 top-[5vh] bg-slate-700 w-screen h-[18vh]'>
        ".$text.$btnOpen."
    </header>"
    /*main*/."

    <main class='fixed flex flex-row top-[23vh] bg-slate-300 w-full h-[72vh] custom_scroll'>
        <div id='mainTable' class='w-full h-full scrollable'>
            ".table($mainTable)."
        </div>
    </main>"
    /*main*/."

    <footer class='fixed flex flex-row bottom-0 bg-slate-300 w-screen h-[5vh]'>
    </footer>
    <script type='module' src='./client_process/index.js';></script>
    ";

createHTML(['body'=>$index, 'name'=>'index', 'title'=>"vjs alat ukur"]);