<?php

/*
ITEM NUMBER JIG
DESC JIG
JIG TYPE
STATUS JIG
MATERIAL
QTY ON HAND
DETAIL
*/

$jig_table = [
    'table'=> [
        'id'=> 'table_jig', 
        'style'=>'w-screen'
    ],
    'row_count' =>100,
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'item_jig', 
            'header'=>'Item Number jig',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]'
        ],
        [
            'type'=>'text', 
            'field'=> 'desc_jig', 
            'header'=>'Desc Jig',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[34vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[34vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'type',
            'header'=>'Jig Type',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'status_jig',
            'header'=>'Status Jig',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'material',
            'header'=>'Material',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'qty',
            'header'=>'Qty On Hand',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]'
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

$loc_table = [
    'table'=> [
        'id'=> 'table_loc_jig', 
        'style'=>'w-full'
    ],
    'row_count' =>100,
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'code', 
            'header'=>'Code',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]'
        ],
        [
            'type'=>'text', 
            'field'=> 'lokasi', 
            'header'=>'Lokasi',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[34vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[34vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'qty_per_unit',
            'header'=>'Qty per Unit',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'unit',
            'header'=>'unit',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]'
        ]
    ]
];


$use_table = [
    'table'=> [
        'id'=> 'table_use_jig', 
        'style'=>'w-full hidden'
    ],
    'row_count' =>100,
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'item_jig', 
            'header'=>'Item Number jig',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]'
        ],
        [
            'type'=>'text', 
            'field'=> 'desc_jig', 
            'header'=>'Desc Jig',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[34vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[34vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'type',
            'header'=>'Jig Type',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'status_jig',
            'header'=>'Status Jig',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'material',
            'header'=>'Material',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]'
        ],
        [
            'type'=>'text',
            'field'=> '',
            'header'=>'Qty On Hand',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]'
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


