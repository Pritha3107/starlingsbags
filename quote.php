<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Starling bags-NI | Quote</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/5c0271fbb6.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="./assets/Coloris-main/dist/coloris.js"></script>

    <link rel="stylesheet" href="./assets/Coloris-main/dist/coloris.css">

    <link rel="stylesheet" href="assets/css/quote.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

    <link rel="icon" href="./assets/faviconlogo.svg" type="image/x-icon">

    <meta property="og:site_name" content="Starling bags-NI | Personalized Bags" />

    <meta property="og:title" content="Starling bags-NI | customizable bags, promotional bags, eco-friendly bags" />

    <meta property="og:image" content="https://starlingbagsni.co.uk/assets/starlinglogo.svg" />

</head>



<body onload="fetchNormalFormData()">



    <?php include("header.php") ?>



    <div class="get_quote">

        <h1>Quote</h1>



        <div class="form_content">



            <div class="text-center">

                <h3>Get A Quote</h3>

                <p>Fill out the form, and we'll send you an initial quote at the earliest</p>

            </div>



            <!-- <form action="quoteformaction.php" method="post" enctype="multipart/form-data" class="d-flex justify-content-center flex-wrap quoteform" onsubmit="validateform()" novalidate> -->



            <form action="" method="post" enctype="multipart/form-data"

                class="quoteformaction d-flex justify-content-center flex-wrap" onsubmit="validateform()" novalidate>





                <div class="form-quote_input m-2">

                    <input type="text" name="name_of_company" placeholder=" " id="companyName" required>

                    <label for="companyName">Company Name *</label>

                    <small>Please enter your company name.</small>

                </div>



                <div class="form-quote_input m-2">

                    <input type="text" name="cust_name" placeholder=" " id="cusromerName" required>

                    <label for="cusromerName">Name *</label>

                    <small>Please enter your name.</small>

                </div>



                <div class="form-quote_input m-2">

                    <input type="Email" name='cust_email' placeholder=" " id="customerEmail" required>

                    <label for="customerEmail">Email *</label>

                    <small>Please enter your email address.</small>

                </div>



                <div class="form-quote_input m-2">

                    <input type="tel" name="cust_phno" placeholder=" " minlength="10" maxlength="11" id="customerPhone" pattern="[0-9]+" required>

                    <label for="customerPhone">Phone number *</label>

                    <small>Please enter your phone number.</small>

                </div>

                <div class="form-quote_input m-2 w-100">

                    <input type="number" name="bag_qty" placeholder=" " min="100" id="productQty" required>

                    <label for="productQty">Quantity *</label>

                    <small>Minimum quantity is 100.</small>

                </div>

                <!-- CUSTOM CONTAINER -->

                <div class="p-2 w-100 h-auto" id="additionalInputDiv">

                    <div class="h5 text-center pb-2 mt-4 mb-4">Choose Additional Option</div>

                    <div id="checkBoxContainer" class="d-flex justify-content-center pt-3 flex-wrap"></div>
                    <div id="cusInput">
                    </div>

                </div>
                <small class="me-auto ps-2" style="color:#022C43;">Any additional requirements like zip, gusset, tassel,
                    print? Mention them here.</small>
                <div class="form-quote_input m-2 w-100">
                    <textarea name="cust_message" id="message" placeholder=" "></textarea>
                    <label for="message">Additional Information</label>
                </div>

                <br>
                <div class="form-check upl w-100 m-2">

                    <p>Upload your design</p>

                    <input type="file" name="referance_image[]" class="d-none file_load" id="upload"

                        onchange="uploadimg()" accept="image/*,.doc, .docx, .pdf, .tex" multiple>

                    <label for="upload" class="shadow p-2 px-3">

                        <i class="fa-sharp fa-solid fa-cloud-arrow-up fs-4"></i>

                        <span class="fs-6 mx-1">Upload</span>

                    </label>

                    <p id="uplname"> </p>

                </div>

                <input type="hidden" name="additional_label_info[]" id='additional_label_info'>

                <br><br>



                <div class="d-flex justify-content-between w-100 m-2">

                    <button type="button" class="btn back"><a href="index.php">Back</a></button>

                    <button type="submit" name="submit" class="btn quoteSubmit d-flex align-items-center"><span

                            class="pe-1">Submit</span> <?php include("./loaderAnimation.php") ?></button>

                </div>

            </form>

        </div>



    </div>

    <?php include("footer.php") ?>

    <!--<script src="./quoteScript.js"></script>-->

</body>

<script src="quote.js"></script>



</html>

<script>
$(document).ready(function() {
    $(document).on('submit', '.quoteformaction', function() {
        const mainDivId = document.getElementById("cusInput");
        const labelColloection = mainDivId.getElementsByTagName("label");
        let labelNames = [];
        let trimedLabels;
        let labelinputValues = [];
        let checkBoxInputContainer = document.getElementById("checkBoxContainer");
        let checkBoxInput = checkBoxInputContainer.getElementsByTagName('input');
        for (let ci = 0; ci < checkBoxInput.length; ci++) {
            if (checkBoxInput[ci].checked == true) {
                let checkBoxValue = checkBoxInput[ci].parentElement.children[1].innerText;
                labelNames.push(checkBoxValue);
            }
        }
        for (let lb = 0; lb < labelColloection.length; lb++) {
            const element = labelColloection[lb];
            const inputIdValues = element.innerText;
            labelNames.push(inputIdValues);
        }
        $('#additional_label_info').val(labelNames);

        //MANO/ Added Popup code to display success message for the quote submission
        Swal.fire({
            title: "Your Quote has been submitted successfully !!!",
            text: "We will reach out to you as soon as possible.",
            icon: "success",
            confirmButtonText: 'Close'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.reload();
            }
        });

    });

});
</script>