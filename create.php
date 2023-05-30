<?php
session_start();
include('inc.connection.php');

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Check if a file was uploaded successfully
if ($_FILES['resume']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['resume']['tmp_name'];
    $fileName = $_FILES['resume']['name'];
    $fileSize = $_FILES['resume']['size'];
    $fileType = $_FILES['resume']['type'];

    // Specify the directory where you want to store the uploaded files
    $targetDirectory = 'uploads/';

    // Generate a unique filename to prevent conflicts
    $targetFilePath = $targetDirectory . uniqid() . '_' . $fileName;

    // Move the uploaded file to the desired location
    if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
        // Store the file reference in the database
        $resumeReference = $targetFilePath;

    } else {
        echo "Failed to move the uploaded file.";
    }
} else {
    echo "Error uploading the file.";
}

$sql = 'INSERT INTO resumes (name, email, phone, resume, date_submitted) VALUES (:name, :email, :phone, :resume, NOW())';
$query = $db->prepare($sql);
$query->bindParam(':name', $name);
$query->bindParam(':email', $email);
$query->bindParam(':phone', $phone);
$query->bindParam(':resume', $resumeReference);
$query->execute();



if($query->rowCount() > 0) {
    header('Location: tracker.php');
}