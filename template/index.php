<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = explode("/",$currentURL);
  header(`location: http://$url[2]/sbe/index.php?cek=no`);
  exit(0);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/symbol.css">
    <title>pick now</title>
</head>
<body>
<div id='root' class='container'>
<h1>Testing 123</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, dolores. Ipsum, dolor incidunt! Alias soluta rem amet incidunt id, at ratione ipsum necessitatibus possimus cum. Ullam aliquid quo ipsa, mollitia, eum explicabo nulla quisquam rem sunt fugiat culpa, voluptate exercitationem sit a excepturi in vitae? Dignissimos quam voluptas, repudiandae incidunt nihil iure quas velit repellat saepe quisquam asperiores quasi, animi veritatis ducimus sed est? Laboriosam soluta fugit fugiat sit perspiciatis provident odio impedit aliquam fuga pariatur natus nam maiores harum, deleniti dolor recusandae dolores similique dolorum mollitia iusto illo. Perferendis consequuntur minus id eos reiciendis soluta placeat quibusdam iste voluptatem!</p>
<button class= 'defaultBtn'>submit</button>
</div>



<script type='module'>



</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>