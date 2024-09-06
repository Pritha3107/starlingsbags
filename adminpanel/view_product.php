<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if (!empty($product_id)) {
        $product_details = $classobj->showAllProducts($product_id);
        if (!$product_details) {
            echo 'no products details';
        } else {
            // echo '<pre>';
            // print_r($product_details);
            if (empty($product_details['product_category'])) {
                $category_name = "";
            } else {
                // echo  $product_details['product_category'];
                $category_data = $classobj->getCategories($product_details['product_category']);
                $category_name = $category_data['name_of_category'];
            }
            if (empty($product_details['product_listing'])) {
                $listname = "";
            } else {
                $listing_data = $classobj->listingNameById($product_details['product_listing']);
                //print_r($listing_data);
                $listname = $listing_data['name_of_list'];
            }
        }
        //$sss = gettype($product_details['product_listing']);
        //echo $sss;
        // die();
        // echo $listname;
        // die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="view_product.css">

    <title>View Product</title>
</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <a href="shop.php"><button class="btn btn-lg btn-outline-dark">BACK</button></a>
        <div class="card order-details-card">
            <div class="card-header">
                <h4>Product Code : <span class="order-details-id"><?= $product_details['prod_id']; ?> </span></h4>
                <!-- <div class="details-date-time">
                    <span class="details-date">Feb 19, 2023</span><br>
                    <span class="details-time">11:36 AM</span>
                </div> -->
            </div>
            <div class="card-body">
                <div class="details-product-block">
                    <div class="details-img-block">
                        <div class="details-product-image">
                            <img src="<?= $product_details['product_image'] ?>" height="400" alt="">
                        </div>

                    </div>
                    <div class="details-product-info">
                        <div class="details-product-name-block">
                            <h4>Product Name : <span class="order-details"><?= $product_details['product_name']; ?> </span></h4>
                        </div>
                        <hr>
                        <div class="details-product-name-block">
                            <h4>Product Category : <span class="order-details"><?= $category_name ?> </span></h4>
                        </div>
                        <hr>
                        <div class="details-product-name-block">
                            <h4>Product Listing Category : <span class="order-details"><?= $listname ?> </span></h4>
                        </div>
                            <?php
                            if (!empty($product_details['editable_lable']) && !empty($product_details['editable_input'])) {
                                echo '<hr>
                                <div class="customer-details">
                                    <h4 class="customer-details-title">Product Info</h4>';
                                $lable_data = json_decode($product_details['editable_lable']);
                                //print_r($lable_data);
                                //$input_data = json_decode($product_details['editable_input']);
                                //echo $product_details['editable_input'];
                                //$inputarray = json_decode($inputs_json);
                                $str = str_replace(array('"', '[', ']'), '', $product_details['editable_input']);
                                $arr = preg_split('/,/', $str);
                                $arr =  json_decode($product_details['editable_input']);
                                if (!empty(array_keys($lable_data)) && !empty(array_keys($arr))) {
                                    // The array has keys
                                    // echo "The array contains " . count($myArray) . " elements";
                                    $combined_array = array_combine($lable_data, $arr);
                                    foreach ($combined_array as $label => $input) {
                                        // Echo out the label and input values
                                        echo '<p><label class="company-name opt">' . $label . '</label> <span>' . $input . '</span></p>';

                                        // echo '<label>' . $label . '</label><input type="text" name="' . $label . '" value="' . $input . '"><br>';
                                    }
                                    // foreach ($lable_data as $lable) {
                                    //     echo '<p><label class="company-name opt">' . $lable . '</label> <span>PS SOLUTIONS</span></p>';
                                    // }
                                    echo '</div>';
                                } else {
                                    // The array is empty
                                    //echo "The array is empty";
                                }
                            }
                            ?>
                    </div>
                </div>
                <hr>
                <div>
                    <h4>Product description : <span class="order-details"><?= $product_details['pro_description']; ?> </span></h4>
                </div>
            </div>
        </div>
    </div>
</body>

</html>