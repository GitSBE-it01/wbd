<?php
// index page
$main_table = [
    'id'=> 'pick_table', 
    'class'=>'w-full scrollable-y',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Komponen',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::item'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'item', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Deskripsi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::_desc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> '_desc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Department',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::dept'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'dept', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Rel Date',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::rel_dt'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'rel_dt', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Due Date',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::due_dt'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'due_dt', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Lokasi',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::loc__line'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'loc__line', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'ID / Lot',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::lot__id'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'lot__id', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Qty ID / Lot',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::qty'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'qty', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Nasehat',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::qty'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'qty', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Pick Now',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::pick_now'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'pick_now', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Remarks',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::remarks'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'remarks', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Supplier / ID lama',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::old_id'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'old_id', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'ID baru',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::id_new'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'id_new', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'All Lot',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::all_lot'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'all_lot', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'PIC WH',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::pic'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'pic', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
    ]
];
