<?php
$host = "localhost";
$dbname = "login_system";
$username = "root";
$password = "shalini@8675";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}
?>
