<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Sign in</title>
</head>
<body>
<main>
    <div class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center font-weight-bold">Sign in</div>
                        <div class="card-body">
                            <div class="text-center mb-2">
                                <a href="register.html">Create an account</a>
                                <?php if(isset($_SESSION['incorrect_login'])){
                                    echo $_SESSION['incorrect_login'];
                                }?>
                            </div>
                            <form class="" action="login.php" method="post">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>

                                <div class="mt-2 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary w-50">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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