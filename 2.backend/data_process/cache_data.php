<?php
function check_cache($folder, $param){
  $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/";  // Adjust the folder name and path as needed
  $files = glob($folderPathBase.$folder. "/*"); // Get all files in the folder
  $result = false;
  foreach ($files as $file) {
    if (strpos($file, $param) !== false) { // Check if it's a file (not a directory)
        $result = true;
      }
  }
  return $result;
}

function cache_data($data_name, $folder, $data){
    $json_data = json_encode($data);
    $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/";  // Adjust the folder name and path as needed
    $today = date('Ymd');
    $fileName = $today. "__". $data_name. ".json";
    $filePath = $folderPathBase.$folder."/".$fileName;
    $inputedInto = file_put_contents($filePath, $json_data);
    if ($inputedInto === false) {
        $result =  " Error saving JSON file.";
      } else {
        $result =  " JSON file saved successfully to " . $filePath;
      }
    return $result;
}

function get_cache($folder, $param){
  $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/";  // Adjust the folder name and path as needed
  $files = glob($folderPathBase.$folder. "/*"); // Get all files in the folder
  $result = [];
  foreach ($files as $file) {
    if (strpos($file, $param) !== false) { // Check if it's a file (not a directory)
        $data = file_get_contents($file);
        $result = json_decode($data);
      }
  }
  return $result;
}


function delete_cache($folder){
  $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/";  // Adjust the folder name and path as needed
  $files = glob($folderPathBase.$folder. "/*"); // Get all files in the folder
  foreach ($files as $file) {
     if (is_file($file)) { // Check if it's a file (not a directory)
       unlink($file);
       $result =  "Deleted file: " . $file . "<br>";
     }
   }
  return $result;
}


function delete_cache2($folder, $wordToFind) {
  $folderPathBase = "D:/xampp/htdocs/wbd/4.cache/"; // Adjust the folder name and path as needed
  $files = scandir($folderPathBase . $folder); // Get all files and directories
  $result = "";
  foreach ($files as $file) {
    if (is_file($folderPathBase . $folder . "/" . $file) && !in_array($file, ['.', '..'])) { // Check if it's a file (not a directory) and exclude '.' and '..'
      if (stripos($file, $wordToFind) !== false) { // Case-insensitive search for the word
        unlink($folderPathBase . $folder . "/" . $file);
        $result .= "Deleted file: " . $file . "<br>"; // Append result for each deleted file
      }
    }
  }
  return $result; // Return accumulated results
}
