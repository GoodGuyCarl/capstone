<?php include ('inc.connection.php');
// Check if the form has been submitted
if (isset($_POST['email']) && isset($_POST['password'])) {

    // Sanitize the input data
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Check if the email address already exists
    $sql = "SELECT * FROM login WHERE email = '$email'";
    $result = $db->query($sql);

    if ($result->rowCount() > 0) {
        echo "The email address already exists.";
    } else {

        // Hash the password with the salt
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $sql = "INSERT INTO login (email, password, is_active) VALUES ('$email', '$hashed_password', 0)";
        $db->query($sql);
        $_SESSION['register_success'] = 'Successfully registered your account.';
        header('Location: index.php');
    }

} else {
    echo "Please fill out all of the fields.";
}

?>