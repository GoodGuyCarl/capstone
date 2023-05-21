<?php
session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="login.php" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Login">
</form>
<a href="register.html" target="_blank">Sign up here</a>
<?php
if (array_key_exists('incorrect', $_SESSION)){
    echo $_SESSION['incorrect'];
}
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != $_SERVER['PHP_SELF']) {
    unset($_SESSION['incorrect']);
}
?>
</body>
</html>