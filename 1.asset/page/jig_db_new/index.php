<?php 
require_once '../../index.php';
require_once 'utils/jig_db_table.php';
require_once 'utils/nav.php';

/* ===============================================================================
INDEX HTML
=============================================================================== */
$index = "
    <div class='loading z-40'></div>
    <div data-card='hidden_table' class='w-screen h-screen fixed top-0 hidden transparent-slate-200 z-30'>
    <button type='button' data-id='close__detail' data-method='close' class='cross_gray rounded-full block bg-white h-8 w-8  fixed top-[16vh] right-[16vw]'></button>
        <div class='shadow-lg shadow-slate-800 z-30 rounded fixed w-[60vw] h-[60vh] mx-[20vw] my-[20vh] bg-slate-400 custom_scroll flex flex-col'>
            <div data-title='title_switch' class='flex flex-row w-full'>
                <div data-switch='lokasi' class='flex duration-300 justify-center items-center font-bold text-2xl sticky top-0 z-20 h-[5vh] w-[50%] border-black border-2 hover:bg-slate-950 cursor-pointer hover:text-white bg-slate-950 text-white'>Lokasi</div>
                <div data-switch='tipe' class='flex duration-300 justify-center items-center hover:font-bold text-lg sticky top-0 z-20 cursor-pointer h-[5vh] w-[50%] border-black border-2 hover:bg-slate-950 hover:text-2xl hover:text-white'>Tipe Speaker</div>
            </div>
            <div class='w-full h-[55vh] scrollable'>
            ".table($loc_table).table($use_table)."
            </div>
            <div class='w-full h-[5vh] z-40 bottom-[0%] bg-slate-500 pt-2'>
                ".pagination('loc_page',"flex flex-row items-center justify-center").pagination('use_page', "flex flex-row items-center justify-center hidden")."
            </div>
        </div>
    </div>
    <nav class='fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]'>
        ".nav($nav_array)."
    </nav>"
    /*header*/."
    <header class='fixed px-2 top-[5vh] bg-slate-700 w-screen h-[5vh] flex flex-row gap-2'>
        ".$search_bar_dflt.$btn_search.$btn_submit_form2."
    </header>"
    /*main*/."
    <main class='fixed flex flex-row top-[10vh] bg-slate-300 w-full h-[85vh] custom_scroll'>
        <div id='mainTable' class='w-full h-full scrollable'>
            ".table($jig_table)."
        </div>
    </main>"
    /*main*/."
    <footer class='fixed bottom-0 bg-slate-500 w-screen h-[5vh]'>
        ".pagination('main_page','')."
    </footer>
    <script type='module' src='./client_process/index.js';></script>
    ";

createHTML(['body'=>$index, 'name'=>'index', 'title'=>"Jig Database"]);
