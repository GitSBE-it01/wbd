<?php 
require_once "../config.php";
require_once "../queryList.php";
// utk proses kebanyakan dilakukan di javascript, index.php hanya membuat HTML utk wadah dari proses di javascript
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>vjs</title>
    <link rel="stylesheet" href="CSS/main.css">

</head>
<body>
<div class="container">
</div>
<script type="module" src="../process.js"></script>
<script type="module" src="../class.js"></script>
<script type="module" src="vjs.js"></script>
</body>
</html>