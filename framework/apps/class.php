<?php
class html {
    public $attribute;
    public $result;

    public function __construct($detail) {
      
      $this->result = $detail;
      return;
    }

    public function __clone() {
    }

    private static $header = "<!DOCTYPE html>
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
    ";

    private static $footer = "
    <script src='../1.asset/external_library/sheetjs/xlsx.full.min.js'></script>
    </body>
    </html>
    ";

    static function new($array) {
        $result = html::$header
        ."<title>".$array['pagetitle']."</title>
        </head>
        <body class='font-[Poppins] h-screen w-screen bg-slate-300 custom_scroll'>
        "
        .$array['body']
        .html::$footer
        ;

        $filename = $array['filename'].'.html';
        $filepath ='../../../../'.$array['filepath'].'/';
        $fileHandle = fopen($filepath .$filename, "w");
        if ($fileHandle) {
          fwrite($fileHandle, $result);
          fclose($fileHandle);
          echo "Successfully created " . $filename;
        } else {
          echo "Error creating file!";
        }
        return;
    }

    function clone() {

    }
}














?>