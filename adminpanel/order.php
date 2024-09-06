<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
$results =  $classobj->getOrdersDetailsCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDER</title>
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<style>
.swal2-modal {
    background-color: #04564c !important;
    color: #fff !important;

}

/* form {
        width: 500px;
        margin: 50px 100px;
        ;
    } */

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
</style>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <div class="order-items">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h2 style="color:#283638" class="mt-2">ORDER LIST</h2>
                <!-- <div class="shop-top-btns d-flex justify-content-end"> -->
                <div class="form-group mt-2">
                    <input type="text" name="name" id="searchorder" required />
                    <!-- <i class="fa fa-search" aria-hidden="false"></i> -->
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label for="name">search order</label>
                    <button type="button" class="searchBtn btn shadow-none"><i
                            class="fa-solid fa-magnifying-glass"></i></button>

                </div>
                <!-- </div> -->
            </div>
            <div id="search-results">

            </div>
            <?php
            if (!$results) {
                echo '<div class="card">
                <div class="card-header">

                    <h4 class="order-id-name">
                        <span id="order-id"></span>
                    </h4>
                    <h4 class="order-id-name">
                        <span id="order-id"></span>
                    </h4>
                    <div class="date-time">
                        <p class="date"></p>
                        <p class="time"></p>
                    </div>
                </div>
                <hr>
                <div class="card-body table-responsive">
                    <table>
                        <tbody>
                            <tr>
                            <div class="d-flex justify-content-center"><img src="assets/no-items-found.gif" alt="" width="300px" style="object-fit:contain; mix-blend-mode: multiply;"></div>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>';
            } else {

                foreach ($results as $row) {
                    $datetime = $row['crated_at'];
                    $timestamp = strtotime($datetime);
                    $formattedDate = date('M d, Y', $timestamp);
                    $formattedTime = date('h:i A', $timestamp);
                    $statusLable='';
                    $listBgCol='';
                    $fontSys='';
                    if($row['seen']==1){
                        $statusLable='VISITED';
                        $fontSys='black';
                        // $listBgCol='beige';
                    }else if($row['seen']==0){
                        $statusLable='NEW';
                        $fontSys='black';
                        // $listBgCol='aquamarine';
                        $listBgCol='#95C3F5';
                    }else{
                        $statusLable='COMPLETED';
                        $listBgCol='grey';
                    }
                    ?>
            <a href="order_details?orderid=<?= $row['order_id'] ?>" style="color:<?= $fontSys ?>;" class="orderRow"
                id="<?= $row['id']?>" ;>
                <div class="card" id="row<?= $row['id']; ?>" style="background-color:<?=$listBgCol?>;">

                    <div class="card-header">
                        <h4 class="order-id-name">Order ID :
                            <span id="order-id"><?= $row['order_id'] ?></span>
                        </h4>
                        <?php
                            if (!empty($row['product_code'])) {
                                echo ' <h4 class="order-id-name">Product Code :
                                    <span id="order-id">' . $row['product_code'] . '</span>
                                </h4>';
                            }
                            ?>

                        <div class="date-time">
                            <p class="date"><?= $formattedDate ?></p>
                            <p class="time"><?= $formattedTime ?></p>
                        </div>
                    </div>
                    <hr>

                    <div class="card-body table-responsive">
                        <table>
                            <div class="customerInfo">
                                <div class="d-flex">
                                    <span class="h5 text-nowrap">Name :</span>
                                    <span class="">
                                        <span class="user-name h5"><?= $row['cust_name'] ?> </span>
                                    </span>
                                </div>
                                <div>
                                    <span class="">
                                        <span class="user-mail-id h5" title="Click to copy!"><?= $row['cust_email'] ?>
                                        </span>
                                    </span>

                                </div>
                                
                                <div>
                                    <span class="button">
                                        <a href="order_details?orderid=<?= $row['order_id'] ?>"
                                            class="btn btn-outline-success" data-bs-toggle="tooltip" title="View"><i
                                                class="fa-solid fa-eye"></i></a>
                                        <button class="btn btn-outline-danger delete" data-bs-toggle="tooltip"
                                            title="Delete" data-id="<?= $row['id'] ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </table>
                    </div>
                </div>
                <?php }
            }
            ?>

        </div>
    </div>


</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>

<script>
$(function() {
    $(document).tooltip;
});
$('.user-mail-id').click(function() {
    // this.innerText;
    navigator.clipboard.writeText(this.innerText);
    alert('Copied!');
});
$(document).ready(function() {
    $(".orderRow").click(function(e) {
        // e.preventDefault();
        var ordId = $(this).attr('id');
        console.log(ordId);
        $.ajax({
            url: 'product-controller.php',
            method: "POST",
            data: {
                prodID: ordId,
                status: 'status'
            },
            success: function(response) {
                console.log(response);

            }
        });
    })
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        //alert('delete btn');
        let deleteId = $(this).attr('data-id');

    });
    $(document).ready(function() {
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            //alert('delete btn');
            let deleteId = $(this).attr('data-id');

            // let deleted_image = $(this).data('value');
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
                            orderdelete: "deleteorder",
                            deletid: deleteId,
                        },
                        success: function(response) {
                            // console.log(response);
                            if (response == "done") {
                                $('#row' + deleteId).remove();
                            } else {
                                return false;
                            }
                        }
                    });
                }
            });

        });

        $('#searchorder').keyup(function() {
            let query = $(this).val();
            // console.log(query);
            if (query !== '') {
                $.ajax({
                    url: 'product-controller.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        // var arrdata = $.parseJSON(data);
                        // console.log(data);
                        if (data !== '') {
                            $('.card').hide();
                            $('#search-results').html(data);
                        }
                        // $('#search-results').html(data);
                    }
                });
            } else {
                $('.card').show();
                $('#search-results').html('');
            }
        });

    });
})
</script>