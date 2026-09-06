<?php
/**
 * Database Connection Setup (PDO)
 * Course: ICT 1209 - Web Technologies
 */

$host = 'localhost';
$dbname = 'recipe_book';
$username = 'root';
$password = ''; // Default XAMPP password is empty string

try {
    // Create PDO connection with UTF-8 character encoding
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // Fail gracefully if database is not created or XAMPP MySQL is turned off
    die("Database Connection Error: " . $e->getMessage());
}
?>
