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
    'row_count' =>50,
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
    'row_count' =>50,
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'item_type', 
            'header'=>'Item Number speaker',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]'
        ],
        [
            'type'=>'text', 
            'field'=> 'pt_desc1', 
            'header'=>'Desc Speaker',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[34vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[34vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'pt_status',
            'header'=>'Status Speaker',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'opt_on',
            'header'=>'Put On Ops',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]'
        ],
        [
            'type'=>'text',
            'field'=> 'opt_off',
            'header'=>'Pull Out Ops',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]'
        ]
    ]
];

$stock_table = [
    'table'=> [
        'id'=> 'stock_table', 
        'style'=>'w-full'
    ],
    'row_count' =>50,
    'data_array'=> [
        [
            'type'=>'input', 
            'field'=> 'code', 
            'header'=>'Code',
            'disable'=>'',
            'th_style'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        ['type'=>'hidden','field'=>'item_jig'],
        [
            'type'=>'input', 
            'field'=> 'lokasi', 
            'header'=>'Lokasi',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[34vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[34vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'qty_per_unit',
            'header'=>'Quantity OH',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'addSub',
            'header'=>'Tambah/Kurang',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'qty_change',
            'header'=>'Quantity',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'unit',
            'header'=>'Unit',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'remark',
            'header'=>'Remark',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'set_btn',
            'field'=> 'btn_set',
            'set'=>'delete',
            'header'=>'Delete',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[6vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm border-black p-2 w-[6vw]',
            'btn_style'=>'w-6 h-6'
        ],

        ['type'=>'hidden','field'=>'urut'],
        ['type'=>'hidden','field'=>'trans_date'],
        ['type'=>'hidden','field'=>'status'],
        ['type'=>'hidden','field'=>'toleransi'],
    ]
];

$history_table = [
    'table'=> [
        'id'=> 'history_table', 
        'style'=>'w-full'
    ],
    'row_count' =>50,
    'data_array'=> [
        [
            'type'=>'text', 
            'field'=> 'lokasi', 
            'header'=>'Lokasi',
            'th_style'=>'bg-blue-500 border-2 uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]',
            'td_style'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'text',
            'field'=> 'qty_per_unit',
            'header'=>'Quantity OH',
            'th_style'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'text',
            'field'=> 'addSub',
            'header'=>'Tambah/Kurang',
            'th_style'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'text',
            'field'=> 'qty_change',
            'header'=>'Quantity',
            'th_style'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'text',
            'field'=> 'unit',
            'header'=>'Unit',
            'th_style'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'text',
            'field'=> 'remark',
            'header'=>'Remark',
            'th_style'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'text',
            'field'=> 'trans_date',
            'header'=>'Transaction Date',
            'th_style'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
    ]
];


