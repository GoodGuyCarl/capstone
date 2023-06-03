<?php
session_start();
include('inc.connection.php');

// Get the file name from the URL
$filename = $_GET["file"];

// Get the file data from the database
$sql = "SELECT file_name FROM pds WHERE file_name = :filename";
$stmt = $db->prepare($sql);
$stmt->bindParam(':filename', $filename);
$stmt->execute();
$row = $stmt->fetch();

$file_data = 'uploads/' . $row["file_name"];

if (file_exists($file_data)) {
    // Set the headers
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');

    // Output the file data
    readfile($file_data);
} else {
    echo 'File not found';
}
exit;