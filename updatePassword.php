<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upadte Password</title>
    <meta name="robots" content="noindex">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5c0271fbb6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="passwordReset.css">
</head>

<body>

    <?php

    require('forgotpwd-model.php');
    $db = new mysqli('localhost', 'starlingbagsni', 'http://starlingbagsni.co.uk/', 'starlingbagsni');
    if (isset($_GET['email']) && isset($_GET['reset_token'])) {
        $email = $_GET['email'];
        $token = $_GET['reset_token'];
        if (empty($email) || empty($token)) {
            echo "
            <script>
                alert('Could not validate your request!!');
                window.location.href='login.php'
            </script>";
        } else {
            $current_date = date("Y-m-d");

            $sql = "SELECT * FROM authentication WHERE email_id = '$email' AND reset_token = '$token' AND expiry_time = '$current_date' ";
            $result = $db->query($sql);
            //print_r($result);
            //die();
            if ($result) {

                if ($result->num_rows > 0) {
                    echo ' <div class="form_body">
                    <h1>STARLING BAGS</h1>
                    <div class="container">
                        <div class="row fgt_row">
                            <div class="col-sm-6 fgt_img">
                                <img src="assets\images\forgot.jpg" alt="">
                            </div>
                            <div class="col-sm-6 fgt_form">
                                <div class="reset_form mt-2">
                                    <form action="" onsubmit="validateform()" method="post" novalidate>
                                        <h3>Change password</h3>
            
                                        <div class="form-quote_input newpasswrd_blk pt-3">
                                            <input type="password" id="pswd1" placeholder=" " minlength="8" name="Password" required>
                                            <label id="lb1" for="">New Password</label>
                                            <div id="newpasswrd_visible">
                                                <i class="fa-solid fa-eye"></i>
                                                <i class="fa-solid fa-eye-slash"></i>
                                            </div>
                                            <div class="invalid_psd">Password must be 8 characters.</div>
                                        </div>
            
                                        <div class="form-quote_input cfrmpasswrd_blk pt-3">
                                            <input type="password" id="pswd2" placeholder=" " onkeyup="validateConPwd()" required>
                                            <label id="lb2" for="">Confirm Password</label>
                                            <div class="invalid_msg">Password doesnt match.</div>
                                        </div>
                                        <input type="hidden" name="email" class="form-control" value=' . $email . '>
                                        <div class="submit_blk pt-2">
                                        <a href="./login.php" class="btn btn-danger">Back</a>
                                        <input type="submit" name="update" value="update">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                    // echo '
                    //     <div class="container d-flex justify-content-center mt-5 pt-5">
                    //         <div class="card mt-5" style="width:500px">
                    //             <div class="card-header">
                    //                 <h1 class="text-center">Creat New Password</h1>
                    //             </div>
                    //             <div class="card-body">
                    //                 <form method="post">
                    //                     <div class="mt-2">
                    //                         <label for="Password">Password : </label>
                    //                         <input type="password" name="Password" class="form-control" placeholder="Creat New Password">
                    //                         <input type="hidden" name="email" class="form-control" value=' . $email . '>
                    //                     </div>
                    //                     <div class="mt-2">
                    //                         <label for="Password">Confirm Password : </label>
                    //                         <input type="password" name="Password" class="form-control" placeholder="Confirm New Password">

                    //                     </div>
                    //                     <div class="mt-4 text-end">
                    //                         <input type="submit" name="update" value="update" class="btn btn-primary">
                    //                         <a href="http://localhost/DJ-BAGS/login.php" class="btn btn-danger">Back</a>
                    //                     </div>
                    //                 </form>
                    //             </div>
                    //         </div>
                    //     </div>';
                } else {
                    echo "
                        <script>
                            alert('invalid or Expired link');
                            window.location.href='./forgotpassword.php'
                        </script>";
                }
            }
        }
    } else {
        echo "
            <script>
                alert('server down!!');
                window.location.href='./index.php'
            </script>";
    }
    if (isset($_POST['update'])) {
        $pass = $_POST['Password'];
        //echo $pass;
        $email = $_POST['email'];
        //echo $email;
        //die();
        $update = "UPDATE authentication SET password='$pass',reset_token='NULL',expiry_time=NULL WHERE email_id = '$email'";

        if ($db->query($update) === TRUE) {
            //print_r($update);
            echo "
                <script>
                    alert('New Password Created Successfully');
                    window.location.href='./login.php'                
                    </script>";
        } else {
            //echo 'query is not executed';
            echo "
                <script>
                alert('Password not updated try again');
                window.location.href='./forgotpassword.php'                     
                </script>";
        }
    }

    ?>
    <script src="passwordReset.js"></script>
</body>

</html>