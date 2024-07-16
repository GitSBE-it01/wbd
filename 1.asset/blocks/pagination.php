<?php

function pagination($id, $class) {
    $cls_use = 'flex flex-row m-2 items-center justify-center';
        if($class !== '') {
            $cls_use = $class;
        }
    $full = "
    <div id='".$id."' class='".$cls_use."'>
        <button type='button' data-group='".$id."' data-page='1' data-id='1' class='hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 justify-center items-center duration-300 flex text-white font-bold bg-blue-700'>
            1
        </button>
        <button type='button' data-group='".$id."' data-page='2' data-id='2' class='hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 bg-slate-200 justify-center items-center duration-300 flex'>
            2
        </button>
        <button type='button' data-group='".$id."' data-page='3' data-id='3' class='hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 bg-slate-200 justify-center items-center duration-300 flex'>
            3
        </button>
        <button type='button' data-group='".$id."' data-page='4' data-id='4' class='hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 bg-slate-200 justify-center items-center duration-300 flex'>
            4
        </button>
        <button type='button' data-group='".$id."' data-page='5' data-id='5' class='hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 bg-slate-200 justify-center items-center duration-300 flex'>
            5
        </button>
        <button type='button' data-group='".$id."' data-page='6' data-id='6' class='hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 bg-slate-200 justify-center items-center duration-300 flex'>
            6
        </button>
        <button type='button' data-group='".$id."' data-page='7' data-id='7' class='hover:font-bold hidden hover:bg-blue-700 hover:text-white hover:border-black border-2 cursor-pointer border-slate-400 p-1 w-8 h-8 bg-slate-200 justify-center items-center duration-300 flex'>
            7
        </button>
    </div>";
    return $full;
}

/*
hover:font-bold hidden text-white hover:border-black border-2 cursor-pointer border-black font-bold p-1 w-8 h-8 bg-blue-700 justify-center items-center duration-300 flex
*/