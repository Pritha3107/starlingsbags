<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
$results =  $classobj->getOrdersDetailsCount();
$productData = $classobj->showAllProducts();
$productsRating = $classobj->productsRating();
// echo '<pre>';
// print_r($results);
// print_r(count($productData->fetch_all()));
// echo '<pre>';
// print_r($productsRating);
// die();
if (!$results) {
    $orderscount = 0;
} else {
    $orderscount =  count($results);
}
if (!$productData) {
    $productcount = 0;
} else {
    $productcount =  count($productData->fetch_all());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <title>Dashboard</title>
    <style>
        #toast-container>.toast-success {
            background-color: #00bb9f;
            color: #000;
        }
    </style>

</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <?php
        if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
            echo "<script type='text/javascript'>toastr.success('Welcome " . $_SESSION['name'] . "')</script>";
            unset($_SESSION['name']);
        }

        ?>
        <h2 style="color:#283638" class="p-3">DASHBOARD </h2>
        <div class="dashboard-section d-flex">

            <div class="dashboard-left-section">
                <div class="top-card row ">
                    <div class="card col-lg-3 col-md-3 col-sm-3">
                        <a href="./order" class="card-body ">
                            <div class="card-icon">
                                <img src="assets/img3.png" alt="">
                            </div>
                            <div class="card-text">
                                <p class="total-orders-no"><?= $orderscount ?></p>
                                <p class="total-orders-text">Total orders</p>

                            </div>

                        </a>

                    </div>
                    <div class="card col-lg-3 col-md-3 col-sm-3 ">
                        <a href="./shop" class="card-body ">
                            <div class="card-icon">
                                <img src="assets/img2.png" alt="">
                            </div>
                            <div class="card-text">
                                <p class="total-orders-no"><?= $productcount ?></p>
                                <p class="total-orders-text">Total products</p>

                            </div>

                        </a>
                    </div>
                    <!-- <div class="card col-lg-3 col-md-3 col-sm-3 ">

                    </div> -->
                    <hr>
                </div>

                <div class="order-list table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                    <h3 class="order-list-tiltle">Orders </h3>
                    <table class="table table-lg table-hover   text-center">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th> Customer </th>
                                <th>Phone No</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!$results) {
                                echo '<tr><td colspan="4">There is no orders Placed</tr></td>';
                            } else {
                                foreach ($results as $row) {
                                    $datetime = $row['crated_at'];
                                    $timestamp = strtotime($datetime);
                                    $formattedDate = date('M ,d y', $timestamp);
                                    $formattedTime = date('h:i A', $timestamp);
                                    // echo $date;
                                    // $formattedDate = date('M d , Y', $date);
                                    // $formattedTime = date('h:i A', $date);
                                    echo '<tr>
                                    <td style="min-width:150px;"><a href="order_details?orderid=' . $row['order_id'] . '" class="link-dark">' . $row["order_id"] . '</a></td>
                                    <td style="max-width:200px; min-width:100px; word-wrap: break-word;">' . $row["cust_name"] . '</td>
                                    <td>' . $row["cust_phno"] . '</td>
                                    <td style="min-width:100px;">' . $formattedDate . '<br>' . $formattedTime . '</td>

                                </tr>';
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="top-sellings flex-shrink-0 col-sm">
                <h4 class="text-center">Top Selling Products</h4>
                <?php
                if (!$productsRating) {
                    echo ' <div class="card">
                        <div class="card-body">
                            <p class="pro-name">No Top Selling Products</p>
                        </div>
                    </div>';
                } else {
                    foreach ($productsRating as $product) {
                        // echo '<p>' . $product['product_id'] . '</p>';
                        $productNames = $classobj->fetchProductsByProId($product['product_id']);
                        // print_r($productName);
                        foreach ($productNames as $productname) {
                            // echo '<p>' . $productname['product_name'] . '</p>';
                            echo ' <div class="card">
                                        <a href="view_product?id=' . $productname['pro_id'] . '"class="card-body d-flex justify-content-start link-dark">
                                            <div>
                                                <img src="' . $productname['product_image'] . '" alt="" style="width:100px; object-fit:contain; ">
                                            </div>
                                            <div>
                                                <span class="pro-name">' . $productname['product_name'] . '</span><em><small> (' . $product['selling_count'] . ') </small></em> </br>
                                                <small>' . $productname['prod_id'] . '</small>
                                            </div>
                                        </a>
                                   </div>';
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>

</body>

</html>