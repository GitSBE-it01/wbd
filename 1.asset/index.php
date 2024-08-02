<?php
require_once 'blocks/button.php';
require_once 'blocks/input.php';
require_once 'blocks/pagination.php';
require_once 'blocks/select.php';
require_once 'blocks/table_block.php';
require_once 'blocks/text.php';

require_once 'cluster/button.php';
require_once 'cluster/form.php';
require_once 'cluster/input.php';
require_once 'cluster/navigation.php';
require_once 'cluster/table.php';

require_once 'class.php';
require_once 'comp/button.php';
require_once 'comp/component.php';
require_once 'comp/form.php';
require_once 'comp/list.php';
require_once 'comp/nav.php';
require_once 'comp/pagination.php';
require_once 'comp/selection.php';
require_once 'comp/structure.php';
require_once 'comp/table.php';
require_once 'comp/text.php';

$home_btn = Comp::link([
  'href'=>'http://informationsystem.sbe.co.id:8080/sbe/index.php',
  'body'=>Comp::button([
      'class'=> 'home h-8 w-8 rounded bg-slate-700',
  ])
]);


function createHTML($array) {
  /*
    [
      'body'=>'',
      'name'=>'',
      'title'=>'',
      'path'=>''
    ]
  */
  $header = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='../1.asset/main.css' rel='stylesheet' />
        <link href='../1.asset/output.css' rel='stylesheet' />
        <link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
        <link rel='icon' href='../1.asset/symbol/new_logo_sbe.png' type='image/ico' />
        <title>".$array['title']."</title>
    </head>
    <body class='font-[Poppins] h-screen w-screen bg-slate-300 custom_scroll'>
    ";

  $footer = 
    "<script src='../1.asset/external_library/sheetjs/xlsx.full.min.js'></script>
    </body>
    </html>
    ";

  $all = $header . $array['body'] . $footer;
  $filename = $array['name'] . '.html';
  $filepath ='../../../'.$array['path'].'/';
  $fileHandle = fopen($filepath .$filename, "w");
  if ($fileHandle) {
    fwrite($fileHandle, $all);
    fclose($fileHandle);
    echo "Successfully created " . $filename;
  } else {
    echo "Error creating file!";
  }
  return;
}

