<?php
// includes/db.php — 1 · CONNECT, once, for every page that needs the database
// XAMPP: the user is root, with no password
$conn = mysqli_connect('localhost', 'root', '', 'ereteti_web');

// The Lab 4 register page (process-register.php) uses PDO with prepared
// statements; its connection is kept here too, from config/config.php,
// so that page keeps working. If that database has not been imported,
// $pdo stays null and only the register page is affected.
$config = require __DIR__ . '/../config/config.php';
try {
 $pdo = new PDO(
 "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
 $config['user'],
 $config['pass'],
 [
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 ]
 );
} catch (PDOException $e) {
 $pdo = null;
}
