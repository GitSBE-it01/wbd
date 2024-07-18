<?php
require_once "2.backend/api/vjs_alat_ukur.php";
require_once "2.backend/model/index.php";
require_once "1.asset/index.php";

$set = ['type'=>'select',
'td'=>[
    'data_attr'=>['field::addSub'],
    'class'=>'bg-slate-300 whitespace-normal border-2 p-2 text-sm border-black w-[8vw]'
],
'select'=>[
    'name'=> 'addSub', 
    'disable'=>'',
    'class'=>'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent px-4'
],
'option'=>[
    ['body'=>'Tambah'],
    ['body'=>'Kurang'],
]
];
$td_attr = $set['td'];
$sel = $set['select'];
$sel['body']='';
foreach($set['option'] as $val_opt) {
    $sel['body'] .= $option->create([
        'body'=>$val_opt
    ]);
}
$td_attr['body'] = $select->create($sel);
$_td = $td->create($td_attr);

echo $_td;

?>

<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='../1.asset/main.css' rel='stylesheet' />
        <link href='../1.asset/output.css' rel='stylesheet' />
        <link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
        <script src='../3.utility/auth.js'></script>
        <link rel='icon' href='../1.asset/symbol/new_logo_sbe.png' type='image/ico' />
        <title>Update Data Jig</title>
    </head>
    <body>
        <div> testing</div>
        <?php 
        $test2 = $div->create([
            'class'=>'fixed top-[5vh] flex flex-col bg-slate-700 w-screen h-[10vh]',
            'body'=>[
                $div->create([
                    'body'=>[
                        $div->create([
                            'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold bg-blue-700 text-xl font-bold',
                            'data_attr'=>['switch::stock'],
                            'body '=>'Update Stock'
                        ]),
                        $div->create([
                            'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold',
                            'data_attr'=>['switch::detail'],
                            'body '=>'Update Detail'
                        ]),
                        $div->create([
                            'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold',
                            'data_attr'=>['switch::use'],
                            'body '=>'Update Usage'
                        ]),
                    ]
                ]),
                $div->create([
                    'body'=>'terbuatkan keduanya?'
                ]),
            ]
        ]);
        echo $test2;
        $test = $header->create([
            'class'=>'fixed top-[5vh] bg-slate-700 w-screen h-[10vh]',
            'body'=>[
                $div->create([
                    'class'=>'flex flex-row w-full h-[5vh] justify-center items-center',
                    'body'=>[
                        $div->create([
                            'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold bg-blue-700 text-xl font-bold',
                            'data_attr'=>['switch::stock'],
                            'body '=>'Update Stock'
                        ]),
                        $div->create([
                            'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold',
                            'data_attr'=>['switch::detail'],
                            'body '=>'Update Detail'
                        ]),
                        $div->create([
                            'class'=>'flex cursor-pointer items-center h-full justify-center flex-1 text-white duration-300 border-2 border-black hover:bg-blue-700 hover:font-bold',
                            'data_attr'=>['switch::use'],
                            'body '=>'Update Usage'
                        ]),
                    ]
                ])
            ]
        ]);
        
        print_r($test);
        echo $test;
    ?>
    </body>
    </html>