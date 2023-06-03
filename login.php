<?php
session_start(); // Start session
include('inc.connection.php'); // Include database connection file

$email = $_POST['email'];
$password = $_POST['password'];

$sql = 'SELECT * FROM login WHERE email = :email';
$query = $db->prepare($sql);
$query->bindParam(':email', $email);
$query->execute();

if($query->rowCount() > 0) {
    $row = $query->fetch();

    // Get the hashed password from the database.
    $hashed_password = $row['password'];

    // Verify the password that the user entered.
    if (password_verify($password, $hashed_password)) {
        // The password is correct, so log the user in.
        $_SESSION['success_message'] = 'User logged in successfully';
        $_SESSION['logged_in'] = true;
        header('Location: sheet.php');
    } else {
        // The password is incorrect, so show an error message.
        $_SESSION['incorrect'] = "Password incorrect";
        header('Location: index.php');
    }
    die();
} else {
    echo 'No records found';
}