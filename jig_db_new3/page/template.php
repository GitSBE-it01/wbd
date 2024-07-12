<?php 
require_once '../../1.asset/index.php';
require_once 'jig_db_table.php';
require_once 'nav.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$index = "
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

