<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="flex flex-col w-full max-w-md mx-auto mt-10">
        <div class="flex flex-row justify-between items-center mb-4">
            <h1 class="text-xl font-semibold text-gray-800">Sign in</h1>
            <a href="register.html" class="text-gray-500 hover:text-orange-500">Create an account</a>
        </div>

        <form action="login.php" method="post">
            <div class="flex flex-col mb-4">
                <label for="email" class="text-sm font-medium text-gray-800">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-orange-300">
            </div>

            <div class="flex flex-col mb-4">
                <label for="password" class="text-sm font-medium text-gray-800">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-orange-300">
            </div>

            <div class="flex flex-row justify-left items-center mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm font-medium text-gray-800">Remember me</label>
            </div>

            <div class="flex flex-row justify-between items-center">
                <button type="submit" class="w-full px-4 py-2 bg-orange-500 text-white rounded-md focus:outline-none focus:bg-orange-600">Sign in</button>
            </div>
            <a href="/forgot-password" class="text-gray-500 hover:text-orange-500">Forgot password?</a>
        </form>
    </div>
</div>

<?php
if(isset($_SESSION['incorrect'])){
    echo $_SESSION['incorrect'];
}
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != $_SERVER['PHP_SELF']) {
    unset($_SESSION['incorrect']);
}
?>
</body>
</html>