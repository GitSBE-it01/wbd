<?php 
require_once '../../1.asset/index.php';
require_once 'index_temp.php';
require_once 'tool.php';
require_once 'point.php';
require_once 'nav.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$index = "
    <datalist id='alat_list'>
    </datalist>
    <div data-card='form' class='px-4 z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400 custom_scroll'>
        <div data-title='form_title' class='text-2xl w-full pt-2 h-[5vh] bg-slate-400 sticky z-20 top-0 font-bold'>
            VJS Detail 
        </div>
        <form id='submit_form' class='scrollable h-[50vh] mb-2 border-2 border-black'>
        ".table($main_formset)."
        </form>"
        .$btn_submit_form.$btn_close_form."
    </div>
    <div class='loading z-40'></div>
    <nav class='fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]'>
        ".nav($nav_array)."
    </nav>"
    /*header*/."
    <header class='fixed px-2 top-[5vh] bg-slate-700 w-screen h-[18vh]'>
        ".formset($header_form).$alat_search.$btn_open.$btn_new."
    </header>"
    /*main*/."
    <main class='fixed flex flex-row top-[23vh] bg-slate-300 w-full h-[72vh] custom_scroll'>
        <div id='mainTable' class='w-full h-full scrollable'>
            ".table($main_table)."
        </div>
    </main>"
    /*main*/."
    <footer class='fixed flex flex-row bottom-0 bg-slate-300 w-screen h-[5vh]'>
    </footer>
    <script type='module' src='./client_process/index.js';></script>
    ";

createHTML(['body'=>$index, 'name'=>'index', 'title'=>"vjs alat ukur"]);


/* ===============================================================================
TOOL DATA HTML
=============================================================================== */
$tool_data = "
    <div class='loading z-40'></div>
    <nav class='fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]'>
        ".nav($nav_array)."
    </nav>"
    /*header*/."
    <header class='fixed px-2 top-[5vh] bg-slate-700 w-screen h-[5vh] flex flex-row gap-2'>
        ".$tool_search.$btn_search.$btn_submit_form2.$btn_new2."
    </header>"
    /*main*/."
    <main class='fixed flex flex-row top-[10vh] bg-slate-300 w-full h-[85vh] custom_scroll'>
        <div id='mainTable' class='w-full h-full scrollable'>
            ".table($tool_table)."
        </div>
    </main>"
    /*main*/."
    <footer class='fixed bottom-0 bg-slate-500 w-screen h-[5vh]'>
        <div id='page' class='flex flex-row m-2 items-center justify-center'>
            <div class='border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center flex'><</div>
            <div class='border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center flex'>1</div>
            <div class='border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center flex'>2</div>
            <div class='border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center flex'>></div>
        </div>
    </footer>
    <script type='module' src='./client_process/tool_data.js';></script>
    ";

createHTML(['body'=>$tool_data, 'name'=>'tool_data', 'title'=>"detail tools"]);


/* ===============================================================================
POINT HTML
=============================================================================== */
$point = "
    <div class='loading z-40'></div>
    <nav class='fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]'>
        ".nav($nav_array)."
    </nav>"
    /*header*/."
    <header class='fixed px-2 top-[5vh] bg-slate-700 w-screen h-[5vh] flex flex-row gap-2'>
        ".$point_search.$btn_search.$btn_submit_form2.$btn_new2."
    </header>"
    /*main*/."
    <main class='fixed flex flex-row top-[10vh] bg-slate-300 w-full h-[85vh] custom_scroll'>
        <div id='mainTable' class='w-full h-full scrollable'>
            ".table($point_table)."
        </div>
    </main>"
    /*main*/."
    <footer class='fixed flex flex-row bottom-0 bg-slate-300 w-screen h-[5vh]'>
    </footer>
    <script type='module' src='./client_process/point.js';></script>
    ";

createHTML(['body'=>$point, 'name'=>'point', 'title'=>"detail point VJS"]);