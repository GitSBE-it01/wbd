<?php
function check_cache($routes, $param){
  $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/";  // Adjust the folder name and path as needed
  $files = glob($folderPathBase.$routes. "/*"); // Get all files in the folder
  $result = false;
  $today = date('Ymd');
  foreach ($files as $file) {
    if (strpos($file, $today.'__'.$param) !== false) { // Check if it's a file (not a directory)
        $result = true;
      }
  }
  return $result;
}

function cache_data($routes, $param, $data){
    $json_data = json_encode($data);
    $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/";  // Adjust the folder name and path as needed
    $today = date('Ymd');
    $fileName = $today. "__". $param. ".json";
    $filePath = $folderPathBase.$routes."/".$fileName;
    $inputedInto = file_put_contents($filePath, $json_data);
    if ($inputedInto === false) {
        $result =  " Error saving JSON file.";
      } else {
        $result =  " JSON file saved successfully to " . $filePath;
      }
    return $result;
}

function get_cache($routes, $param){
  $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/";  // Adjust the folder name and path as needed
  $today = date('Ymd');
  $files = glob($folderPathBase.$routes. "/*"); // Get all files in the folder
  foreach ($files as $file) {
    if (strpos($file, $today."__".$param) !== false) { // Check if it's a file (not a directory)
        $data = file_get_contents($file);
      }
  }
  return json_decode($data);
}


function delete_cache($routes, $param) {
  $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/"; // Adjust the folder name and path as needed
  $files = scandir($folderPathBase . $routes); // Get all files and directories
  $result = "";
  foreach ($files as $file) {
    if (is_file($folderPathBase . $routes . "/" . $file) && !in_array($file, ['.', '..'])) { // Check if it's a file (not a directory) and exclude '.' and '..'
      if (stripos($file, $param) !== false) { // Case-insensitive search for the word
        unlink($folderPathBase . $routes . "/" . $file);
        $result .= "Deleted file: " . $file . "<br>"; // Append result for each deleted file
      }
    }
  }
  return $result; // Return accumulated results
}
