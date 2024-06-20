<?php
require_once '../index.php';

function indexTemplate($init, $close, $name) {
    $btn = createBtn(['text'=>'coba','style'=>'' ]);
    $all = $init . $btn . $close;
    $filename = $name;
    $filepath = "./"; // Replace with your actual directory path
    $fileHandle = fopen($filepath . $filename, "w");
    if ($fileHandle) {
      fwrite($fileHandle, $all);
      fclose($fileHandle);
      echo "Successfully created " . $filename;
    } else {
      echo "Error creating file!";
    }
    return;
}

indexTemplate($header, $footer, 'index.html');