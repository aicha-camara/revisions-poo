<?php

$host = 'localhost';
$dbname = 'draft-shop';
$username = 'root';
$password = 'za9?-U5zwD4-6#L';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
