<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <script src="https://kit.fontawesome.com/5c0271fbb6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="passwordReset.css">
</head>

<body>
    <div class="form_body">
        <h1>Starling BAGS</h1>
        <div class="container">
            <div class="row fgt_row">
                <div class="col-sm-6 fgt_img">
                    <img src="assets\images\forgot.jpg" alt="forgot">
                </div>
                <div class="col-sm-6 fgt_form">
                    <div class="reset_form mt-2">
                        <form action="" onsubmit="matchPassword()">
                            <h3>Change password</h3>

                            <div class="form-quote_input newpasswrd_blk pt-3">
                                <input type="password" id="pswd1" placeholder=" ">
                                <label id="lb1" for="">New Password</label>
                                <div id="newpasswrd_visible">
                                    <i class="fa-solid fa-eye"></i>
                                    <i class="fa-solid fa-eye-slash"></i>
                                </div>
                                <div class="invalid_psd">Password must be 8 characters.</div>
                            </div>

                            <div class="form-quote_input cfrmpasswrd_blk pt-3">
                                <input type="password" id="pswd2" placeholder=" ">
                                <label id="lb2" for="">Confirm Password</label>
                                <div class="invalid_msg">Password doesn't match.</div>
                            </div>


                            <div class="submit_blk pt-2">
                                <button type="button">Back</button>
                                <input type="submit">
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="passwordReset.js"></script>

</body>

</html>