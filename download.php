<?php session_start();
include('inc.connection.php');
// Get the file name from the URL
$filename = $_GET["file"];

// Get the file data from the database
$sql = "SELECT resume FROM resumes WHERE resume = '$filename'";
$result = $db->query($sql);
$row = $result->fetch();
$file_data = $row["resume"];

// Set the headers
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Length: " . filesize($file_data));

// Output the file data
readfile($file_data);
