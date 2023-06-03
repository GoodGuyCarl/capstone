<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
</head>
<body>
<main class="container">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="flex flex-col w-full max-w-md mx-auto mt-10">
            <div class="flex flex-row justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold">Sign in</h1>
                <a href="register.html" class="hover:text-blue-500">Create an account</a>
            </div>

            <form action="login.php" method="post">
                <div class="flex flex-col mb-4">
                    <label for="email" class="text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" class="h-50 w-full rounded-md focus:outline-none">
                </div>

                <div class="flex flex-col mb-4">
                    <label for="password" class="text-sm font-medium">Password</label>
                    <input type="password" id="password" name="password" class="w-full rounded-md focus:outline-none">
                </div>

                <div class="flex flex-row justify-between items-center">
                    <button type="submit" class="w-full px-4 py-2 mb-2 border-blue-500 hover:bg-blue-500 text-white rounded-md">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
if(isset($_SESSION['register_success'])){
    echo '<div>
    '. $_SESSION['register_success']. '
</div>';
}
?>
</body>
</html>