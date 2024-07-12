<?php

function pagination() {
    $full = "
    <div id='page' class='flex flex-row m-2 items-center justify-center'>
        <div data-page='1' class='hover:font-semibold hover:h-8 hidden hover:border-black border-2 cursor-pointer border-black font-semibold p-1 w-30 h-8 bg-slate-200 justify-center items-center duration-300 flex'>
            1
        </div>
        <div data-page='2' class='hover:font-semibold hover:w-8 hover:h-8 hidden hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center duration-300 flex'>
            2
        </div>
        <div data-page='3' class='hover:font-semibold hover:w-8 hover:h-8 hidden hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center duration-300 flex'>
            3
        </div>
        <div data-page='4' class='hover:font-semibold hover:w-8 hover:h-8 hidden hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center duration-300 flex'>
            4
        </div>
        <div data-page='5' class='hover:font-semibold hover:w-8 hover:h-8 hidden hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center duration-300 flex'>
            5
        </div>
        <div data-page='6' class='hover:font-semibold hover:w-8 hover:h-8 hidden hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-6 h-6 bg-slate-200 justify-center items-center duration-300 flex'>
            6
        </div>
        <div data-page='7' class='hover:font-semibold hover:h-8 hidden hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-30 h-6 bg-slate-200 justify-center items-center duration-300 flex'>
            7
        </div>
    </div>";
    return $full;
}