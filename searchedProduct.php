<?php
include_once 'curd-model.php';
$object = new Customers();
//$cat_data = $object->getProductCategories();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/398c77c1ca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="shop.css">
    <title>shop</title>
</head>

<body> <?php include("header.php") ?> <div class="shop">
        <h1 class="shop-title">Shop</h1>
        <div class="shop-filters">
            <?php
            $getid = "";
            if (isset($_GET['searchtext']) && $_GET['searchtext'] != '') {
                $getid = $_GET['searchtext'];
                $pro_data = $object->searchableResult($getid);
                //$result = $object->getProductDetails($_GET['product']);
                //print_r($pro_data);
                if (!$pro_data && empty($pro_data)) {
                    echo '';
                } else {
                    foreach ($pro_data as $key) {
                        $product_cat_name = $key['name_of_category'];
                    }
                    echo '<button class="filter-btn" id="' . $product_cat_name . '">
                            <h4>' . $getid . '</h4>
                            </button>';
                }
            } else {
                echo '';
            }
            ?>
            <!-- <button class="filter-btn" id="Cotton-Bags">
        <h4>Cotton Bags</h4>
      </button>
      <button class="filter-btn" id="Leather-Bags">
        <h4>Leather Bags</h4>
      </button> -->
        </div>
        <div class="shop-items">
            <?php if (isset($_GET['searchtext']) && $_GET['searchtext'] != '') {
                $getid = $_GET['searchtext'];
                $pro_data = $object->searchableResult($getid);
                if ($pro_data) {
                    foreach ($pro_data as $data) {
                        // print_r($data);
                        echo '
                           <div class="card shop-item">
                               <a href="product_details.php?ProId=' . $data['pro_id'] . '">
                               <span class="product-details-link"></span>
                               </a>
                               <div class="shop-item-img">
                               <img class="shop-item-img" src="adminpanel/' . $data["product_image"] . '" alt="">
                               </div>
                               <div class="details text-center">
                               <p class="product-name">' . $data['product_name'] . '</p>
                               </div>
                               <div class="product-button">
                                    <a href="./getquote.php?proid=' . $data['pro_id'] . '" class="btn Get-quote-btn w-100">Get Quote</a>
                               </div>
                           </div>';
                    }
                } else {
                    echo '<div class="pb-5">
                       <div class="shop-item-img">
                       <img class="shop-item-img" src="assets/no-items-found.gif"   style="width:100%; max-width:400px; mix-blend-mode: darken;">
                       </div>
                   </div>';
                }
            } else {
                 echo '<div class="pb-5">
                       <div class="shop-item-img">
                       <img class="shop-item-img" src="assets/no-items-found.gif"   style="width:100%; max-width:400px; mix-blend-mode: darken;">
                       </div>
                   </div>';
            } ?>
        </div>
    </div> <?php include("footer.php") ?> <script src="shop.js"></script>
</body>

</html>