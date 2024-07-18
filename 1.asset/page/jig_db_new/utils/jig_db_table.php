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
            'placeholder'=>'',
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
            'placeholder'=>'',
            'field'=> 'lokasi', 
            'header'=>'Lokasi',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[15vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'qty_per_unit',
            'header'=>'Quantity OH',
            'disable'=>'',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'addSub',
            'header'=>'Tambah/Kurang',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'qty_change',
            'header'=>'Quantity',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'unit',
            'header'=>'Unit',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
            'inp_style'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
        ],
        [
            'type'=>'input',
            'field'=> 'remark',
            'header'=>'Remark',
            'th_style'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[23vw]',
            'td_style'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[23vw]',
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


$stock_table_new = [
    'id'=> 'stock_table', 
    'class'=>'w-full h-[35v]',
    'row_count' =>50,
    'th'=>[
        ['body'=>'Code',
            'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]'],
        ['body'=>'Lokasi',
            'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'],
        ['body'=>'Quantity OH',
            'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]'],
        ['body'=>'Tambah/Kurang',
            'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]'],
        ['body'=>'Quantity',
            'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]'],
        ['body'=>'Unit',
            'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]'],
        ['body'=>'Remark',
            'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[23vw]'],
        ['body'=>'Delete',
            'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[6vw]'],
    ],
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden','name'=>'item_jig'],
        ['type'=>'hidden','name'=>'urut'],
        ['type'=>'hidden','name'=>'trans_date'],
        ['type'=>'hidden','name'=>'status'],
        ['type'=>'hidden','name'=>'toleransi'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::code'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]'
            ],
            'label'=>[
                'for'=>'code'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=> 'code', 
                'id'=> 'code', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::lokasi'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[15vw]'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=> 'lokasi', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::qty_per_unit'],
                'class'=>'bg-slate-600 whitespace-normal border-2 text-sm p-2 border-black w-[12vw] text-white'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=> 'qty_per_unit', 
                'disable'=>'',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'select',
            'td'=>[
                'data_attr'=>['field::addSub'],
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]'
            ],
            'select'=>[
                'name'=> 'addSub', 
                'class'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-300 px-4'
            ],
            'option'=>[
                ['body'=>'Tambah'],
                ['body'=>'Kurang'],
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::qty_change'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[8vw]'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=> 'qty_change', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-100 px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::unit'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[8vw]'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=> 'unit', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-100 px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::remark'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[23vw]'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=> 'remark', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-100 px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::btn_set'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[6vw]'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete'],
                    'disable'=>'',
                    'class'=>'w-6 h-6 arrow_right_black'
                ]
            ]
        ],
    ]
];


$history_table_new = [
    'id'=> 'history_table', 
    'class'=>'w-full h-[40vh]',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'th'=>[
        ['body'=>'Lokasi',
            'class'=>'bg-blue-500 border-2 uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]'],
        ['body'=>'Quantity OH',
            'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',],
        ['body'=>'Tambah/Kurang',
            'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',],
        ['body'=>'Quantity',
            'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',],
        ['body'=>'Unit',
            'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',],
        ['body'=>'Remark',
            'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',],
        ['body'=>'Transaction Date',
            'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',],
    ],
    'data_array'=> [
        [
            'type'=>'text', 
            'name'=>'lokasi',
            'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]',
        ],
        [
            'type'=>'text',
            'name'=> 'qty_per_unit',
            'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
        ],
        [
            'type'=>'text',
            'name'=> 'addSub',
            'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
        ],
        [
            'type'=>'text',
            'name'=> 'qty_change',
            'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
        ],
        [
            'type'=>'text',
            'name'=> 'unit',
            'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
        ],
        [
            'type'=>'text',
            'name'=> 'remark',
            'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
        ],
        [
            'type'=>'text',
            'name'=> 'trans_date',
            'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
        ],
    ]
];

