<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
$results = $classobj->showAllProducts();
// print_r($results);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <title>SHOP</title>
</head>
<style>
    .swal2-modal {
        background-color: #04564c !important;
        color: #fff !important;

    }

    .form-group {
        width: 100%;
        max-width: 200px;
        position: relative;
        /* margin: 0 0 0 200px !important; */
        /* margin-bottom: 45px; */
    }

    input {
        /* display: block; */
        width: 100%;
        /* max-width: 300px; */
        font-size: 14pt;
        /* padding: 10px; */
        border: none;
        border-bottom: 1px solid #ccc;
        /* margin: 0 0 0 170px !important; */
    }

    input:focus {
        outline: none;
    }

    label {
        position: absolute;
        top: -2px;
        /* left: 5px; */
        color: #283638;
        font-size: 12pt;
        font-weight: normal;
        pointer-events: none;
        transition: all 0.2s ease;
        /* margin: 0 0 0 170px !important; */
    }

    input:focus~label,
    input:valid~label {
        top: -15px;
        font-size: 10pt;
        color: #283638;
    }

    .bar {
        display: block;
        position: relative;
        width: 100%;
        /* margin: 0 0 0 150px !important; */

    }

    .bar:before,
    .bar:after {
        content: "";
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #283638;
        transition: all 0.2s ease;

    }

    .bar:before {
        left: 50%;
    }

    .bar:after {
        right: 50%;
    }

    input:focus~.bar:before,
    input:focus~.bar:after,
    input:valid~.bar:before,
    input:valid~.bar:after {
        width: 50%;
    }


    .form-group .searchBtn {
        position: absolute;
        top: -10px;
        right: 0;
        height: 100%;
        display: none;
    }

    input:focus~.searchBtn,
    input:valid~.searchBtn {
        display: block;
    }

    /* .dataTables_wrapper .dataTables_filter {
        float: left;
        text-align: left;
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_filter input {
        width: 300px;
        padding: 7px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        border-color: #000;
        background-color: #f7f7f7;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        font-size: 14px;
    } */
</style>


<body>
    <?php include("header.php") ?>
    <div class="body">
        <h2 style="color:#283638" class="pb-3">PRODUCT LIST</h2>
        <hr>
        <div class="shop-top-btns d-flex justify-content-between align-items-center flex-wrap">
            <div class="form-group mt-2">
                <input type="text" name="name" id="searchproduct" class="pb-1" required />
                <!-- <i class="fa fa-search" aria-hidden="false"></i> -->
                <span class="highlight"></span>
                <span class="bar"></span>
                <label for="name">Search Product</label>
                <button type="button" class="searchBtn btn shadow-none"><i class="fa-solid fa-magnifying-glass"></i></button>

            </div>
            <a href="./shop_addnew"><button class=" mt-2 btn btn-lg btn-outline-dark ">+ Add new </button></a>
        </div>
        <div class="table-responsive">
            <table class="text-center table table-lg table-hover">
                <thead>
                    <tr>
                        <th>
                            <h5>Product Id</h5>
                        </th>
                        <th>
                            <h5>Image</h5>
                        </th>
                        <th>
                            <h5>Product Name</h5>
                        </th>
                        <th>
                            <h5>Categories</h5>
                        </th>
                        <th>
                            <h5>Actions</h5>
                        </th>

                    </tr>
                </thead>
                <tbody id="default-table">
                    <?php
                    if (!empty($results)) {
                        $i = 1;
                        $category_name = "";
                        while ($result = $results->fetch_assoc()) {
                            // echo '<pre>';
                            // print_r($result);
                            $category_id = $result['product_category'];
                            //echo $category_id;
                    ?>
                            <tr id='row<?= $result['pro_id'] ?>'>
                                <td>
                                    <h6><?= $result['prod_id']; ?></h6>
                                </td>
                                <td>
                                    <h6> <img src="<?= $result['product_image']; ?>" alt="" width="100px" height="100px"></h6>
                                </td>
                                <td style="min-width:200px">
                                    <h6><?= $result['product_name']; ?></h6>
                                </td>
                                <td>
                                    <?php
                                    if ($category_id != '') {
                                        $cat_name = $classobj->getCategories($category_id);
                                        //print_r($cat_name['name_of_category']);
                                        echo '<h6>
                                                ' . $cat_name['name_of_category'] . '
                                        </h6>';
                                    } else {
                                        echo '<h6>

                                        </h6>';
                                    }
                                    ?>

                                </td>
                                <td>
                                    <a href="view_product?id=<?= $result['pro_id']; ?>" class="btn btn-outline-success my-1" data-bs-toggle="tooltip" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a href="editnew_product?id=<?= $result['pro_id']; ?>" class="btn btn-outline-info my-1" data-bs-toggle="tooltip" title="Edit"><i class="fa-solid fa-pen-to-square" title="Edit" class="tooltip"></i></a>
                                    <button class="btn btn-outline-danger delete my-1" data-bs-toggle="tooltip" title="Delete" data-id="<?= $result['pro_id'] ?>" data-value="<?= $result['product_image']; ?>">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php $i++;
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="5"><h6> <img src="assets/no-items-found.gif" alt="" width="300px" style="object-fit:contain; mix-blend-mode: multiply;"></h6></td>';
                    } ?>
                </tbody>
                <tbody id="search-result">

                </tbody>
            </table>
        </div>

    </div>
    <script>
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // $('.table').DataTable({
        //     paging: false,
        //     searching: true,
        //     "bInfo": false
        // });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            //alert('delete btn');
            let deleteId = $(this).attr('data-id');
            let deleted_image = $(this).data('value');
            // console.log(deleted_image);
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
                        method: "GET",
                        data: {
                            shopaction: "delete product",
                            delid: deleteId,
                            deleteimage: deleted_image
                        },
                        success: function(response) {
                            console.log(response);
                            if (!response) {
                                return false;
                            } else {
                                $('#row' + deleteId).remove();
                                //$(deleteId).closest('tr').remove();
                            }
                        }
                    });
                }
            });

        });
        $('#searchproduct').keyup(function() {
            let query = $(this).val();
            // console.log(query);
            if (query !== '') {
                $.ajax({
                    url: 'product-controller.php',
                    method: 'GET',
                    data: {
                        searchquery: query
                    },
                    success: function(data) {
                        // var arrdata = $.parseJSON(data);
                        // console.log(data);
                        if (data !== '') {
                            $('#default-table').hide();
                            $('#search-result').html(data);
                        }
                        // $('#search-results').html(data);
                    }
                });
            } else {
                $('#default-table').show();
                $('#search-result').html('');
            }
        });
    });
</script>