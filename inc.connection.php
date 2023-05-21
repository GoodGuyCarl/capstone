<?php
$dsn = 'mysql:dbname=hrmo;host=localhost';
$user = 'root';
$password = '';


try {
    $db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    die('Error connecting to database: ' . $e->getMessage());
}

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);