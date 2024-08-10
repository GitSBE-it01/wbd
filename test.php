<?php
$testing = '</div>';
echo strpos($testing,">");


$test = "<
    div
    class='flex flex-row'
    id=''
    >
    submit
    </
    div
    >
";
$test3 = explode("
",$test);
$result = [];
foreach($test3 as $set) {
    $set2 = trim($set);
    echo $set2."</br>";
    if(is_numeric(strpos($set2,'='))) {
        $key = explode('=', $set2);
        $result[$key[0]] = $set2;
    } else {
        if($set2 !=='' or $set2 !=='>') {
            $result['element'] = $set2;
        }
    }
}

echo "<pre>";
print_r($test3);
print_r($result);
echo "</pre>";
$position = strpos($test, "class");
$test2 = substr($test, $position);
echo $position."</br>";
echo $test2;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>