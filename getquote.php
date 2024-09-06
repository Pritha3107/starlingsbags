<?php

include_once 'curd-model.php';

$object = new Customers();



?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Starling bags-NI | Get a Quote</title>

    <link rel="icon" href="./assets/faviconlogo.svg" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/5c0271fbb6.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="./assets/Coloris-main/dist/coloris.js"></script>

    <link rel="stylesheet" href="./assets/Coloris-main/dist/coloris.css">

    <link rel="stylesheet" href="assets/css/quote.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

    .key {

        /* color: black; */

        font-weight: bold;

        /* font-size: 1.1rem; */

    }



    .dynamic-block {

        display: flex;

        flex-direction: row;

        height: 100%;

        min-height: 200px;

    }



    /* .dynamic-block-img {

            width: 350px;

        }



        .dynamic-block-img img {

            width: 100%;

        } */



    .dynamic-block-img img {

        padding: 10px;

        /* border-style: groove; */

        box-shadow: 0 0px 10px 0 rgba(0, 0, 0, 0.2);

        background-size: cover;

        object-fit: contain;

    }



    @media screen and (max-width:630px) {

        .dynamic-block {

            display: flex;

            flex-direction: column;

        }





    }



    @media screen and (max-width:350px) {

        .form_content {

            padding: 10px 5px 10px 5px;

        }



        .dynamic-block-img {

            min-width: 100px;

        }



        .dynamic-block-img img {

            width: 100%;

        }

    }



    @media screen and (max-width:330px) {

        .dynamic-block {

            display: flex;

            flex-direction: column;

        }



        .product-dtls-block h6 {

            width: 100% !important;



        }



    }



    .product-dtls-block {

        height: 100px;

        position: relative;



    }



    .productDiscriptionCon {

        padding-bottom: 20px;

    }



    .productDiscriptionCon small {

        line-height: 18px;

    }



    .readMoreStyle {

        -webkit-mask-image: linear-gradient(to top, transparent -50%, black 40%);

        mask-image: linear-gradient(to top, transparent -50%, black 40%);

    }



    .productDiscriptionCon .readMoreBtn {

        position: absolute;

        bottom: 0;

        right: 3%;

        background: none;

        border: none;

        color: blue;

        background-color: white;

        padding: 0 5px;

        /* opacity: 1; */

    }

    </style>



</head>



