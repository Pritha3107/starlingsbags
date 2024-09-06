<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
$lables = '';
if (isset($_GET['orderid']) && !empty($_GET['orderid'])) {

    $orderId = $_GET['orderid'];
    $orderDetailsData =  $classobj->getOrderByOderid($orderId);
    $lables = $orderDetailsData['additional_label_info'];
    $inputValues = $orderDetailsData['additonal_input_groups'];
    $colors = $orderDetailsData['colors'];
} else {
    $orderDetailsData = '';
}
// echo '<pre>';
// die();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="order_details.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <title>order_details</title>
</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <a href="./order"><button class="btn btn-lg btn-outline-dark">BACK</button></a>
        <?php
        if (!empty($orderDetailsData)) {
            $datetime = $orderDetailsData['crated_at'];
            $timestamp = strtotime($datetime);
            $formattedDate = date('M d, Y', $timestamp);
            $formattedTime = date('h:i A', $timestamp);
            $productid =  $orderDetailsData['product_id'];
            // $image =  $orderDetailsData['referance_image'];
            // echo $image;
            if (!empty($productid)) {
                $productData = $classobj->showAllProducts($productid);
                // print_r($productData);
                if ($productData) {

                    $productName = $productData['product_name'];
                    $productImage = $productData['product_image'];
                    $productDescrption = $productData['pro_description'];
                } else {
                    $productName = "This may be a deleted product!";
                    $productImage = "";
                    $productDescrption = "This may be a deleted product!";
                }
            }
        ?>
        <div class="card order-details-card">
            <!-- <a class="btn btn-lg btn-outline-dark" href="download.php?file=' . $orderDetailsData['referance_image'] . ' ">Attachments <i class="fa-solid fa-file-arrow-down"></i></a> -->
            <div class="card-header">
                <h4>Order ID: <span class="order-details-id"><?= $orderDetailsData['order_id'] ?></span></h4>
                <?php if (!empty($productid)) { ?>
                <h4>Product Code: <span class="order-details-id"><?= $orderDetailsData['product_code'] ?></span></h4>
                <?php } ?>
                <div class="details-date-time">
                    <span class="details-date"><?= $formattedDate ?></span><br>
                    <span class="details-time"><?= $formattedTime ?></span>
                </div>
            </div>
            <div class="card-body">
                <h5><span class="details-user-name"><?= $orderDetailsData['cust_name'] ?></span>
                    <span class="details-mail-id" title="Click to copy!"><?= $orderDetailsData['cust_email'] ?></span>
                </h5>

                <hr>
                <div class="details-product-block">
                    <?php if (!empty($productid)) { ?>
                    <div class="details-img-block">
                        <div class="details-product-image">
                            <img src="<?= $productImage ?>" alt="" class="details-product-main-image">
                        </div>
                    </div>
                    <?php } ?>
                    <div class="details-product-info">
                        <?php if (!empty($productid)) { ?>
                        <div class="details-product-name-block">
                            <h5 class="details-product-name"><?= $productDescrption ?></h5>
                        </div>
                        <hr>
                        <?php } ?>
                        <div class="customer-details">
                            <h5 class="customer-details-title">PRODUCT DETAILS</h5>
                            <p><label class="company-name opt">Company Name</label>
                                <span><?= $orderDetailsData['name_of_company'] ?></span>
                            </p>
                            <p><label class="user-mobile-no opt">Phone Number</label>
                                <span><?= $orderDetailsData['cust_phno'] ?></span>
                            </p>
                            <?php if (!empty($productid)) { ?>
                            <p><label class="fabric-option opt">Product Name</label>
                                <span><?= $productName ?></span>
                            </p>
                            <?php }
                        $resultArray = array();
                        $newArray = array();
                        // print_r($additionalInputvalues);
                        $additionalInputvalues =  $orderDetailsData['additonal_input_groups'];
                        // echo $additionalInputvalues;
                        if (!empty($lables) && !empty($additionalInputvalues) && $additionalInputvalues != '') {
                            // echo '';
                            // echo 'ok';
                            $str = str_replace(array('"', '[', ']'), '', $lables);
                            $labelArray = explode(",", $str);
                            // echo '<pre>';
                            // print_r($labelArray); // piece1
                            // $labelArray = json_decode($lables);
                            $inputArray = json_decode($additionalInputvalues);
                            // echo '<pre>';
                            // print_r($inputArray);
                            // foreach ($inputArray as $value) {
                            //     echo  $value;
                            // }
                            $resultArray = array_combine($labelArray, $inputArray);
                            // unset($resultArray['color']);
                            // unset($resultArray['colour']);
                            // unset($resultArray['colors']);
                            // unset($resultArray['colours']);

                            // unset($resultArray['Color']);
                            // unset($resultArray['Colour']);
                            // unset($resultArray['Colors']);
                            // unset($resultArray['Colours']);

                            // unset($resultArray['COLOR']);
                            // unset($resultArray['COLORS']);
                            // unset($resultArray['COLOUR']);
                            // unset($resultArray['COLOURS']);
                            // print_r($resultArray);

                            foreach ($resultArray as $key => $value) {
                                // if ($key == "color" || $key == "colour") {

                                // }
                                if ($value !== "") {
                                    echo '<p><label class="fabric-option opt">' . $key . '</label><span>' . $value . '</span>';
                                }
                            }
                            $colorArr =  json_decode($colors);
                            if (!empty($colorArr)) {
                                // echo '<div class="d-flex ">';
                                echo '<p><label class="fabric-option opt">Color</label>';
                                echo '<span class="d-inline">';
                                foreach ($colorArr as $color) {
                                    if (!empty($color)) {

                                        echo ' <span type="button" class="me-3 mb-2 coloursInput tooltips" name="favcolor" style="background-color:' . $color . ';"><span class="tooltiptext"><span>' . $color . '</span><span class="d-none">Copied..</span></span></span>';
                                    }
                                }
                                echo '</span>';
                                echo '</p>';
                            }
                        }
                        // print_r(gettype($colors));
                        else {
                            // echo '';
                            // die();
                            // echo $lables;
                        }

                        echo '<p><label class="fabric-option opt">Bag Qty</label>';
                        echo '<span>' . $orderDetailsData["bag_qty"] . '</span>';
                        echo '</p>';
                        if (!empty($orderDetailsData['cust_message'])) {
                            echo '<p><label class="fabric-option opt">Customer Message</label>';
                            echo '<span class="text-break">' . $orderDetailsData["cust_message"] . '</span>';
                            echo '</p>';
                        }
                        ?>
                        </div>
                    </div>

                </div>
                <div>
                    <hr />
                    <?php
                if (empty($orderDetailsData['referance_image'])) {
                    echo 'No attachments';
                } else {
                    $imageData = json_decode($orderDetailsData['referance_image']);
                    echo '<h3 style="color:#00bb9f;">Attachment files <i class="fa-solid fa-paperclip"></i></h3>
                                <div class="ownDisignMainContainer">';
                    // print_r($imageData);
                    foreach ($imageData as $image) {
                        $file_ext = pathinfo($image, PATHINFO_EXTENSION);
                        // $file_path = ;
                        $filename = basename($image);

                        // echo $filename;

                ?>

                    <span class="ownDisignContainer border">
                        <?php

                            if ($file_ext == 'pdf' || $file_ext == 'txt' || $file_ext == 'docx') {
                                echo '<i class="fa-solid fa-file-pdf"></i>';
                            } else {
                                echo '<i class="fa-solid fa-image pe-2"></i>';
                            }
                            ?>
                        <div>
                            <span class=""><?= $filename;  ?></span> <br />
                            <small><a href="../<?= $image ?>" download>Download</a></small>
                        </div>
                    </span>
                    <?php }
                }

                ?>

                </div>
            </div>
        </div>
    </div>
    <?php
        } else {
            echo '404 ERROR PAGE';
        }
