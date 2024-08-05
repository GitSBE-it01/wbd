<?php
// index page
$jig_table = [
    'id'=> 'jig_table', 
    'class'=>'w-full',
    'row_count' =>50,
    'tr'=>['class'=>''],
    'data_array'=> [
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Item Number Jig',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'item_jig',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Desc Jig',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'desc_jig',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Jig Type',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'type',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Status Jig',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'status_jig',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Material',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'material',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Qty On Hand',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'qty_oh',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Detail',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::btn_set'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::detail'],
                    'class'=>'w-6 h-6 arrow_right_black cursor-pointer'
                ]
            ]
        ],
    ]
];

$type_table = [
    'id'=> 'type_table', 
    'class'=>'w-full hidden',
    'row_count' =>50,
    'tr'=>['class'=>''],
    'data_array'=> [
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Item Number Speaker',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'item_type',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Desc Speaker',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'_desc',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Status Speaker',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'status_spk',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Item Number Jig',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'item_jig',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Desc Jig',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'desc_jig',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Put On',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'opt_on',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Pull Out',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'opt_off',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Material',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'material',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Qty On Hand',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'qty_oh',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
    ]
];

$detail_type_jig = [
    'id'=> 'detail_type_jig', 
    'class'=>'w-full hidden',
    'row_count' =>25,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Item Number Speaker',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'item_type',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Desc Speaker',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'_desc',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Status Speaker',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'status',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Put On',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'opt_on',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Pull Off',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'opt_off',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ]
    ]
];

$detail_loc_jig = [
    'id'=> 'detail_loc_jig', 
    'class'=>'w-full',
    'row_count' =>25,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Item Number Jig',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'code',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'lokasi',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Qty',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'qty_per_unit',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Unit',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'unit',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ]
    ]
];

// update page
$stock_table = [
    'id'=> 'stock_table', 
    'class'=>'w-full',
    'row_count' =>25,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
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
                'class'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-300 px-4 hidden'
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
                    'class'=>'w-6 h-6 minus'
                ]
            ]
        ],
    ]
];

$stock_table_hist = [
    'id'=> 'stock_table_hist', 
    'class'=>'w-full',
    'row_count' =>25,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'th'=>[
                'body'=>'Code',
                'class'=>'bg-blue-500 border-2 uppercase border-black p-2 sticky left-0 top-0 z-20 w-[20vw]'
            ],
            'type'=>'text', 
            'td'=>[
                'name'=>'code',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10 w-[20vw]',
            ],
        ],
        [
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-300 border-2 uppercase border-black p-2 sticky top-0 z-10 w-[8vw]',
            ],
            'type'=>'text', 
            'td'=>[
                'name'=>'lokasi',
                'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]',
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

$dtl_new_hist = [
    'id'=> 'dtl_hist_table', 
    'class'=>'w-full',
    'row_count' =>25,
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

$type_table_upd = [
    'id'=> 'type_table', 
    'class'=>'w-full',
    'row_count' =>25,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_type'],
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
                'body'=>'Status',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[18vw]'
            ],
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::status'],
                'class'=>'bg-slate-600 whitespace-normal border-2 text-sm p-2 border-black w-[18vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'status', 
                'disable'=>'',
                'class'=>'w-full rounded text-white h-full bg-transparent px-4 hidden'
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
                    'class'=>'w-6 h-6 minus'
                ]
            ]
        ],
    ]
];

$type_table_hist = [
    'id'=> 'type_table_hist', 
    'class'=>'w-full',
    'row_count' =>25,
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

//template empty
$stock_table_new = [
    'id'=> 'stock_table_new', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_jig'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'urut'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'trans_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'toleransi'],
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
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'code', 
                'require'=>'',
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
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'lokasi', 
                'list'=>'loc_list',
                'require'=>'',
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
                'type'=>'text', 
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
                'class'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-300 px-4 hidden'
            ],
            'option'=>[
                ['value'=>'tambah', 'body'=>'Tambah'],
                ['value'=>'kurang', 'body'=>'Kurang'],
            ]
        ],
        [
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
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::btn_set'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[6vw]'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 minus'
                ]
            ]
        ],
    ]
];

$type_table_new = [
    'id'=> 'type_table_new', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_type'],
        [
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
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::status'],
                'class'=>'bg-slate-600 whitespace-normal border-2 text-sm p-2 border-black w-[18vw]'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=> 'status', 
                'class'=>'w-full rounded text-white h-full bg-transparent px-4 hidden'
            ]
        ],
        [
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
            'type'=>'set_btn',
            'td'=>[
                'data_attr'=>['field::btn_set'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[10vw]'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::delete'],
                    'class'=>'w-6 h-6 minus'
                ]
            ]
        ],
    ]
];

