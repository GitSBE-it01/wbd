<?php

$header_form = [
    'id'=>'main_formset',
    'title_style'=>'text-2xl text-white font-bold',
    'title'=>'Tools Detail',
    'form_detail'=> [
        [
            'type'=>'text',
            'text'=>'Deskripsi Alat', 
            'id'=>'desc_alat',
            'field'=>'',
            'disable'=>'',
            'inp_style'=>'w-[60%] bg-transparent text-white text-xl font-bold ml-4',
            'label_style'=>'inline-block mx-2 mt-1 w-[20vw] text-white text-xl',
        ], 
        [
            'type'=>'text',
            'text'=>'Kategori', 
            'id'=>'cat',
            'field'=>'',
            'disable'=>'',
            'inp_style'=>'w-[60%] bg-transparent text-white text-xl font-bold ml-4',
            'label_style'=>'inline-block mx-2 mt-1 w-[20vw] text-white text-xl',
        ],
        [
            'type'=>'text',
            'text'=>"No Seri", 
            'id'=>'seri',
            'field'=>'',
            'disable'=>'',
            'inp_style'=>'w-[60%] bg-transparent text-white text-xl font-bold ml-4',
            'label_style'=>'inline-block mx-2 mt-1 w-[20vw] text-white text-xl',
        ],
        [
            'type'=>'text',
            'text'=>"No Asset",
            'id'=>'asset',
            'field'=>'',
            'disable'=>'',
            'inp_style'=>'w-[60%] bg-transparent text-white text-xl font-bold ml-4',
            'label_style'=>'inline-block mx-2 mt-1 w-[20vw] text-white text-xl',
        ]
    ]
];

/*
$text ='';
foreach($text_array as $set ){
    $text .= "
            ".input_text([
        'disable'=>'',
        'text'=>$set['text'],
        'id'=>$set['id'],
        'inp_style'=>'w-[60%] bg-transparent text-white text-xl font-bold ml-4',
        'label_style'=>'mx-2 mt-2 w-full w-[20vw] flex-1 text-white text-xl',
    ])."
            ";
}
*/

$btn_open = button([
    'id'=>'open_dtlist',
    'text'=>'',
    'style'=>'fixed z-20 right-2 top-[6vh] w-6 h-6 rounded bg-transparent open_white'
]);

$main_table = [
    'table'=> [
        'id'=> 'table_index', 
        'style'=>'w-screen'
    ],
    'th_row_style'=>'hidden',
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'created_date', 
            'header'=>'Date',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[22vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[22vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'user_input',
            'header'=>'user',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[50vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[50vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'approval_by',
            'header'=>'Approval',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[22vw]'
        ],
        [
            'type'=>'set_btn',
            'field'=> 'data_group',
            'set'=>'open_right',
            'header'=>'Detail',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[6vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black p-2 w-[6vw]',
            'btn_style'=>'w-6 h-6'
        ]
    ]
];



$main_formset = [
    'id'=>'main_formset',
    'title_style'=>'text-xl font-semibold',
    'title'=>'Detail Form',
    'form_detail'=>[
        [
            'type'=>'text',
            'id'=>'point',
            'text'=>'poin pengecekan',
            'field'=>'point_checked',
            'disable'=>'',
            'label_style'=>'mt-1 w-[10vw] inline-block',
            'inp_style'=> 'mt-1 w-[30vw] bg-transparent'
        ],
        [
            'type'=>'text',
            'id'=>'std',
            'text'=>'standard',
            'field'=>'standard',
            'disable'=>'',
            'label_style'=>'mt-1 w-[10vw] inline-block',
            'inp_style'=> 'mt-1 w-[30vw] bg-transparent'
        ],
        [
            'type'=>'logic',
            'id'=>'result',
            'text'=>'hasil',
            'field'=>'result',
        ],
    ]
];

function custom_mainform($count_row) {
    $all ='';
    for($i=0; $i<$count_row; $i++) {
        $all .= "<div class='flex flex-row w-full'>
        <fieldset class='flex flex-col w-[70%] h-full'>
            <label class='inline-block w-[10vw]'>Point Check</label>
            <input type='text' name='check_point' class='mt-1 w-[30vw] bg-teal-200'> 
            <label class='inline-block w-[10vw]'>Standard</label>
            <input type='text' name='standard' class='mt-1 w-[30vw] bg-teal-200'>
        </fieldset>
        <fieldset class='flex flex-col bg-teal-200 w-[30%] h-full'>
            <div class='flex justify-center items-center mb-2 h-[70%]'>
                <span class='check flex hidden h-10 w-10'></span>
                <span class='minus h-10 w-10'></span>
                <span class='cross flex hidden h-10 w-10'></span>
            </div>
            <div class='flex flex-row justify-center h-[30%]'>
                <label for='ok__".$i."' class='flex w-6 h-6 rounded-full justify-center items-center hover:text-semibold hover:bg-green-400 duration-300 rounded cursor-pointer ml-2'>OK</label>
                <input type='radio' name='form__".$i."' id='ok__".$i."' class='appearance-none'>

                <label for='ng__".$i."' class='flex w-6 h-6 rounded-full justify-center items-center hover:text-semibold hover:bg-red-400 duration-300 rounded cursor-pointer ml-2'>NG</label>
                <input type='radio' name='form__".$i."' id='ng__".$i."' class='appearance-none'>
        </fieldset>
        </div>
        ";
    }
    return $all;
}