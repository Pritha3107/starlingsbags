<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
$option = $classobj->getCategories();
$listing_option = $classobj->getlistingCategory();
//print_r($listing_option);$selected_list
$lables_json = '';
$inputs_json = '';
$inputarr = [];
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    if ($product_id != '') {
        $product_details = $classobj->showAllProducts($product_id);
        // print_r($product_details);
        if ($product_details) {
            $rows = $product_details;
            $selected_value = $rows['product_category'];
            // echo '<pre>';
            $selected_list = $rows['product_listing'];
            $lables_json = $rows['editable_lable'];
            $inputs_json = $rows['editable_input'];
            //echo $inputs_json;
            //echo $lables_json;
            //$jsonObject = json_encode(array($lables_json));
            // echo $jsonObject;
            // die();
            if ($lables_json != '') {
                $lablearray = json_decode($lables_json);
                //print_r($lablearray);
            } else {
                $lablearray = [];
            }
            if ($inputs_json != '') {
                $inputarray = json_decode($inputs_json);
                // $str = str_replace(array('"', '[', ']'), '', $inputs_json);
                //echo $str;
                //$remove = str_replace(array('[', ']'), '', $str);
                //echo $remove;
                //array_push($inputarr, $str);
                // $arr = preg_split('/,/', $str);
                $arr = $inputarray;
                //echo '<pre>';
                // print_r($inputarray);
            } else {

                $arr = [];
                //echo $inputarray;
            }

            //die();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./shop_addnew.css">
    <script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>

    <title>Edit Product</title>
</head>
<style>
    .swal2-modal {
        background-color: #04564c !important;
        color: #fff !important;

    }

    #main-image .uploadMainImg,
    .copy-images .uploadCopyImg,
    .copy-img {
        display: block;
    }
</style>

<body>
    <?php include("header.php") ?>

    <div class="body">
        <a href="shop"><button class="btn btn-lg btn-outline-dark">Back</button></a>
        <hr>
        <form class="upload-section needs-validation" method="post" action="" enctype="multipart/form-data" novalidate>

            <div class="default-section row w=100">
                <!-- image section -->
                <div class="image-section-card p-3">
                    <label class="form-label h5">Product Image</label>

                    <div class="image-section">

                        <div class="main-img">
                            <label for="upload-main-img" id="main-image" class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-plus pe-2" style="font-size: 2.1rem; color:rgb(129, 159, 161);"></i>
                                <img src="<?= $rows['product_image']; ?>" alt="" class="uploadMainImg">
                                <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 30px;">
                            </label>
                            <input type="hidden" name='existing_image_file' value="<?= $rows['product_image']; ?>">
                            <label for="upload-main-img" class="label-main-img"><i class="fa-solid fa-cloud-arrow-up"></i> Main img</label>
                            <input type="file" id="upload-main-img" onchange="mainchange()" accept="image/*" name="product_image" class="d-none">
                        </div>

                        <!-- copy-img -->

                        <div class="copy-img">
                            <div style="width: 100%;">
                                <div class="d-flex flex-wrap justify-content-center">
                                    <?php
                                    if (!empty($rows['product_images'])) {
                                        $imagearr = json_decode($rows['product_images']);
                                        //print_r($imagearr);
                                        if (empty($imagearr)) {
                                            echo '
                                                <label class="copy-images">
                                                    <img src="" alt="" class="uploadCopyImg">
                                                    <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                                </label>
                                                <label class="copy-images">
                                                    <img src="" alt="" class="uploadCopyImg">
                                                    <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                                </label>
                                                <label class="copy-images">
                                                    <img src="" alt="" class="uploadCopyImg">
                                                    <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                                </label>
                                                <label class="copy-images">
                                                    <img src="" alt="" class="uploadCopyImg">
                                                    <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                                </label>';
                                        } else {
                                            for ($i = 0; $i<=3; $i++) {
                                                if (!empty($imagearr[$i])) {
                                                    echo '
                                                    <label for="" class="copy-images">
                                                    <img src="' . $imagearr[$i] . '" alt="" class="uploadCopyImg">
                                                    <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                                    </label>
                                                    ';
                                                } else {
                                                    echo '
                                                <label for="" class="copy-images">
                                                    <img src="" alt="" class="uploadCopyImg">
                                                    <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                                </label>
                                                ';
                                                }
                                            }
                                        }
                                    } else { ?>
                                        <label id="copy-images">
                                            <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                        </label>
                                        <label id="copy-images">
                                            <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                        </label>
                                        <label id="copy-images">
                                            <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                        </label>
                                        <label id="copy-images">
                                            <img src="./assets/errorWarning.png" alt="" class="warningIcon" style="width: 25px;">
                                        </label>
                                    <?php }
                                    ?>
                                    <label for="upload-copy-img" class="label-copy-img"><i class="fa-solid fa-cloud-arrow-up pe-2"></i> secondary images</label>
                                </div>
                                <small class="text-danger errorMessage">maximum 4 images only accept</small>
                            </div>
                            <input type="hidden" name='existing_images_file' value='<?= $rows['product_images']; ?>'>
                            <input type="file" name="product_images[]" id="upload-copy-img" onchange="copychange()" accept="image/png, image/jpeg" class="d-none" multiple>
                        </div>
                    </div>
                </div>
                <div class="productname-section-card p-3">
                    <div>
                        <label for="product_name" class="form-label h5">Product Name*</label>
                        <input type="text" class="product-name form-control shadow-none" id='product_name' name="product_name" value="<?= $rows['product_name'] ?>" required>
                        <div class="invalid-feedback">
                            Please enter product name.
                        </div>
                    </div>
                    <div class="category-block">
                        <label for="category" class="form-label h5 pt-3">Category*</label>
                        <select name="product_category" id="category" class="category form-control shadow-none" required>
                            <option value="" selected>Select Category</option>
                            <?php
                            if ($option) {

                                foreach ($option as $result) {
                            ?>
                                    <option value="<?php echo $result['id']; ?>" <?php if ($result['id'] == $selected_value) echo 'selected'; ?>>
                                        <?php echo $result['name_of_category']; ?></option>

                            <?php

                                }
                            } else {
                                echo '<option value="">No Category Found</option>';
                            }
                            ?>
                        </select>
                        <small class="invalid-feedback">
                            Please Choose category.
                        </small>
                    </div>
                    <div>
                        <label for="listing" class="form-label h5 pt-3">Listing</label>
                        <select name="product_listing" id="" class="listing form-control shadow-none">
                            <option value="" selected>Select Listing</option>
                            <?php
                            if ($listing_option) {

                                foreach ($listing_option as $row) {
                            ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $selected_list) echo 'selected'; ?>>
                                        <?php echo $row['name_of_list']; ?></option>

                            <?php

                                }
                            } else {
                                echo '<option value="">No Listing Found</option>';
                            }
                            ?>
                        </select>

                        <!-- </select> -->

                    </div>
                    <div class="description">
                        <label class="form-label h5 pt-3">Description</label>
                        <textarea name="pro_description" class="pro-description form-control shadow-none"><?= $rows['pro_description']; ?></textarea>
                    </div>
                </div>

            </div>



            <div class="editable-inputs">
                <hr>
                <label class="form-label h5 pt-3">Product Info</label>
                <div>
                    <div class="card-row">
                        <?php
                        $arra = $arr;
                        $lable_data = $lablearray;
                        if (!empty(array_keys($lable_data)) && !empty(array_keys($arra))) {
                            $combined_array = array_combine($lable_data, $arra);
                            foreach ($combined_array as $label => $input) {
                                echo '<div class="p-2 inputs card"><label for="" class="form-label fs-6 text-nowrap">' . $label . '</label> <div class="d-flex"><input type="text" class="form-control shadow-none" required value="' . htmlspecialchars($input) . '"name="editable_input[]"><button type="button" class="btn editable-inputs-delete-btn"><i class="fa-solid fa-xmark"></i></button></div></div>';
                            }
                        }
                        ?>
                    </div>
                    <div class="choose-input-type">
                        <div class="d-flex flex-column p-3" style="gap:1rem; background-color: rgb(46, 75, 77);">
                            <input type="text" class="newinputname" id='myinput' placeholder="Input Name">
                            <span class="d-flex justify-content-between">
                                <button class="btn btn-outline-dark input-back text-white" type="button">Back </button>
                                <button class="btn shadow-none createProductInfo text-white" type="button">Add Info</button>
                            </span>
                            <input type="hidden" name='myaction' value="edit">
                        </div>

                        <input type="hidden" name='editable-id' value="<?php echo $product_id; ?>">
                        <input type="hidden" id="text" class="selected-input" name="select-type">
                    </div>
                    <button class="btn btn-outline-dark input-add mt-3" type="button">Create info </button>
                </div>
            </div>


            <div class="d-flex flex-wrap justify-content-end pt-3 text-center">
                <button class="px-2 btn btn-success d-flex align-items-center" type="submit" name='update'><span class="pe-1">Update Product</span>
                    <?php include("../loaderAnimation.php") ?></button>
            </div>
        </form>
    </div>
</body>
<script src="./shop_addnew.js"></script>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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
                        // if (upload_main_img.value == "") {
                        //     mainImageContainer.classList.add('errorStyle')
                        // }
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    $(document).ready(function() {
        // var myArray = [];
        var lableArray = <?php echo json_encode($lablearray); ?>;
        var inputArray = <?php echo json_encode($arr); ?>;

        if (lableArray != null && inputArray != null) {

            if (lableArray.length > 0 && inputArray.length > 0) {
                var html = "";
                for (var i = 0; i < lableArray.length; i++) {
                    html +=
                        `<div class="col-lg-6 col-md-12 col-sm-12  inputs"><label for=""> ${lableArray[i]}</label> <input type="text" required value="${inputArray[i]}"name="editable_input[]"><button type="button" class="btn editable-inputs-delete-btn"><i class="fa-solid fa-trash"></i></button></div>`;
                }
            } else {
                var html = "";
                for (var i = 0; i < lableArray.length; i++) {
                    html +=
                        `<div class="col-lg-6 col-md-12 col-sm-12  inputs"><label for=""> ${lableArray[i]}</label> <input type="text" value="${inputArray[i]}"name="editable_input[]"><button type="button" class="btn editable-inputs-delete-btn"><i class="fa-solid fa-trash"></i></button></div>`;
                }
            }
        };

        $(document).on('submit', '.upload-section', function(e) {
            e.preventDefault();
            $('.btn-success').prop("disabled", true);
            $('.loaderMainContainer').css("display", "inline-block");
            var formData = new FormData(this);
            const lableNames = [];
            $('.inputs').each(function() {
                var labelName = $(this).children('label').text();
                lableNames.push(labelName);
            });
            var queryString = jQuery.param({
                values: lableNames
            });
            console.log(queryString);
            const product_name = document.getElementById("product_name")
            const productnameerror = document.querySelector(".product-name-error")

            const category = document.getElementById("category")
            const categoryerror = document.querySelector(".category-error");

                $.ajax({
                    method: 'POST',
                    url: 'product-controller.php?' + queryString,
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        if (response == false) {
                            Swal.fire({
                                title: 'Oops ?',
                                text: 'Somthing is went to wrong try again..!',
                                icon: 'error',
                                showCloseButton: true,
                            });
                            //alert('Somthing is went to wrong try agin..!');
                            return false;

                        } else {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Your product has been updated successfully!',
                                icon: 'success',
                                confirmButtonText: 'Close',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "shop";

                                }
                            });
                        }
                        $('.btn-success').prop("disabled", false);
                        $('.loaderMainContainer').css("display", "none");
                    }
                });
            // }
        });
        // }
        $(document).on('click', '.editable-inputs-delete-btn', function(e) {
            e.preventDefault();
            //alert('Are want delete this field...!');
            var id = $(this).parents('.inputs');
            // var divId = id.attr("id");
            var inputValue = $(id).find('input').val();
            var labelText = $(id).find('label').text();
            var pId = $("input[name='editable-id']").val();

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
                    $.ajax({
                        url: 'product-controller.php',
                        method: 'GET',
                        data: {
                            action: 'delete input',
                            labletxt: labelText,
                            inputval: inputValue,
                            product_id: pId

                        },
                        success: function(response) {
                            //console.log(response);
                            if (response == 'not updated') {
                                return false;
                            } else {
                                $(id).remove();
                            }
                        }
                    });
                }
            });

        });
    });
</script>