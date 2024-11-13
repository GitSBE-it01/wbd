<?php
// index page
$main_table = [
    'id'=> 'idev_table', 
    'class'=>'w-full scrollable-y',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden','name'=>'code'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Parent',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::parent'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'parent', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Parent Desc',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::parent_desc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'parent_desc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Component',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::comp'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'comp', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Comp Desc',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::comp_desc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'comp_desc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Status Item Comp',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::status_item_comp'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'status_item_comp', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Buyer/Planner',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::buyer_planner'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'buyer_planner', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Status ISIR',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::status_isir'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'status_isir', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Need ISIR',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::need_isir'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'need_isir', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Finishing',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::finishing'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'finishing', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Construction',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::construction'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'construction', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Material',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::material'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'material', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'BOM Rel Date',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::bom_release_date'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'bom_release_date', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Umur (hari)',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::age'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'age', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Status Item Dev',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::status'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'status', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Close Date',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::close_date'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'close_date', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
    ]
];

$main_table2 = [
    'id'=> 'master_table', 
    'class'=>'w-full scrollable-y hidden',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden','name'=>'id'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Item Number',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::item_number'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'item_number', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Description1',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::desc1'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'desc1', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Description2',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::desc2'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'desc2', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Item Site',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::item_site'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'item_site', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Item Status',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::item_status'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'item_status', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Prod Line',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::prod_line'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'prod_line', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'P/M Code',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::pm_code'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'pm_code', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Buyer / Planner',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::buyer'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'buyer', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Routing',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::rout_cek'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'rout_cek', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'BOM',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::bom_cek'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'bom_cek', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'added',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::added'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'added', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Status',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::status'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'status', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Close Date',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::close_date'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'disable'=>'',
                'name'=> 'close_date', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ]
    ]
];



$tracker_table = [
    'id'=> 'tracker_table', 
    'class'=>'w-full scrollable-y',
    'row_count' =>50,
    'tr'=>['class'=>'hidden'],
    'data_array'=> [
        ['type'=>'hidden', 'type_attr'=>'hidden','name'=>'id'],
        ['type'=>'hidden', 'type_attr'=>'hidden','name'=>'id_parent'],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Item Number',
                'class'=>'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20',
            ],
            'td'=>[
                'data_attr'=>['field::item_number'],
                'class'=>'bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10'
            ],
            'inp'=>[
                'type_attr'=>'text', 
                'name'=> 'item_number', 
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
                'data_attr'=>['field::desc_'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'desc_', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Site',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::site'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'site', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Parent List',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::parent'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'parent', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Problem',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::problem'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'problem', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Action',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::action'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'action', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'PIC',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::pic'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'pic', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'ETC',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::etc'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'etc', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Status',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::status'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'status', 
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
                'name'=> 'remarks', 
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Added',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::added'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'added', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],
        [
            'type'=>'input',
            'th'=>[
                'body'=>'Last Modified',
                'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10'
            ],
            'td'=>[
                'data_attr'=>['field::last_mod'],
                'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black'
            ],
            'inp'=>[
                'type'=>'text', 
                'name'=> 'last_mod', 
                'disable'=>'',
                'class'=>'w-full h-full flex justify-center items-center focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4 hidden'
            ]
        ],

    ]
];
