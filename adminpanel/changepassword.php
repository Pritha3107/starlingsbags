<?php
// require_once 'curd-model.php';
// $classobj = new Customers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./shop_addnew.css">


    <link rel="stylesheet" href="changepassword.css">
    <title>Change password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>

</head>
<style>
    .errorinput {
        border: 1px solid red;
        /* background-color: #ffdddd; */
        color: red;
    }

    .errortext {
        color: red;
    }
</style>

<body>
    <?php include("header.php") ?>

    <div class="body">

        <!-- <div class="main-section"> -->
        <form method="post" action="" id='changepasswordform'>

            <div class="row change-password-block d-flex justify-content-center">
                <div class="card  change-password-block-card col-lg-5 col-md-8 col-sm-12 d-flex flex-column justify-content-center">
                    <div class="card-header text-center p-3">
                        <h3>Change Password</h3>
                    </div>
                    <div class="card-body px-4 d-flex justify-content-center">
                        <div>

                            <label for="" class="old-password mt-4 mb-3">Old password</label>
                            <input type="password" class="old-password-input w-100" placeholder="Enter your old password"> <br>
                            <span id="oldpassworderror"></span><br>
                            <label for="" class="new-password mb-3">New password</label>
                            <input type="password" class="new-password-input w-100" name='newpassword' placeholder="Enter your new password"> <br>
                            <label for="" class="confirm-password mb-3 ">Confirm password</label>
                            <input type="password" class="confirm-password-input  w-100" name='confirmpassword' placeholder="Confirm your new password">
                        </div>
                    </div>
                    <input type='hidden' value="changepassword" name='formaction'>
                    <div class="card-footer d-flex justify-content-around p-4">

                        <a href="./dashboard.php" class="change-password-back-btn w-50 btn  btn-outline-danger">
                            back
                        </a>

                        <button class="change-password-submit-btn w-50 btn  btn-outline-success" type="submit">
                            Submit
                        </button>

                    </div>

                </div>
            </div>
        </form>
    </div>
</body>

</html>
<style>
    .swal2-modal {
        background-color: #04564c !important;
        color: #fff !important;

    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $(".new-password-input").prop("disabled", true);
        $(".confirm-password-input").prop("disabled", true);
        var userid = '<?php echo $_SESSION['id']; ?>';
        //console.log(userid);
        $(document).on('keyup', '.old-password-input', function() {
            var oldpassVal = $(this).val();
            //console.log(oldpassVal);
            $.ajax({
                url: "ajax.php",
                method: "GET",
                data: {
                    userId: userid,
                    req: 'chack old Password',
                },
                success: function(response) {
                    //console.log(response);
                    if (response != oldpassVal) {
                        $('.old-password-input').addClass("errorinput");
                        $('#oldpassworderror').addClass("errortext");
                        $('#oldpassworderror').text('your oldpassword doesnt match...!!!');
                        $(".new-password-input").prop("disabled", true);
                        $(".confirm-password-input").prop("disabled", true);
                    } else {
                        $(".new-password-input").prop("disabled", false);
                        $(".confirm-password-input").prop("disabled", false);
                        $('#oldpassworderror').text("");
                        $('.old-password-input').removeClass("errorinput");
                        $('#oldpassworderror').removeClass("errortext");
                    }
                }
            });
        });
        $(document).on('submit', '#changepasswordform', function(e) {

            const newpassword = $('.new-password-input').val().trim();
            const confirmpassword = $('.confirm-password-input').val().trim();
            const oldpassword = $('.old-password-input').val().trim();
            // var trimmednewpassword = newpassword.trim();
            // var trimmedconfirmpassword = confirmpassword.trim();
            if (oldpassword == '') {
                $('#oldpassworderror').text('Old password fields is required');
                $('.old-password-input').addClass("errorinput");
                $('#oldpassworderror').addClass("errortext");
                return false;
            } else if (newpassword == '') {
                // alert('New password fields is required');
                $('.new-password-input').addClass("errorinput");
                return false;
            } else if (confirmpassword == '') {
                // alert('Confirm password fields is required');
                $('.confirm-password-input ').addClass("errorinput");
                return false;
            } else if (newpassword.length < 5) {
                // alert('New password must be 8 characters or more');
                $('.new-password-input').addClass("errorinput");
                return false;
            } else if (confirmpassword != newpassword) {
                // alert('Confirm password must be match to new password');
                $('.confirm-password-input ').addClass("errorinput");
                return false;
            } else {

                //$('#changepasswordform')[0].submit();
                var formdata = new FormData(this);
                //console.log(formdata);
                e.preventDefault();
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        //console.log(response);
                        if (response == 'ok') {
                            Swal.fire({
                                title: 'Done',
                                text: 'Your Password has been changed successfully!',
                                icon: 'success',
                                confirmButtonText: 'Close'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = window.location.href;

                                }
                            });
                        } else {
                            swal.fire({
                                title: "Error",
                                text: 'Somthing went to wrong try agin...!!',
                                icon: "info",
                                confirmButtonText: 'Close'
                            });
                        }
                    }
                });
            }
        });
    });
</script>