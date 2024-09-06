<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e0a2479f2e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Contact details</title>
    <style>
        .contactDetailsContainer {
            height: 100%;
        }

        .contactDetailsContainer .contactDetailCard {
            width: 100%;
            max-width: 500px;
            background: none;
            border: none;
        }

        .contactDetailCard label {
            font-size: 15px;
            font-weight: bold;
            color: #283638;
        }

        #saveChanges {
            background-color: #283638;
            color: white;
        }

        #saveChanges:hover {
            background-color: #b8b5b5;
            color: #283638;
            transition: .5s;
        }

        #backToDashboard {
            background-color: #b8b5b5;
            color: #283638;
        }

        @media only screen and (min-width:700px) {
            .contactDetailsContainer {
                /* background-color: red; */
                margin-left: 100px;
            }
        }

        .swal2-modal {
            background-color: #04564c !important;
            color: #fff !important;

        }
    </style>
</head>

<body>
    <?php include("header.php") ?>
    <div class="d-flex justify-content-center align-items-center contactDetailsContainer">
        <div class="card contactDetailCard p-4 my-3">
            <h4 class="text-center">Edit Contact Info</h4>
            <small class="text-center pb-3">
                If the input field is disabled, Double click and change the info
            </small>
            <form action="" class="needs-validation" novalidate id="contactform">
                <div class="pb-3 editEvent user-select-none">
                    <label for="contactEmail" class="form-label">Email Id*</label>
                    <input type="email" class="form-control shadow-none" name="email_id" placeholder="example@starlingbagni.co.uk" id="contactEmail" required>
                    <div class="invalid-feedback">
                        Please provide a valid email.
                    </div>
                </div>
                <div class="pb-3 editEvent user-select-none">
                    <label for="contactNumber" class="form-label">Phone Number*</label>
                    <input type="tel" class="form-control shadow-none" name="phone_number" placeholder="+44 (0) 208 459 3260" id="contactNumber" pattern="^[+]? *[0-9][0-9 ]*$" required>
                    <div class="invalid-feedback">
                        Please provide a valid number.
                    </div>
                </div>
                <div class="pb-3 editEvent user-select-none">
                    <label for="adminEmail" class="form-label">Contact, Quote admin Email*</label>
                    <input type="email" class="form-control shadow-none" name="contact_mail" placeholder="example@admin.com" id="adminEmail" required>
                    <div class="invalid-feedback">
                        Please provide a valid email.
                    </div>
                </div>
                <div class="pb-3 editEvent user-select-none">
                    <label for="Facebook" class="form-label">Facebook</label>
                    <input type="text" class="form-control  shadow-none" name="facebook_link" placeholder="https://www.facebook.com" id="Facebook">
                    <div class="invalid-feedback">
                        Please provide a valid link.
                    </div>
                </div>
                <div class="pb-3 editEvent user-select-none">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control shadow-none" name="instagram_link" placeholder="https://www.instagram.com" id="instagram">
                    <div class="invalid-feedback">
                        Please provide a valid link.
                    </div>
                </div>
                <div class="pb-3 editEvent user-select-none">
                    <label for="youtube" class="form-label">Youtube</label>
                    <input type="text" class="form-control shadow-none" name="youtube_link" placeholder="https://www.youtube.com" id="youtube">
                    <div class="invalid-feedback">
                        Please provide a valid link.
                    </div>
                </div>
                <div class="pb-3 editEvent user-select-none">
                    <label for="twitter" class="form-label">Twitter</label>
                    <input type="text" class="form-control shadow-none" name="twitter_link" placeholder="https://www.twitter.com" id="twitter">
                    <div class="invalid-feedback">
                        Please provide a valid link.
                    </div>
                </div>
                <div class="pb-3 editEvent user-select-none">
                    <label for="address" class="form-label">Address</label>
                    <input class="form-control shadow-none" name="address" placeholder="No.2, Northern Ireland, UK" id="address">
                    <div class="invalid-feedback">
                        Please provide a valid Address.
                    </div>
                </div>

                <div class="d-flex justify-content-between pt-3">
                    <button class="btn shadow-none" type="button" id="backToDashboard" onclick="history.back()">Back</button>
                    <button class="btn shadow-none" type="submit" id="saveChanges">Update info</button>
                </div>
                <input type="hidden" name="contactform" value="addcontact">
            </form>
        </div>
    </div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // console.log("jquery");
        fetchContact();

        function fetchContact() {
            $.ajax({
                url: "ajax.php",
                method: "GET",
                dataType: 'json',
                data: {
                    showcontact: "fetchcontactdata"
                },
                success: function(response) {
                    // console.log(response);
                    // console.log(response.socialmedia_links);
                    if (!response) {

                    } else {
                        $("#contactEmail").val(response.email_id);
                        $("#contactNumber").val(response.phone_number);
                        $("#address").val(response.address);
                        $("#Facebook").val(response.facebook_link);
                        $("#instagram").val(response.instagram_link);
                        $("#youtube").val(response.youtube_link);
                        $("#twitter").val(response.twitter_link);
                        $("#adminEmail").val(response.contact_mail);
                        // var urls = JSON.parse(response.socialmedia_links);
                        // // console.log(urls.length);
                        // if (urls.length > 0) {
                        //     for (var i = 0; i < urls.length; i++) {
                        //         // console.log(urls[i]);

                        //     }
                        // }
                        const formControle = document.querySelectorAll(".editEvent");
                        const formTags = document.getElementsByClassName('form-control');
                        for (let i = 0; i < formTags.length; i++) {
                            formTags[i]
                            if (formTags[i].value != "") {
                                formTags[i].disabled = true;
                            }

                        }
                        // console.log(formControle);
                        for (let i = 0; i < formControle.length; i++) {
                            // console.log(formControle[1]);
                            formControle[i].addEventListener("dblclick", () => {
                                console.log(formControle[i].children[1]);
                                // alert(formControle[i].childNodes[1].disabled=false)
                                formControle[i].children[1].disabled = false
                            })

                        }
                    }
                },
                error: function(xhr, status, error) {
                    // console.log(error);
                }
            });
        }

        $(document).on("submit", "#contactform", function(e) {
            e.preventDefault();
            const formdata = new FormData(this);
            // console.log(formdata);

            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    // console.log(response);
                    if (!response) {
                        // console.log("somthing went to wrong");
                        swal.fire({
                            title: "Error",
                            text: 'Somthing went to wrong try agin...!!',
                            icon: "info",
                            confirmButtonText: 'Close'
                        });
                    } else {
                        // console.log("contact add successfully");
                        // alert("contact add successfully");
                        Swal.fire({
                            title: 'Done',
                            text: 'Your contact details added successfully',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = window.location.href;

                            }
                        });
                    }
                }
            });
        });


    });
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    // const formControle = document.querySelectorAll(".editEvent");
    // const formTags = document.getElementsByClassName('form-control');
    // for (let i = 0; i < formTags.length; i++) {
    //     formTags[i]
    //     if (formTags[i].value != "") {
    //         formTags[i].disabled = true;
    //     }

    // }
    // // console.log(formControle);
    // for (let i = 0; i < formControle.length; i++) {
    //     // console.log(formControle[1]);
    //     formControle[i].addEventListener("dblclick", () => {
    //         console.log(formControle[i].children[1]);
    //         // alert(formControle[i].childNodes[1].disabled=false)
    //         formControle[i].children[1].disabled = false
    //     })

    // }
</script>
<script>

</script>