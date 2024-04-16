<?php

class ConnectionPool {
  private static $pool = [];
  private static $poolSize = 5; // Adjust as needed
  private static $host;
  private static $user;
  private static $password;
  private static $dbname;

  public static function configure(string $db) {
    $envConfig = parse_ini_file( __DIR__ . '/.env');
    self::$host = $envConfig('DB_HOST');
    self::$user = $envConfig('DB_USER');
    self::$password = $envConfig('DB_PASSWORD');
    self::$dbname = $db;
  }

  public static function getConnection() {
    if (count(self::$pool) < self::$poolSize) {
      try {
        $mysqli = new mysqli(self::$host, self::$user, self::$password, self::$dbname);
        if ($mysqli->connect_error) {
          throw new Exception("Connection failed: " . $mysqli->connect_error);
        }
        self::$pool[] = $mysqli;
        return $mysqli;
      } catch (Exception $e) {
        throw $e; 
      }
    } else {
      throw new Exception("No available connections in pool");
    }
  }

  public static function releaseConnection(mysqli $connection) {
    foreach (self::$pool as $key => $conn) {
      if ($conn === $connection) {
        unset(self::$pool[$key]);
        return;
      }
    }
    throw new Exception("Connection not found in pool");
  }

  public static function getInstance(): ConnectionPool {
    static $instance = null;
    if (is_null($instance)) {
      $instance = new ConnectionPool();
    }
    return $instance;
  }
}



?>