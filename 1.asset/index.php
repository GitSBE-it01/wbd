<?php
require_once 'blocks/button.php';
require_once 'blocks/input.php';
require_once 'blocks/select.php';
require_once 'blocks/table_block.php';
require_once 'blocks/text.php';

require_once 'cluster/form.php';
require_once 'cluster/navigation.php';
require_once 'cluster/table.php';


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
        <script src='../3.utility/auth.js'></script>
        <link rel='icon' href='../1.asset/symbol/new_logo_sbe.png' type='image/ico' />
        <title>".$array['title']."</title>
    </head>
    <body class='font-[Poppins] h-[100vh] w-[100vw] bg-slate-300 flex-row custom_scroll'>
    ";

  $footer = 
    "<script src='../1.asset/external_library/sheetjs/xlsx.full.min.js'></script>
    </body>
    </html>
    ";

  $all = $header . $array['body'] . $footer;
  $filename = $array['name'] . '.html';
  $filepath ='../';
  if(isset($array['path']) && $array['path'] !== '') {
    $filepath = $array['path'];
  }
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


  $template = "
    <nav class='fixed flex flex-row top-0 items-center bg-slate-950 w-screen h-[5vh]'>"
        .nav([
            'title'=>'template',
            'links'=>[
                ['text'=>'test1', 'href'=>'#section1'],
                ['text'=>'test2', 'href'=>'#section2'],
            ]
        ]) 
    ."</nav>"
    // header
    ."<header class='fixed flex flex-row top-[5vh] bg-slate-700 w-screen h-[5vh]'>"
        ."<div>
            testing 123
        </div>"
    ."</header>"
    // aside
    ."<aside class='fixed flex flex-row top-[10vh] left-0 bg-teal-700 w-[25vw] h-[90vh]'>"
        ."<div>
            testing 123
        </div>"
    ."</aside>"
    // main
    ."<main class='fixed flex flex-row top-[10vh] bg-slate-300 w-[75vw] h-[90vh] right-0'>"
        ."<div>
            testing 123
        </div>"
    ."</main>"
    //footer
    ."<footer class='fixed flex flex-row bottom-0 bg-slate-300 w-screen h-[5vh]'>"
    ."</footer>"
    ."</script>";
