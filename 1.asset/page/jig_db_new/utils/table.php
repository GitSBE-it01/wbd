<?php
$stock_table_new = [
    'id'=> 'stock_table', 
    'class'=>'w-full h-[35v]',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_jig'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'urut'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'trans_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'toleransi'],
        [
            'th'=>[
                'body'=>'Code',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]',
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::code'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]'
            ],
            'label'=>[
                'for'=>'code'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'code', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[15vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::lokasi'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[15vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'lokasi', 
                'list'=>'loc_list',
                'require'=>'',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Quantity OH',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[12vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::qty_per_unit'],
                'class'=>'bg-slate-600 whitespace-normal border-2 text-sm p-2 border-black w-[12vw] text-white'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'qty_per_unit', 
                'disable'=>'',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Tambah/Kurang',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]'
            ],
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
                ['value'=>'tambah', 'body'=>'Tambah'],
                ['value'=>'kurang', 'body'=>'Kurang'],
            ]
        ],
        [
            'th'=>[
                'body'=>'Quantity',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::qty_change'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[8vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'qty_change', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-100 px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Unit',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[8vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::unit'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[8vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'unit', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-100 px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Remark',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[23vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::remark'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[23vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'remark', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-100 px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Delete',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[6vw]'
            ],
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
    'data_array'=> [
        [
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-500 border-2 uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]'
            ],
            'type'=>'text', 
            'td'=>[
                'name'=>'lokasi',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Quantity OH',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'qty_per_unit',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Tambah/Kurang',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'addSub',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Quantity',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'qty_change',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Unit',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'unit',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Remark',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'remark',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Transaction Date',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'trans_date',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
    ]
];

$history_dtl_new = [
    'id'=> 'history_dtl_table', 
    'class'=>'w-full h-[40vh]',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'th'=>[
                'body'=>'Item Jig',
                'class'=>'bg-blue-500 border-2 uppercase border-black p-2 sticky left-0 top-0 z-20 w-[12vw]'
            ],
            'type'=>'text', 
            'td'=>[
                'name'=>'item_jig',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]
            ',
            ]
        ],
        [
            'th'=>[
                'body'=>'Description',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'desc_jig',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Type of Jig',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'type',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Status Jig',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'status_jig',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Material',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'material',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Drawing',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'drawing',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Remark',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[20vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'remark',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Transaction Date',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[12vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'trans_date',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[12vw]',
            ],
        ],
    ]
];




$usage_table_new = [
    'id'=> 'usage_table', 
    'class'=>'w-full h-[35v]',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        [
            'th'=>[
                'body'=>'Item Number jig',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20 w-[18vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::item_jig'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[18vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'item_jig', 
                'list'=>'jig_list',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Ops Put On',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[18vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::opt_on'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[18vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'opt_on', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Ops Pull Out',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[18vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::opt_off'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[18vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'opt_off', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Status Jig',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[18vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::status'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[18vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'status', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Remark',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[18vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::remark'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[18vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'remark', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-100 px-4 hidden'
            ]
        ],
        [
            'th'=>[
                'body'=>'Delete',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[10vw]'
            ],
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::btn_set'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[10vw]'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 arrow_right_black'
                ]
            ]
        ],
    ]
];


$history_usage_new = [
    'id'=> 'history_table', 
    'class'=>'w-full h-[40vh]',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'th'=>[
                'body'=>'Item Jig',
                'class'=>'bg-blue-500 border-2 uppercase border-black p-2 sticky left-0 top-0 z-20 w-[18vw]'
            ],
            'type'=>'text',
            'td'=>[ 
                'name'=>'item_jig',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[18vw]
            ',
            ]
        ],
        [
            'th'=>[
                'body'=>'Put On Ops',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[18vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'opt_on',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[18vw]',
            ]
        ],
        [
            'th'=>[
                'body'=>'Pull Out Ops',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[18vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'opt_off',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[18vw]',
            ]
        ],
        [
            'th'=>[
                'body'=>'status',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[18vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'status',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[18vw]',
            ]
        ],
        [
            'th'=>[
                'body'=>'Remark',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[18vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'remark',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[18vw]',
            ]
        ],
        [
            'th'=>[
                'body'=>'Transaction Date',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[10vw]',
            ],
            'type'=>'text',
            'td'=>[
                'name'=> 'trans_date',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[10vw]',
            ]
        ],
    ]
];