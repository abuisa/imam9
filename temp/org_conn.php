<?php
//session_start();
header('Content-Type: text/html; charset=utf-8');
$link = new mysqli("127.0.0.1", "username", "userpass", "hadits9");
mysqli_query($link,"SET NAMES 'utf8'");

if (!$link) {
      echo "Error: Unable to connect to MySQL." . PHP_EOL;
      echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
}
?>
