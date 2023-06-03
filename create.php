<?php
session_start();
include('inc.connection.php');

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Check if a file was uploaded successfully
if ($_GET['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];

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

$sql = 'INSERT INTO pds (file_name) VALUES (:filename)';
$query = $db->prepare($sql);
$query->bindParam(':filename', $fileReference);
$query->execute();



if($query->rowCount() > 0) {
    header('Location: tracker.php');
}