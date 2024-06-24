<?php
function cache_data($data_name, $data){
    $json_data = json_encode($data);
    $folderPath = "../cache/";  // Adjust the folder name and path as needed
    $today = date('Ymd');
    $fileName = $today. "__". $data_name. ".json";
    $filePath = $folderPath . $fileName;
    $inputedInto = file_put_contents($filePath, $json_data);
    if ($inputedInto === false) {
        $result =  " Error saving JSON file.";
      } else {
        $result =  " JSON file saved successfully to " . $filePath;
      }
    return $result;
}

function get_cache($param){
  $folderPath = "../cache/";  // Adjust the folder name and path as needed
  $files = glob($folderPath . "/*"); // Get all files in the folder
  $result = [$files];
  foreach ($files as $file) {
    if (strpos($file, $param) !== false) { // Check if it's a file (not a directory)
        $data = file_get_contents($file);
        $result = json_decode($data);
      }
  }
  return $result;
}

function delete_cache(){
  $folderPath = "../cache/";  // Adjust the folder name and path as needed
  $files = glob($folderPath . "/*"); // Get all files in the folder
  $result = 'no file to delete';
  foreach ($files as $file) {
     if (is_file($file)) { // Check if it's a file (not a directory)
       unlink($file);
       $result =  "Deleted file: " . $file . "<br>";
     }
   }
  return $result;
}
