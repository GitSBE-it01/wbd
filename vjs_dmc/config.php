<?php
define('ENV_FILE', __DIR__ . '/.env');

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

function cekUser($user_log, $prog) {
  $conn = connectToDatabase();
  $query = "SELECT user, role FROM access_config.access_wbd WHERE user = '$user_log' AND prog= '$prog'";
  $result = $conn->query($query);
  
  if ($result && $result->num_rows > 0) {
      $userRole = $result->fetch_assoc();
      return $userRole["role"];
  } else {
      return null; // User not found or error occurred
  }
}

session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  //redirect ke halaman login sbe
  header('location: http://192.168.2.103:8080/sbe/index.php?cek=no');
  exit(0);
}
$user_log = strtoupper($_SESSION["username"]);
$prog = 'jig_db';
$role = cekUser($user_log, $prog);

?>