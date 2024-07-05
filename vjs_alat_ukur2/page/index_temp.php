<?php


$main_formset = [
    'table'=> [
        'id'=> 'table_form_main', 
        'style'=>'w-full'
    ],
    'row_count'=>20,
    'add_cust_row'=>"
        <tr data-id='remark' class='w-full hidden' >
            <td class='bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[27vw]' >
                <input type='text' name='check_point' value=''class='w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'>
            </td>
            <td colspan=2 class='bg-slate-300 whitespace-normal border-2 text-sm border-black w-[55vw]'>
                <textarea autocomplete='off' placeholder='pilih alat' class='w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4' name='result'></textarea>
            </td>
        </tr>
    ",
    'data_array'=> [
        [
            'type'=>'input', 
            'field'=> 'check_point', 
            'disable'=>'',
            'header'=>'poin pengecekan',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[27vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[27vw]'
        ],
        [
            'type'=>'textarea',
            'field'=> 'standard',
            'header'=>'standard',
            'disable'=>'',
            'rows'=>'4',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[55vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black w-[55vw]'
        ],
        [
            'type'=>'logic',
            'id'=>'',
            'field'=> 'result',
            'header'=>'Hasil',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[10vw]',
            'td_style'=>'flex flex-row bg-slate-300 whitespace-normal border-2 text-sm border-black h-[10vh] w-[10vw] p-0',
            'span_style'=>'w-14 h-14'
        ],
    ]
];

$header_form = [
    'id'=>'main_formset',
    'title_style'=>'text-2xl text-white font-bold',
    'title'=>'',
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

$alat_search = "<input type='text' autocomplete='off' placeholder='input' class='rounded hidden px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 fixed top-[6vh] z-30 right-10 shadow-md w-[40vw]' list='alat_list' data-input='input__alat_search'>";


$btn_submit_form = button([
    'id'=>'submit_form',
    'text'=>'submit',
    'style'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300'
]);

$btn_close_form = button([
    'id'=>'close_form',
    'text'=>'cancel',
    'style'=>'z-30 rounded sticky bottom-0 right-0 bg-gray-300 text-sm px-4 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 duration-300'
]);

$btn_open = button([
    'id'=>'open_dtlist',
    'text'=>'',
    'style'=>'fixed z-20 right-2 top-[6vh] w-6 h-6 rounded bg-transparent open_white'
]);

$btn_new = button([
    'id'=>'new__data',
    'text'=>'',
    'disable'=>'',
    'style'=>'fixed z-20 right-2 top-[10vh] w-6 h-6 rounded bg-transparent opacity-50 plus'
]);

$main_table = [
    'table'=> [
        'id'=> 'table_index', 
        'style'=>'w-screen'
    ],
    'th_row_style'=>'hidden',
    'data_array'=> [
        [
            'type'=>'date', 
            'field'=> 'eff_date', 
            'header'=>'Date',
            'disable'=>'',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[22vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[22vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'user_input',
            'header'=>'user',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[50vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[50vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'approval_by',
            'header'=>'Approval',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[22vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[22vw]'
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


