<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starling Bag || ForgetPassword</title>
    <meta name="robots" content="noindex">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<style>
    .swal2-modal {
        background-color: #e8f0f0 !important;
        color: #000 !important;

    }
</style>

<body>
    <?php include("header.php") ?>
    <div class="container-fluid">
        <form class="forgotpassword" method="post" onsubmit="validateform()" novalidate>
            <div class="user_img">
                <i class='fas fa-user-lock' style='font-size:50px;'></i>
            </div>

            <div class="card">
                <div class="form-quote_input pb-3 mt-4">
                    <input type="email" placeholder=" " name="email_id" id="emailaddress" required>
                    <label for="emailaddress">Email</label>
                    <small>Please enter your email</small>

                </div>

            </div>
            <button type="submit" name='send' class='forpasssubbtn d-flex align-items-center'><span class="pe-2">SEND</span> <?php include("./loaderAnimation.php") ?></button>

        </form>

    </div>

    <?php include("footer.php") ?>

    <script>
        function validateform() {

            var form = document.querySelector('form');

            if (!form.checkValidity()) {
                event.preventDefault();
                form.classList.add('was_validate');
            }
        }
    </script>

</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        // function resetForm() {
        //     $("#forgotpassword")[0].reset();
        // }
        $(document).on('submit', '.forgotpassword', function(e) {
            e.preventDefault();
            var emailAddress = $('#emailaddress').val();
            //console.log(emailAddress);
            //var formdata = new FormData(this);
            //console.log(formdata);
            if (emailAddress == '') {
                return false;
            } else {
                $('.forpasssubbtn').prop('disabled', true);
                $(".loaderMainContainer").css("display", "inline-block");
                $.ajax({
                    url: "ajaxcallfunctions.php",
                    method: "GET",
                    data: {
                        request: "send mail",
                        email: emailAddress
                    },
                    success: function(response) {
                        $(".forpasssubbtn").prop("disabled", false);
                        $(".loaderMainContainer").css("display", "none");
                        //console.log(response);
                        if (response == true) {
                            //console.log('mail send successfully');
                            Swal.fire({
                                title: "Good Job",
                                text: "An email with instructions to reset your password has been sent to your email address.",
                                icon: "success",
                                confirmButtonText: 'Close'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = window.location.href;

                                }
                            });
                            $(this).prop('disabled', false);
                        } else {
                            //console.log('try again');
                            Swal.fire({
                                title: "warning",
                                text: "Please Provide an vaild email address !!!",
                                icon: "warning",
                                confirmButtonText: 'Close'
                            });
                        }
                    }
                });
                //console.log('no email address');
            }
        });
    });
</script>