<body onload="fetchProductFormData()">



    <?php include("header.php") ?>



    <div class="get_quote">

        <h1>Quote</h1>



        <div class="form_content">



            <div class="text-center">

                <h3>Get A Quote</h3>

                <p>Fill out the form, and we'll send you an initial quote at the earliest</p>

            </div>

            <?php

            if (isset($_GET['proid']) && !empty($_GET['proid'])) {

                $prodct_data =  $object->getProductDetails($_GET['proid']);

                $data = $prodct_data['product_image'];

                // print_r($prodct_data);

                $json = json_decode($prodct_data['editable_lable']);

                //print_r($json);

                $json_input = json_decode($prodct_data['editable_input']);

            ?>

            <form action="" method="post" enctype="multipart/form-data"

                class="d-flex justify-content-center flex-wrap quoteformaction" onsubmit="validateform()" novalidate>



                <div class="dynamic-block m-2 mt-4 mb-4 w-100 ">

                    <div class="m-3 dynamic-block-img">

                        <img src="adminpanel/<?= $data; ?>" alt="" srcset="" height="180" width="250">

                    </div>

                    <div class="m-3 w-100">

                        <div>

                            <h4><?= $prodct_data['product_name'] ?></h4>

                        </div>

                        <hr class="w-auto">

                        <div>

                            <div class="product-dtls-block">

                                <?php

                                    if (!empty($json) && !empty($json_input)) {

                                        echo '<div class="productDiscriptionCon ">';

                                        echo '<button type="button" class="readMoreBtn d-none shadow-none "><small class="fst-italic">read more</small></button>';

                                        $combined_array = array_combine($json, $json_input);

                                        foreach ($combined_array as $label => $input) {

                                            echo '<small class="pb-1 d-block "> <span class="key">' . $label . ' :</span> <span>' . $input . '</span></small>';

                                        }

                                        echo '</div>';

                                    } else {

                                        echo '<h5></h5>';

                                    }

                                    ?>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="form-quote_input m-2">

                    <input type="text" placeholder=" " name="name_of_company" id="companyName" required>

                    <label for="companyName">Company Name *</label>

                    <small>Please enter your company name.</small>

                </div>



                <div class="form-quote_input m-2">

                    <input type="text" name="cust_name" placeholder=" " id="cusromerName"  required>

                    <label for="cusromerName">Name *</label>

                    <small>Please enter your name.</small>

                </div>



                <div class="form-quote_input m-2">

                    <input type="Email" name='cust_email' placeholder=" " id="customerEmail"  required>

                    <label for="customerEmail">Email *</label>

                    <small>Please enter your email address.</small>

                </div>



                <div class="form-quote_input m-2">

                    <input type="tel" placeholder=" " name="cust_phno" minlength="10" maxlength="11" id="customerPhone" pattern="[0-9]+" required>

                    <label for="customerPhone">Phone number *</label>

                    <small>Please enter your phone number.</small>

                </div>

                <div class="form-quote_input m-2 w-100">

                    <input type="number" placeholder=" " name="bag_qty" min="100" id="productQty" required>

                    <label for="productQty">Quantity *</label>

                    <small>Minimum quantity is 100.</small>

                </div>
                <!-- CUSTOM CONTAINER -->
                <div class="p-2 w-100 h-auto" id="additionalInputDiv">
                    <div class="h5 text-center pb-2 mt-4 mb-3">Choose Additional Option</div>
                    <div id="checkBoxContainer" class="d-flex justify-content-center  flex-wrap"></div>
                    <div id="cusInput">

                    </div>
                </div>

                <br>
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

                        accept="image/*,.doc, .docx, .pdf, .tex" multiple onchange="uploadimg()">

                    <label for="upload" class="shadow p-2 px-3">

                        <i class="fa-sharp fa-solid fa-cloud-arrow-up fs-4"></i>

                        <span class="fs-6 mx-1">Upload</span>

                    </label>

                    <p id="uplname"> </p>

                </div>

                <input type="hidden" name="product_id" value="<?= $_GET['proid'] ?>">
                <input type="hidden" name="additional_label_info[]" id='additional_label_info'>

                <br><br>



                <div class="d-flex justify-content-between w-100 m-2">

                    <a href="./shop.php" type="button" class="btn bk">Back</a>

                    <button type="submit" name="submit" class="btn quoteSubmit d-flex align-items-center"><span

                            class="pe-1">Submit</span> <?php include("./loaderAnimation.php") ?></button>

                </div>

            </form>

            <?php } else {

                header("Location:404.php");

            }

            ?>



        </div>



    </div>

    <?php include("footer.php") ?>

</body>
<script src="./quote.js"></script>
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
    });

});
const productBlock = document.querySelector('.product-dtls-block');
const productDiscriptionCon = document.querySelector('.productDiscriptionCon');
const readMoreBtn = document.querySelector('.readMoreBtn')
if (productBlock.clientHeight < productDiscriptionCon.clientHeight) {
    productBlock.classList.add('readMoreStyle');
    readMoreBtn.classList.remove('d-none');
    readMoreBtn.classList.add('d-block');
    readMoreBtn.addEventListener('click', () => {
        if (productBlock.clientHeight == 100) {
            productBlock.style.height = "100%";
            productBlock.classList.remove('readMoreStyle');
            readMoreBtn.childNodes[0].innerText = "hide"
        } else {
            productBlock.style.height = "100px";
            productBlock.classList.add('readMoreStyle');
            readMoreBtn.childNodes[0].innerText = "read more"
        }
    })
}
</script>


</html>