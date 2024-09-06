<?php
include_once "curd-model.php";
$myfun = new Customers();
if (isset($_POST['singin'])) {
    $email = $myfun->dbConn->real_escape_string($_POST['email_id']);
    $pass = $myfun->dbConn->real_escape_string($_POST['password']);
  if ($myfun->login($email, $pass)) {
        // Redirect to home page on successful login
        header("Location: ./adminpanel/home.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starling bag || Login</title>
    <meta name="robots" content="noindex">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<style>
    .alert.alert-info {
        margin-right: 30px;
        margin-left: 30px;
        text-align: center;
    }
</style>

<body>
    <?php include("header.php") ?>

    <div class="container-fluid">


        <form action="" method="post"  novalidate>
            <div class="user_img">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="card">
                <?php if (isset($_SESSION['status'])) {

                    echo '<div class="alert alert-info">';
                    echo 'Invaild email or password';
                    echo '</div>';
                    unset($_SESSION['status']);
                } ?>
                <div class="form-quote_input">
                    <input type="email" placeholder=" " name="email_id" id="email" required>
                    <label for="email">Email</label>
                    <small>Please enter your email</small>
                </div>
                <div class="form-quote_input mt-2">
                    <input type="password" placeholder=" " name="password" id="password" required>
                    <label for="password">Password</label>
                    <small>Please enter your password</small>
                </div>

                <div class="usr_prfc flex-wrap mt-2 pb-4">
                    <div class="form-check ps-0 pe-2">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <a href="forgotpassword">Forgot Password ?</a>

                </div>
            </div>
            <button type="submit" name='singin' class="signin">LOGIN</button>
        </form>

    </div>
    <?php include("footer.php") ?>

    <script src="login.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // $(document).ready(function(){
        //     $(document).on('click','.signin',function(){
        //         // $(this).prop("disabled", true);
        //         $(".loaderMainContainer").css("display", "inline-block");
        //     });
        // });

    </script>
</body>

</html>