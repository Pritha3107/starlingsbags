<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">

    <title>HOME</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>

</head>

<body>

    <?php include("header.php") ?>

    <div class="body">
        <h2 style="color:#283638" class="p-3">ADMIN HOME</h2>
        <div class="categories-section">
            <h2 class="categories-title text-center">CATEGORIES</h2>

            <div class="add-categories-button d-flex justify-content-center">
                <button class="btn btn-lg btn-outline-dark add-categories-btn ">Add Categories</button>
            </div>

            <div class="row categories-row text-center">

                 <div class="card lang-text-box col-lg-2 col-md-3 col-sm-4 col-6 m-3">
                    <div class="card-header">
                        <h4>cotton bags</h4>
                    </div>
                    <div class="card-body lang-box">
                        <img src="assets/img7.jpg" alt="" height="200" style="height: 200px; object-fit: contain;">
                    </div>
                    <div class="card-foot text-box d-flex justify-content-evenly">

                        <button class="btn btn-outline-dark added-categories-edit-btn">Edit</button>
                        <button class="btn btn-outline-dark added-categories-delete-btn">Delete</button>
                    </div>
                </div> 

               <div class="card col-lg-2 col-md-3 col-sm-4 col-6 m-3">
                    <div class="card-header">
                        <h4>leather bags</h4>
                    </div>
                    <div class="card-body">
                        <img src="assets/img6.jpg" alt="" height="200">
                    </div>
                    <div class="card-foot d-flex justify-content-evenly">
                        <button class="btn btn-outline-dark added-categories-edit-btn">Edit</button>
                        <button class="btn btn-outline-dark added-categories-delete-btn">Delete</button>
                    </div>
                </div> 

            </div>



            <!-- added-categories-edit-popup -->



            <div class="row add-categories-edit-popup edit-popup text-center">
                <form class="card col-lg-4 col-md-6 col-sm-6 add-categories-edit-popup-card edit-popup-card active" id='editcatform' method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <input type="text" class="add-categories-edit-title mt-4" name='name_of_category'>
                    </div>
                    <input type='hidden' value="" name='oldimage' id='image'>
                    <input type='hidden' value="" name='editid' id='id'>
                    <div class="card-body d-flex justify-content-center text-center w-100">

                        <input type="file" name="image_of_category" id="uploadaddcategorieseditimg" onchange="categoriesuploadeditimg()" class="add-categories-edit-img" accept="image/*">

                        <label for="uploadaddcategorieseditimg" class="add-categories-edit-label "> <i class="fa-solid fa-cloud-arrow-up"></i><br> <span class="edit-upload-text"> upload image</span> <span class="edit-uploaded-text ">uploaded</span> </label>
                    </div>
                    <input type='hidden' value="editcat" name="editaction">
                    <div class="card-footer mb-4">
                        <button class="btn btn-outline-danger add-categories-edit-popup-discard-btn" id='discard-btn'>Discard</button>
                        <button class="btn btn-outline-success add-categories-edit-popup-change-btn d-flex align-items-center" id='edit-btn' type='submit'><span class="pe-1">change</span> <?php include("../loaderAnimation.php") ?></button>
                    </div>
                </form>
            </div>


            <!-- added-categories-delete-popup -->


           <div class="row added-categories-delete-popup delete-popup text-center">
                <div class="card col-lg-4 col-md-6 col-sm-6 added-categories-delete-popup-card delete-popup-card active">
                    <div class="card-body">
                        <h4>Are you sure you want to delete "<span>Best seller</span>" listing ?</h4>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-danger added-categories-delete-popup-no-btn ">NO</button>
                        <button class="btn btn-outline-success added-categories-delete-popup-yes-btn">YES</button>
                    </div>
                </div>
            </div> 




            <div class=" add-categories-popup active">
                <form class="card add-categories-popup-card " id="catForm" method="post" enctype="multipart/form-data">
                    <div>
                        <div class="card-header">
                            <input type="text" class="add-categories-title form-control shadow-none " name="name_of_categoryadd" placeholder="Enter Category Name" onkeyup="removeInvalidText()">
                        </div>
                         <div class="card-body text-center">
                            <input type="file" id="upload-add-categories-img" name="image_of_category" onchange="categoriesuploadimg(),removeInvalidContainer()" class="add-categories-img" maxlength="1" accept="image/*">
                            <label for="upload-add-categories-img" class="imgShowCon d-flex justify-content-center align-items-center text-secondary"><i class="fa-solid fa-cloud-arrow-up pe-2" style="font-size: 2.1rem;"></i>
                                <img src="" class="uploadedimg">
                            </label>
                            <label for="upload-add-categories-img" class="add-categories-label d-flex align-items-center justify-content-center"><span class="upload-text"> Upload Image</span> <span class="uploaded-text ">Click to Change</span> </label>
                        </div>
                        <input type='hidden' value="addcat" name="action">
                        <div class="card-footer">
                            <button class="btn add-categories-popup-back-btn" type="button">Back</button>
                            <button class="btn add-categories-popup-submit-btn d-flex align-items-center" id="add-cat-btn"><span class="pe-1">Submit</span> <?php include("../loaderAnimation.php") ?></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <hr>

        <div class="listing">

            <h2 class="listing-title text-center">LISTING</h2>

            <div class="add-listing row">
                <div class="card col-lg-4 col-md-6 col-sm-6 col-12">
                    <input type="text" class="add-listing-input" placeholder=" Listing Title ">
                    <button class="btn  btn-outline-dark add-listing-btn d-flex align-items-center"><span class="pe-1">Add Listing</span> <?php include("../loaderAnimation.php") ?></button>
                </div>
            </div>

            <div class="row added-listing">



            </div>


            <div class="row added-listing-edit-popup edit-popup text-center">
                <div class="card col-lg-4 col-md-6 col-sm-6 added-listing-edit-popup-card active">
                    <div class="card-header">
                        <input type="text" class="added-listing-edit-title mt-4">
                        <input type="hidden" id="edit-input-id">
                    </div>

                    <div class="card-footer mb-4">
                        <button class="btn btn-outline-danger added-listing-edit-popup-discard-btn">Discard</button>
                        <button class="btn btn-outline-success added-listing-edit-popup-change-btn">change <?php include("../loaderAnimation.php") ?></button>
                    </div>
                </div>
            </div>
            <div class="row   delete-popup text-center">
                <div class="card col-lg-4 col-md-6 col-sm-6  delete-popup-card active">
                    <div class="card-body">
                        <h4>Are you sure you want to delete this Category !?</h4>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-danger delete-popup-no-btn ">NO</button>
                        <button class="btn btn-outline-success delete-popup-yes-btn" id='yes'>YES</button>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="home.js"></script>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .swal2-modal {
        background-color: #04564c !important;
        color: #fff !important;

    }
