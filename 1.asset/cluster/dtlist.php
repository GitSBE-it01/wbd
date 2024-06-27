<?php

function dtlistArea($listArray) {

    $finish = "<div class='h-full w-full bg-black opacity-25 fixed z-30'></div>
            <div class='h-[75vh] w-[80vw] bg-blue-300 top-[20vh] rounded fixed z-30 scrollable'>
                <input type='text' class='w-full'>
                <div
            </div>";
    return $finish;
}

/*
$dtlistArr = [
        'target'=> `body`, 
        'ID' => '',
        'src' =>src,
        "style"=> {
            dtlist: 'w-[50%] h-[90%] ml-4 pl-4 top-[1vh] rounded scrollable absolute bg-slate-400 z-40 hidden right-8 whitespace-pre-line',
            separator: 'w-[50%] h-[.2vh] bg-blue-200 flex items-center my-2'
        },
        'field' => ['no seri = sn_id', 'kategori alat = new_subcat', 'asset = no_asset', 'deskripsi alat = _desc']
    ]
*/