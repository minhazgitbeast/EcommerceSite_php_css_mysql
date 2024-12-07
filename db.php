<?php
$host = '127.0.0.1'; // Database host
$dbname = 'ecommerce'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    // PDO connection setup
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>