</style>
<script>
    function removeInvalidContainer() {
        $('.imgShowCon').removeClass('invalidStyle')
    }

    function removeInvalidText() {
        $('.add-categories-title').removeClass('is-invalid')
    }
    $(document).ready(function() {
        loadCategory();
        loadListingData();
        $(document).on('click', '#add-cat-btn', function(e) {
            e.preventDefault();
            // console.log($(this).children('.loaderMainContainer').css("display","none"));
            var editForm = $('#catForm')[0];
            var formdata = new FormData(editForm);
            console.log(formdata);
            var name = $('input[name="name_of_categoryadd"]').val();
            let catImage = $('.add-categories-img').val();
            if (name == '' || catImage.length == 0) {
                if (name == '') {
                    $('.add-categories-title').addClass('invalidStyle is-invalid')
                }
                if (catImage.length == 0) {
                    $('.imgShowCon').addClass('invalidStyle')
                }
                return false;
            }
            $('#add-cat-btn').prop("disabled", true);
            $(this).children('.loaderMainContainer').css("display", "inline-block");
            $.ajax({
                url: "ajax.php",
                method: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    // console.log(response);
                    if (response == 'File already exists') {
                        $('#add-cat-btn').prop("disabled", false);
                        $('#add-cat-btn').children('.loaderMainContainer').css("display", "none");
                        $('.uploadedimg').css("display", "none")
                        Swal.fire({
                            title: "oops",
                            text: response,
                            icon: "info",
                        });
                        return false;

                    }else if (response == 'File does not exist') {
                        $('#add-cat-btn').prop("disabled", false);
                        $('#add-cat-btn').children('.loaderMainContainer').css("display", "none");
                        $('.uploadedimg').css("display", "none")
                        Swal.fire({
                            title: "oops",
                            text: response,
                            icon: "info",
                        });
                        return false;
                    } else {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $('#add-cat-btn').prop("disabled", false);
                            $('#add-cat-btn').children('.loaderMainContainer').css("display", "none");
                            $('.uploadedimg').css("display", "none")

                            Swal.fire({
                                title: 'Good job!',
                                text: 'Your Product Category added successfully!',
                                icon: 'success',
                                confirmButtonText: 'Close'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = window.location.href;

                                }
                            });
                        }
                        //return true;
                    }
                }
            });
        });

        function loadCategory() {
            $.ajax({
                url: "ajax.php",
                method: "GET",
                data: {
                    action: "getcat"
                },
                success: function(result) {
                    //console.log(result);
                    if (result) {
                        $('.categories-row').append(result);
                    }
                }
            });
        }

        $(document).on('click', '.added-categories-delete-btn', function(e) {
            e.preventDefault();
            deleteId = $(this).val();
            deletedImage = $(this).prop('id');
            //var cattxt = $('h3').text();
            if ($(".delete-popup-card").hasClass("active")) {
                $(".delete-popup-card").removeClass("active");
            }
            //$('#catid').text(cattxt);
            //alert(deletedImage);
            $(document).on('click', '.delete-popup-yes-btn', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "ajax.php",
                    method: "GET",
                    data: {
                        delid: deleteId,
                        request: "checkcat",
                        path: deletedImage
                    },
                    success: function(res) {
                        // console.log(res);
                        if (!res) {
                            setTimeout(function() {

                                window.location.href = window.location.href;

                            }, 1000);
                        } else if (res == 'already used') {
                            Swal.fire({
                                title: 'Warning',
                                text: 'This Category was already used in products do you really wants to Remove this',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                showCloseButton: true,
                                confirmButtonText: "Yes, delete it!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    //window.location.href = window.location.href;
                                    $.ajax({
                                        url: "ajax.php",
                                        method: "GET",
                                        data: {
                                            delid: deleteId,
                                            deletcat: "confirm delete",
                                            path: deletedImage
                                        },
                                        success: function(res) {
                                            // console.log(res);
                                            if (!res) {
                                                setTimeout(function() {

                                                    window.location.href = window.location.href;

                                                }, 1000);
                                            } else {
                                                $('#yes' + deleteId).remove();
                                                Swal.fire({
                                                    title: 'Good job!',
                                                    text: 'Your Category Removed successfully!',
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
                                }
                            });
                        } else {
                            $('#yes' + deleteId).remove();
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Your Category Removed successfully!',
                                icon: 'success',
                                confirmButtonText: 'Close'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = window.location.href;

                                }
                            });
                            //return true;
                        }
                    }
                });
            });
            $(document).on('click', '.delete-popup-no-btn', () => {
                $(".delete-popup-card").addClass("active");
            });
        });

        $(document).on('click', '.added-categories-edit-btn', function() {
            if ($(".add-categories-edit-popup-card").hasClass("active")) {
                $(".add-categories-edit-popup-card").removeClass("active");
            }
            editId = $(this).val();
            // console.log(editId);
            // console.log(editImage);
            $.ajax({
                url: 'ajax.php',
                method: 'GET',
                data: {
                    actionreq: 'get cat',
                    editId: editId
                },
                success: function(response) {
                    if (response) {
                        //console.log(response.id);
                        var arr = JSON.parse(response);
                        //console.log(arr);
                        $.each(arr, function(i, value) {
                            // do something with each value in the array
                            //console.log(i);
                            $('input[name="name_of_category"]').val(arr.name_of_category);
                            $('input[name="oldimage"]').val(arr.image_of_category);
                            $('input[name="editid"]').val(arr.id);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // handle errors here
                    console.log("An error occurred: " + error);
                }
            });

        });
        //var newimagepath = '';
        $(document).on('click', '#edit-btn', function(e) {
            e.preventDefault();
            var editForm = $('#editcatform')[0];
            var formdata = new FormData(editForm);
            var name = $('input[name="name_of_category"]').val();
            alert(name);
            if (name == '') {
                alert('Enter the category name');
                return false;
            }
            $('#edit-btn').prop("disabled", true);
            $('.loaderMainContainer').css("display", "inline-block");
            $.ajax({
                url: 'ajax.php',
                method: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    console.log(response);
                    $('#edit-btn').prop("disabled", false);
                    $('.loaderMainContainer').css("display", "none");
                    if (response == 'File already exists') {
                        swal.fire({
                            title: "Error",
                            text: response,
                            icon: "info",
                        });
                        //alert(response);
                        return false;
                    } else {
                        var res = jQuery.parseJSON(response);
                        //console.log(res);
                        if (res.status == 400) {
                            swal.fire({
                                title: "Error",
                                text: res.message,
                                icon: "info",
                            });
                            return false;
                        } else if (res.status == 204) {
                            swal.fire({
                                title: "Error",
                                text: res.message,
                                icon: "info",
                            });
                            //alert(res.message);
                            return false;
                        } else if (res.status == 200) {
                            // alert(res.message);
                            // window.location.href = window.location.href;
                            Swal.fire({
                                title: 'Good job!',
                                text: res.message,
                                icon: 'success',
                                confirmButtonText: 'Close'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = window.location.href;

                                }
                            });
                            return true;
                        }
                    };
                }

            });
        });
        $(document).on('click', '.add-listing-btn', function(e) {
            //e.preventDefault();
            var listVal = $('.add-listing-input').val();
            //console.log(listVal);
            //alert(listVal);
            if (listVal == '') {
                alert('Please enter the listing title');
                return false;
            } else {
                $('.add-listing-btn').prop("disabled", true);
                $('.loaderMainContainer').css("display", "inline-block");
                $.ajax({
                    url: 'ajax.php',
                    method: 'GET',
                    data: {
                        listaction: 'addlisting',
                        title: listVal
                    },
                    success: function(response) {
                        //console.log(response);
                        if (response) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Your listing Category added successfully!',
                                icon: 'success',
                                confirmButtonText: 'Close'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    //$('.add-listing-input').val("");
                                    window.location.href = window.location.href;
                                    //ajax
                                    //loadListingData();

                                }
                            });
                        }
                    }
                })
            }
        });

        function loadListingData() {
            $.ajax({
                url: 'ajax.php',
                method: 'GET',
                data: {
                    listingaction: 'getlisting',
                },
                success: function(response) {
                    //console.log(response);
                    if (response) {

                        $('.added-listing').append(response);
                    } else {
                        $('.added-listing').html("");
                    }

                }
            });
        }
        // show edit listing popup
        $(document).on('click', '#added_listing_edit_btn', function() {
            if ($('.added-listing-edit-popup-card').hasClass('active')) {
                $('.added-listing-edit-popup-card').removeClass('active');
            }
            var editid = $(this).attr('data-srno');
            //var text = $('.added-list-title').text();

            //console.log(text);
            $.ajax({
                url: 'ajax.php',
                method: 'GET',
                data: {
                    getname: 'get-list-name',
                    id: editid
                },
                success: function(response) {
                    //console.log(response);
                    if (response) {
                        var res = JSON.parse(response);
                        $.each(res, function(i, value) {
                            // do something with each value in the array
                            //console.log(i);
                            // $('input[name="name_of_category"]').val(arr.name_of_category);
                            // $('input[name="oldimage"]').val(arr.image_of_category);
                            // $('input[name="editid"]').val(arr.id);
                            $('.added-listing-edit-title').val(res.name_of_list);
                            $('#edit-input-id').val(res.id);
                        });
                    } else {
                        $('.added-listing-edit-title').val('');
                        $('#edit-input-id').val('');
                    }

                }
            })

        });
        // edit listing text 
        $(document).on('click', '.added-listing-edit-popup-change-btn', function() {
            //alert('hi');
            var editlistVal = $('.added-listing-edit-title').val();
            //console.log(editlistVal);
            var editId = $('#edit-input-id').val();
            //console.log(myid);
            $('.added-listing-edit-popup-change-btn').prop("disabled", true);
            $('.loaderMainContainer').css("display", "inline-block");
            $.ajax({
                url: 'ajax.php',
                method: 'GET',
                data: {
                    setname: 'set-list-name',
                    title: editlistVal,
                    id: editId
                },
                success: function(response) {
                    //console.log(response);
                    if (response) {
                        Swal.fire({
                            title: 'Good job!',
                            text: 'Your listing Category Updated successfully!',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                //$('.add-listing-input').val("");
                                window.location.href = window.location.href;
                                //ajax
                                //loadListingData();

                            }
                        });
                    }
                }
            });

        });
        $(document).on('click', '.added-listing-edit-popup-discard-btn', function() {
            $('.added-listing-edit-popup-change-btn').prop("disabled", false);
            $('.loaderMainContainer').css("display", "none");
        });
        // delete listing popup
        $(document).on('click', '.added-listing-delete-btn', function() {
            var deletId = $(this).attr('data-srno');
            //console.log(deletId);
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
                    //$(id).remove();
                    $.ajax({
                        url: 'ajax.php',
                        method: 'GET',
                        data: {
                            removename: 'check-list-name',
                            id: deletId
                        },
                        success: function(response) {
                            //console.log(response);
                            if (response == 'already used') {
                                Swal.fire({
                                    title: 'Warning',
                                    text: 'This Listing was used in some products do really wants to remove this !!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    showCloseButton: true,
                                    confirmButtonText: "Yes, delete it!"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // window.location.href = window.location.href;
                                        $.ajax({
                                            url: 'ajax.php',
                                            method: 'GET',
                                            data: {
                                                removelist: 'remove-list-name',
                                                id: deletId
                                            },
                                            success: function(response) {
                                                //console.log(response);
                                                if (response) {
                                                    //console.log($('#added-listing-delete-btn' + deletId));
                                                    //$(deletId).remove();
                                                    //window.location.href = window.location.href;
                                                    Swal.fire({
                                                        title: 'Done',
                                                        text: 'Your listing Category has been updated successfully!',
                                                        icon: 'success',
                                                        confirmButtonText: 'Close'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            //$('.add-listing-input').val("");
                                                            window.location.href = window.location.href;
                                                            //ajax
                                                            //loadListingData();

                                                        }
                                                    });
                                                } else {
                                                    alert('Server down try after sometimes');
                                                }
                                            }
                                        })

                                    }
                                });
                            } else {
                                // console.log('this listing use no someway');
                                if (response) {
                                    //console.log($('#added-listing-delete-btn' + deletId));
                                    //$(deletId).remove();
                                    // window.location.href = window.location.href;
                                    Swal.fire({
                                        title: 'Done',
                                        text: 'Your listing Category has been removed successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'Close'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            //$('.add-listing-input').val("");
                                            window.location.href = window.location.href;
                                            //ajax
                                            //loadListingData();

                                        }
                                    });
                                } else {
                                    alert('Server down try after sometimes');
                                }
                            }


                        }
                    });
                }
            });
        })
        // close edit listing popup
        $(document).on('click', '.added-listing-edit-popup-discard-btn', function() {
            if ($('.added-listing-edit-popup-card').hasClass('active')) {
                $('.added-listing-edit-popup-card').addClass('active');
            }

        });
    });
</script>