//trans table
$trans_header_table = [
    'id'=> 'trans_header_table', 
    'class'=>'w-full',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Item Number Jig',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'name'=>'item_jig',
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Qty Total',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'qty_oh',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Qty Tersedia',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'qty_curr',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'text',
            'th'=>[
                'body'=>'Qty Di Pinjam',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'qty_br',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Detail',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::btn_set'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[6vw]'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::detail'],
                    'class'=>'w-6 h-6 arrow_right_black cursor-pointer'
                ]
            ]
        ],
    ]
];

$trans_detail_table = [
    'id'=> 'trans_detail_table', 
    'class'=>'w-full',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_jig'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'qty'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'end_date'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Code',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::code'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
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
            'type'=>'text',
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'name'=>'lokasi',
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Qty',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::qty_per_unit'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=>'qty_per_unit',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Unit',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::unit'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=>'unit',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Tgl Pinjam',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::start_date'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=>'start_date',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Peminjam',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::loc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'loc',
                'list'=>'loc_list',
                'require'=>'',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'set_btn',
            'th'=>[
                'body'=>'Detail',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::btn_set'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[6vw]'
            ],
            'button'=>[
                [
                    'data_attr'=>['method::submit', 'submit_type::trans_jig'],
                    'class'=>'w-6 h-6 arrow_right cursor-pointer'
                ]
            ]
        ],
    ]
];

$table_list = [
    'id'=> 'table_list', 
    'class'=>'w-full',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'id'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::code'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
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
    ]
];

// add data table
$new_loc_jig_form = [
    'id'=> 'add_loc_jig_form', 
    'class'=>'w-full mt-4',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_jig'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'trans_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'remark'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'urut'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'toleransi'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'addSub'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'qty_change'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Code',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::code'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'label'=>[
                'for'=>'code'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'code', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::lokasi'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'list'=>'loc_list',
                'name'=>'lokasi',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Qty',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::qty_per_unit'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'qty_per_unit',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Unit',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::unit'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'unit',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
    ]
];

$new_temp_loc_jig_form = [
    'id'=> 'add_loc_jig_new_form', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_jig'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'trans_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'remark'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'urut'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'toleransi'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'addSub'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'qty_change'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::code'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'label'=>[
                'for'=>'code'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=> 'code', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::lokasi'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'list'=>'loc_list',
                'name'=>'lokasi',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::qty_per_unit'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'qty_per_unit',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',

            'td'=>[
                'data_attr'=>['field::unit'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'unit',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
    ]
];

$new_type_jig_form = [
    'id'=> 'add_type_jig_form', 
    'class'=>'w-full',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_jig'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'trans_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'remark'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Type Speaker',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::item_type'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'label'=>[
                'for'=>'item_type'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'list'=>'type_list',
                'name'=> 'item_type', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Put On Ops',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::opt_on'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=>'opt_on',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Pull Out Ops',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::opt_off'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'opt_off',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
    ]
];

$new_temp_type_jig_form = [
    'id'=> 'add_type_jig_new_form', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_jig'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'trans_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'remark'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::item_type'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'label'=>[
                'for'=>'item_type'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'list'=>'type_list',
                'name'=> 'item_type', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::opt_on'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=>'opt_on',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::opt_off'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'opt_off',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
    ]
];

$add_speaker_type_jig_form = [
    'id'=> 'add_type_jig_form', 
    'class'=>'w-full',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_type'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'trans_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'remark'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Type jig',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::item_jig'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'label'=>[
                'for'=>'item_jig'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'list'=>'type_list',
                'name'=> 'item_jig', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Put On Ops',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::opt_on'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'name'=>'opt_on',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Pull Out Ops',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::opt_off'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'opt_off',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
    ]
];

$add_new_speaker_type_jig_form = [
    'id'=> 'add_new_speaker_type_jig_form', 
    'class'=>'hidden',
    'row_count' =>1,
    'tr'=>['class'=>''],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'item_type'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'trans_date'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'remark'],
        ['type'=>'hidden', 'type_attr'=>'hidden', 'name'=>'status'],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::item_jig'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'label'=>[
                'for'=>'item_jig'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'list'=>'type_list',
                'name'=> 'item_jig', 
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::opt_on'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'input', 
                'placeholder'=>'',
                'disable'=>'',
                'name'=>'opt_on',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'td'=>[
                'data_attr'=>['field::opt_off'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'placeholder'=>'',
                'name'=>'opt_off',
                'class'=>'w-full rounded h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
    ]
];