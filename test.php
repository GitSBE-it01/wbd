<?php
$test = " apakah bisa di test utk hal ini? apakah bisa di dapatkan?";
$word = "bisa";

if (strpos($test, $word) !== false) {
    echo "The text contains the word " . $word . "</br>";
  }

  echo is_bool(strpos($test, $word));


?>