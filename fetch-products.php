<?php
include_once 'curd-model.php';
$object = new Customers();

if (isset($_GET['reqstring']) == 'fetchallproducts') {
  $pro_data = $object->getProductDetails();
  //$cat_data = $object->getProductCategories();
  //print_r($pro_data);
  if (!empty($pro_data)) {
    foreach ($pro_data as $data) {
      echo '
            <div class="card shop-item All ' . $data["product_category"] . '">
              <a href="product_details?ProId=' . $data['pro_id'] . '">
                <span class="product-details-link"></span>
              </a>
              <div class="shop-item-img">
                <img class="shop-item-img" src="adminpanel/' . $data["product_image"] . '" alt="' . $data['product_name'] . '">
              </div>
              <div class="details text-center">
                <p class="product-name">' . $data['product_name'] . '</p>
              </div>
              <div class="product-button">
              <a href="./getquote?proid=' . $data['pro_id'] . '" class="btn Get-quote-btn w-100">Get Quote</a>
              </div>
            </div>';
    }
  } else {
    echo '<div class="card shop-item" id="no_item_found">
            
            <img class="shop-item-img"  src="assets/no-items-found.gif">
         <h2>No Item Found</h2>
        </div>';
  }
}
if (isset($_POST['reqstring']) == 'getproduct') {
  //echo 'product by category';
  $resProType = $_POST['proname'];
  //print_r($resProType);
  if ($resProType == 'All') {
    $pro_data = $object->getProductDetails();
    //print_r($pro_data);
    if (!empty($pro_data)) {
      foreach ($pro_data as $data) {
        echo '
            <div class="card shop-item All ' . $data["product_category"] . '">
              <a href="product_details?ProId=' . $data['pro_id'] . '">
                <span class="product-details-link"></span>
              </a>
              <div class="shop-item-img">
                <img class="shop-item-img" src="adminpanel/' . $data["product_image"] . '" alt="' . $data['product_name'] . '">
              </div>
              <div class="details text-center">
                <p class="product-name">' . $data['product_name'] . '</p>
              </div>
              <div class="product-button">
  
              <a href="./getquote?proid=' . $data['pro_id'] . '" class="btn Get-quote-btn w-100">Get Quote</a>
              </div>
            </div>';
      }
    } else {
      echo '<div class="card shop-item " id="no_item_found">
            
            <img class="shop-item-img"  src="assets/no-items-found.gif"  >
            <h2>No Item Found</h2>
        </div>';
    }
  } else {

    $catpro_data = $object->getproductByName($_POST['proname']);
    //print_r($catpro_data);
    if (!empty($catpro_data)) {
      foreach ($catpro_data as $data) {
        echo '
                <div class="card shop-item All ' . $data["product_category"] . '">
                  <a href="product_details?ProId=' . $data['pro_id'] . '">
                    <span class="product-details-link"></span>
                  </a>
                  <div class="shop-item-img">
                    <img class="shop-item-img" src="adminpanel/' . $data["product_image"] . '" alt="' . $data['product_name'] . '">
                  </div>
                  <div class="details text-center">
                    <p class="product-name">' . $data['product_name'] . '</p>
                  </div>
                  <div class="product-button">
      
                  <a href="./getquote?proid=' . $data['pro_id'] . '" class="btn Get-quote-btn w-100">Get Quote</a>
                  </div>
                </div>';
      }
    } else {
      echo '<div class="card shop-item" id="no_item_found">
          
            <img class="shop-item-img"  src="assets/no-items-found.gif" >
            <h2>No Item Found</h2>
        </div>';
    }
  }
}
if (isset($_GET['listing']) == "get listing wise products") {
  // echo 'get product by listing';
  $products = [];
  $listing_data = $object->getListing();
  //print_r($listing_data);
  //die();
  if (empty($listing_data)) {
    echo $listing_data;
  } else {
    foreach ($listing_data as $listname) {
      //$listing_data = $object->getListing($listname['product_listing']);
      //foreach ($listing_data as $key) {

      echo '<div class="bestseller-products">
              <div class="bestseller-products-title">
                <h2>' . $listname['listing_name'] . '</h2>
              </div>
              <div class="bestseller-card ">';
      // print_r($listname['products']);
      foreach ($listname['products'] as $product) {
        echo '<div class="card">
                <a href="product_details.php?ProId='.$product['id'].'" class="text-decoration-none">
                <div class="card-body">
                     <div style = "width:100%; height:200px ">
                      <img src="adminpanel/' . $product["image"] . '" width="100%" height="100%" style = "object-fit:contain" alt="' . $product['name'] . '">
                     </div> 
                      <div class="details pt-2">
                          <p class="product_name">' . $product['name'] . '</p>
                      </div>
                      <div class="bestseller-button">
                        <a href="./getquote.php?proid=' . $product['id'] . '" class="btn Get-quote-btn w-100">Get Quote</a>
                      </div>
                </div>
                </a>
            </div>';
      }

      echo '</div>';
      echo '</div>';
      // }
    }
  }
}
if (isset($_GET['reqaction']) == 'fetchselectedproducts') {
  //echo 'yes its me';
  $pro_id = $_GET['productid'];
  $prodct_data =  $object->getproductByName($pro_id);
  //print_r($prodct_data);
  //die();
  if (!empty($prodct_data)) {
    foreach ($prodct_data as $data) {
      echo '
              <div class="card shop-item All ' . $data["product_category"] . '">
                <a href="product_details?ProId=' . $data['pro_id'] . '">
                  <span class="product-details-link"></span>
                </a>
                <div class="shop-item-img">
                  <img class="shop-item-img" src="adminpanel/' . $data["product_image"] . '" alt="' . $data['product_name'] . '">
                </div>
                <div class="details text-center">
                  <p class="product-name">' . $data['product_name'] . '</p>
                </div>
                <div class="product-button">
    
                <a href="./getquote?proid=' . $data['pro_id'] . '" class="btn Get-quote-btn w-100">Get Quote</a>
                </div>
              </div>';
    }
  } else {
    echo '<div class="card shop-item" id="no_item_found">
         
          <img class="shop-item-img"  src="assets/no-items-found.gif" >
         
      </div>';
  }
}
if (isset($_GET['fetchform']) == 'fetch form data') {
  // echo 'select';
  $quoteType=$_GET['quotetype'];
  $select = "SELECT form_structure_json FROM `quote_form_tbl` WHERE `type`='$quoteType' ";
  $selected_row =  $object->dbConn->query($select);
  $fetch_data = $selected_row->fetch_assoc();
  //print_r($fetch_data);
  // foreach ($fetch_data as $data) {
  //     $strArr[] = $data;
  //     //print_r($data);
  // }
  // print_r($strArr);
  print_r($fetch_data['form_structure_json']);
}
// if (isset($_GET['searchtext']) == 'fetchsearchproducts') {
//   //echo 'yes search';
//   print_r($_GET);
// }
// Fetch all product listings and their products
// $query = "SELECT product_listings.id, product_listings.name AS listing_name, products.name AS product_name, products.price 
//           FROM product_listings 
//           JOIN products ON product_listings.id = products.listing_id 
//           WHERE products.deleted_at IS NULL
//           ORDER BY product_listings.id";

// $result = mysqli_query($conn, $query);

// // Initialize an empty array to hold the product listings and their products
// $listings = array();

// // Loop through the results and group the products by their listing
// while ($row = mysqli_fetch_assoc($result)) {
//     $listing_id = $row['id'];
//     $listing_name = $row['listing_name'];
//     $product_name = $row['product_name'];
//     $product_price = $row['price'];

//     if (!array_key_exists($listing_id, $listings)) {
//         // Add the listing to the array if it doesn't exist yet
//         $listings[$listing_id] = array(
//             'listing_name' => $listing_name,
//             'products' => array()
//         );
//     }

//     // Add the product to the listing's products array
//     $listings[$listing_id]['products'][] = array(
//         'name' => $product_name,
//         'price' => $product_price
//     );
// }

// // Loop through the listings array and display the listings and their products
// foreach ($listings as $listing) {
//     echo '<h2>' . $listing['listing_name'] . '</h2>';

//     echo '<ul>';
//     foreach ($listing['products'] as $product) {
//         echo '<li>' . $product['name'] . ' - ' . $product['price'] . '</li>';
//     }
//     echo '</ul>';
// }
