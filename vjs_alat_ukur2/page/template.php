<?php 
require_once '../../1.asset/index.php';
require_once 'index_temp.php';

// create index.html
$nav_array = [
    'title'=>'template',
    'links'=>[
        ['href'=> 'index.html', 'text'=> 'Home'],
        ['href'=> 'tool_data.html', 'text'=> 'Tool Data'],
        ['href'=> 'point.html', 'text'=> 'Checklist'],
    ]
];

$index = "
    <div data-card='form' class='p-4 z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400'>
        <h2 class='text-xl font-semibold'>Detail Form</h2>
        <div id='formTable' class ='w-full h-full scorllable'>
            ".table($main_form_tbl)."
        </div>
    </div>
    <div class='loading z-40'></div>
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