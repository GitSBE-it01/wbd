<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  header(`location: http://$_SERVER[HTTP_HOST]/sbe/index.php?cek=no`);
} else {
  $user_id = md5('username=' . $_SESSION['username']);  
  $cookie_name = 'auth_token';
  $expire = time() + 60 * 60 * 24;
  $today = date('Y-m-d');
  $cookie_value = md5('authenticate--' . $user_id .$today);
  $_SESSION[$cookie_name] = $cookie_value;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <input type="hidden" id="name" value="<?php echo $cookie_name;  ?>">
  <input type="hidden" id="value" value="<?php echo $cookie_value;  ?>">
  <input type="hidden" id="expire" value="<?php echo $expire;  ?>">
</body>
</html>
<script>
  function setCookie() {
    const name = document.getElementById('name').value;
    const value = document.getElementById('value').value;
    const expires = document.getElementById('expire').value;
    document.cookie = name + "=" + value + "; " + expires + "; path=/";
  }

  setCookie();
  console.log(document.cookie);
  const check = window.location.href.split("/");
  console.log(check);
  const newURL = 'http://' + check[2] + '/wbd/template/index.html';
  window.location.href = newURL;
</script>