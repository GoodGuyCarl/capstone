<?php session_start();
include ('inc.connection.php');

$id = $_GET['id'];

$sql = "DELETE FROM resumes WHERE id = '$id'";
$result = $db->query($sql);

if($result){
    header('Location: tracker.php');
    $_SESSION['delete_success'] = "Deleted successfully";
}
else {
    echo "Query failed";
}