?>

    </div>
    <div class="image-popup active">
        <div class="image-popup-block   ">

            <img src="./assets/img7.jpg" alt="" srcset="" class="popup-image">

        </div>
    </div>
    <script>
    // const coloursInput=document.querySelector('.coloursInput')
    const detailsproductmainimage = document.getElementsByClassName("details-product-main-image")
    const sampleimg = document.getElementsByClassName("sample-img")

    const imagepopup = document.querySelector('.image-popup')
    const popupimage = document.querySelector('.popup-image')

    for (let i = 0; i < sampleimg.length; i++) {

        sampleimg[i].onclick = function() {
            console.log("hjvh");
            detailsproductmainimage[0].src = sampleimg[i].src;
        }

    }
    if (detailsproductmainimage[0]) {
        detailsproductmainimage[0].onclick = function() {
            console.log("jbj");
            popupimage.src = detailsproductmainimage[0].src
            imagepopup.classList.remove('active')
        }

    }

    popupimage.onclick = function() {
        imagepopup.classList.add('active')
    }
    popupimage.onclick = function() {
        imagepopup.classList.add('active')
    }
    $(function() {
        $(document).tooltip;
    });
    $('.details-mail-id').click(function() {
        // this.innerText;
        navigator.clipboard.writeText(this.innerText);
        alert('Copied!');

    });

    // copy color code function
    const coloursInput = document.getElementsByClassName("coloursInput");
    for (let i = 0; i < coloursInput.length; i++) {
        coloursInput[i].addEventListener('click', (e) => {
            console.log(coloursInput[i].childNodes[0].childNodes[0].innerText);
            navigator.clipboard.writeText(coloursInput[i].childNodes[0].childNodes[0].innerText);
            coloursInput[i].childNodes[0].childNodes[0].style.display = "none";
            coloursInput[i].childNodes[0].childNodes[1].classList.remove('d-none');
            // coloursInput[i].childNodes[0].innerText="Copied.."
            setInterval(() => {
                coloursInput[i].childNodes[0].childNodes[0].style.display = "block";
                coloursInput[i].childNodes[0].childNodes[1].classList.add('d-none');
            }, 1000);
        })

    }
    </script>
</body>

</html>