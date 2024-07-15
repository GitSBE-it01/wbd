<?php 
require_once '../../1.asset/index.php';
require_once 'jig_db_table.php';
require_once 'nav.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$index = "
    <div data-card='hidden_table' class='px-4 z-30 block hidden shadow-lg shadow-slate-800 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400 custom_scroll'>
        <div data-title='title_switch' class='text-2xl w-full pt-2 h-[5vh] bg-slate-400 sticky z-20 top-0 font-bold'>
            Lokasi
        </div>
        ".table($loc_table).table($use_table)."
    </div>
    <div class='loading z-40'></div>
    <nav class='fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]'>
        ".nav($nav_array)."
    </nav>"
    /*header*/."
    <header class='fixed px-2 top-[5vh] bg-slate-700 w-screen h-[5vh] flex flex-row gap-2'>
        ".$search_bar.$btn_search.$btn_submit_form2."
    </header>"
    /*main*/."
    <main class='fixed flex flex-row top-[10vh] bg-slate-300 w-full h-[85vh] custom_scroll'>
        <div id='mainTable' class='w-full h-full scrollable'>
            ".table($jig_table)."
        </div>
    </main>"
    /*main*/."
    <footer class='fixed bottom-0 bg-slate-500 w-screen h-[5vh]'>
        ".pagination()."
    </footer>
    <script type='module' src='./client_process/index.js';></script>
    ";

createHTML(['body'=>$index, 'name'=>'index', 'title'=>"Jig Database"]);

