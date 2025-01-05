<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__, 'conn.env');
$dotenv->load();

$host = $_ENV["MYSQL_DB_HOST"];
$username = $_ENV["MYSQL_DB_USER_NAME"];
$password = $_ENV["MYSQL_DB_PASSWORD"];
$dbname = $_ENV["MYSQL_DB_NAME"];

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>