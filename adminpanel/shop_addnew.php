<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
$category_option = $classobj->getCategories();
// print_r($category_option);
$listing_option = $classobj->getlistingCategory();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./shop_addnew.css">
    <script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>

    <title>Add new Product</title>
</head>
<style>
    .swal2-modal {
        background-color: #04564c !important;
        color: #fff !important;

    }
</style>

<body>
    <?php include("header.php") ?>

    <div class="body">
        <a href="shop"><button class="btn btn-lg btn-outline-dark">Back</button></a>
        <hr>
        <!-- <div class="main-section"> -->
        <form class="upload-section needs-validation" method="post" action="" enctype="multipart/form-data" novalidate>

            <div class="default-section row mb-4">
                <!-- mainimg -->
                <div class="image-section-card p-3 ">
                    <label class="form-label h5">Product Image</label>
                    <div class="image-section">

                        <div class="main-img">

                            <label for="upload-main-img" id="main-image" class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-plus pe-2" style="font-size: 2.1rem; color:rgb(129, 159, 161);"></i>
                                <img src="" alt="" class="uploadMainImg">
                                <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 30px;">
                            </label>
                            <label for="upload-main-img" class="label-main-img"><i class="fa-solid fa-cloud-arrow-up pe-2"></i> Main img*</label>
                            <input type="file" id="upload-main-img" onchange="mainchange()" accept="image/*" name="product_image" class="d-none" required>
                            <small class="text-danger errorMessage">please choose image</small>
                        </div>

                        <!-- copy-img -->

                        <div class="copy-img">
                            <div class="" style="width: 100%;">
                                <div class="d-flex flex-wrap justify-content-center">
                                    <label for="" class="copy-images">
                                        <img src="" alt="" class="uploadCopyImg">
                                        <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                    </label>
                                    <label for="" class="copy-images">
                                        <img src="" alt="" class="uploadCopyImg">
                                        <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                    </label>
                                    <label for="" class="copy-images">
                                        <img src="" alt="" class="uploadCopyImg">
                                        <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                    </label>
                                    <label for="" class="copy-images">
                                        <img src="" alt="" class="uploadCopyImg">
                                        <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                    </label>
                                    <label for="upload-copy-img" class="label-copy-img"><i class="fa-solid fa-cloud-arrow-up pe-2"></i> secondary images</label>
                                </div>
                                <small class="text-danger errorMessage">maximum 4 images only accept</small>
                            </div>

                            <input type="file" name="product_images[]" id="upload-copy-img" onchange="copychange()" maxlength="4" accept="image/png, image/jpeg" class="d-none" multiple>
                        </div>
                    </div>

                </div>
                <div class="productname-section-card p-3 ">
                    <div class="product-name-block">
                        <label for="product_name" class="form-label h5">Product Name*</label>
                        <input type="text" class="product-name form-control shadow-none" id="product_name" name="product_name" required>
                        <div class="invalid-feedback">
                            Please enter product name.
                        </div>
                    </div>
                    <div class="category-block">
                        <label for="category" class="form-label h5 pt-3">Category*</label>
                        <select name="product_category" id="category" class="category form-control shadow-none" required>
                            <option value="" selected>Select Category</option>
                            <?php
                            if ($category_option) {

                                foreach ($category_option as $result) {
                            ?>
                                    <option value="<?= $result['id'] ?>"> <?= $result['name_of_category'] ?></option>;
                            <?php

                                }
                            } else {
                                // echo '<option value=""></option>';
                            }
                            ?>
                        </select>
                        <small class="invalid-feedback">
                            Please Choose category.
                        </small>
                        <!-- <input type="text" class="category"> -->
                    </div>

                    <div>
                        <label for="listing" class="form-label h5 pt-3">Listing</label>
                        <select name="product_listing" id="listing" class="listing form-control shadow-none">
                            <option value="" selected>Select Listing</option>
                            <?php
                            if ($listing_option) {

                                foreach ($listing_option as $row) {
                            ?>
                                    <option value="<?= $row['id'] ?>"> <?= $row['name_of_list'] ?></option>;
                            <?php

                                }
                            } else {
                                echo '<option value="">No Listing Found</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="description ">
                        <label for="" class="form-label h5 pt-3">Description</label>
                        <textarea name="pro_description" class="pro-description form-control shadow-none"></textarea>
                    </div>
                </div>


            </div>
            <div class="editable-inputs">
                <hr>
                <label class="form-label h5 pt-3">Product Info</label>
                <div>
                    <!-- custom info container -->
                    <div class="card-row">

                    </div>

                    <div class="choose-input-type">
                        <div class="d-flex flex-column p-3" style="gap:1rem; background-color: rgb(46, 75, 77);">
                            <input type="text" class="newinputname " id='myinput' placeholder="Info Name">
                            <span class="d-flex justify-content-between">
                                <button class="btn btn-outline-dark input-back text-white" type="button">Back </button>
                                <button class="btn shadow-none createProductInfo text-white" type="button">Add Info</button>
                            </span>
                            <input type="hidden" name='action' value="add">
                        </div>
                    </div>
                    <button class="btn btn-outline-dark input-add mt-3" type="button">Create info </button>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-between py-3 text-center">
                <button class="px-2 btn btn-danger clear-btn" type="button">Clear Product</button>
                <button class="px-2 btn btn-success d-flex align-items-center" id="addprodSave" type="submit" name='save'><span class="pe-1">Save Product</span> <?php include("../loaderAnimation.php") ?></button>
            </div>
        </form>
    </div>

    <!-- view image container -->
    <!-- <div class="image-popup-section active">
        <img id="popup-img" src="assets/img7.jpg" alt="">
    </div> -->

</body>
<script src="shop_addnew.js"></script>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        const upload_main_img = document.getElementById("upload-main-img");
        const category = document.querySelector(".category");
        const mainImageContainer = document.querySelector('.main-img');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                        if (upload_main_img.value == "") {
                            mainImageContainer.classList.add('errorStyle')
                        }
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    const categoryerror = document.querySelector(".category-error")
    const productnameerror = document.querySelector(".product-name-error");
    $(document).ready(function() {
        const lableNames = [];
        $(document).on('submit', '.upload-section', function(e) {

            e.preventDefault();
            const product_name = document.getElementById("product_name");
                $('.btn-success').prop("disabled", true);
                $('.loaderMainContainer').css("display", "inline-block");
                //var addForm = $('.upload-section')[0];
                var formData = new FormData(this);
                $('.inputs').each(function() {
                    var labelName = $(this).children('label').text();
                    lableNames.push(labelName);
                });
                var queryString = jQuery.param({
                    values: lableNames
                });
                console.log(queryString);
                $.ajax({
                    method: 'POST',
                    url: 'product-controller.php?' + queryString,
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        // alert(response);
                        if (response == 'error') {
                            Swal.fire({
                                title: 'Oops!',
                                text: 'Product was not added try again..!?',
                                icon: 'error',
                                showCloseButton: true,
                            });
                        } else if (response == 'success') {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Your product added successfully!',
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
            // }

        });





        $(document).on('click', '.editable-inputs-delete-btn', function(e) {
            e.preventDefault();
            //alert('Are want delete this field...!');
            var id = $(this).parents('.inputs');
            var labelText = $(".inputs label").text();

            //console.log(labelText);
            var inputValue = $(".inputs input").val();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                showCloseButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    //console.log('SG');
                    $(id).remove();
                }
            });

        });

        $(document).on('click', '.clear-btn', function() {
            $('.upload-section')[0].reset();
        });
    });
</script>