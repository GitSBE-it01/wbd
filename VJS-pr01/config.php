<?php
require_once "middleware/process.php";

define('CACHE', __DIR__ . '/cache/');
define('ENV_FILE', __DIR__ . '../.env');
$main_menu = '../sbe/index.php?page=login';


function connectToDatabase() {
    // Load .env file manually
    $envConfig = parse_ini_file(ENV_FILE);

    // Access the environment variables
    $dbHost = $envConfig['db_host'];
    $dbUsername = $envConfig['db_username'];
    $dbPassword = $envConfig['db_password'];
    $dbDatabase = $envConfig['db_name'];

  $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbDatabase);
  if ($connection->connect_error) {
      die("Failed to connect to the database: " . $connection->connect_error);
  }
  return $connection;
}

session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  //redirect ke halaman login sbe
  header('location:../../sbe/index.php?page=login');
  exit(0);
}
$user_log = strtoupper($_SESSION["username"]);
$prog = 'vjs';
$role = cekUser($user_log, $prog);


?>