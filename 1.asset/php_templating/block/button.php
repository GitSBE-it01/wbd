<?php
function createBtn($btnArr) {
    $init ='<button ';
    if($btnArr['style'] === '') {
        $class = 'class = "rounded bg-slate-100 px-4 py-1 text-sm ml-2 hover:border-b-4 hover:border-r-4 border-teal-200 text-slate-800  hover:font-bold hover:pt-[.2rem] hover:pb-0 duration-200"';
    } else {
        $class = $$btnArr['style'] ;
    }
    if($btnArr['text'] !=='') {$textCont = '>' . $btnArr['text'];} else {$textCont = '>submit';}
    $end = '</button>
    ';

    $finish = $init . $class . $textCont . $end;
    return $finish;
}
