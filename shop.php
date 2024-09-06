<?php

include_once 'curd-model.php';

$object = new Customers();

$cat_data = $object->getProductCategories();

$pro_data = $object->getProductDetails();



if (!isset($_SESSION)) {

  session_start();
}



?>

<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" href="./assets/faviconlogo.svg" type="image/x-icon">

  <meta name="description" content="Create your own custom cotton bags at our UK-based site. We offer a wide range of high-quality cotton bags that can be personalized with your unique designs, logos, or messages. Whether you need promotional bags for your business, event giveaways, or eco-friendly merchandise, our customizable options are perfect for you. Choose from various bag styles, sizes, and colors to match your brand or personal preferences. Start designing your custom cotton bags today and make a sustainable statement.">

  <meta name="keywords" content="custom cotton bags, personalized bags, UK, customizable bags, promotional bags, eco-friendly bags, sustainable bags">

  <meta property="og:site_name" content="Starling bags-NI | Personalized Bags" />

  <meta property="og:title" content="Starling bags-NI | customizable bags, promotional bags, eco-friendly bags" />

  <meta property="og:image" content="https://starlingbagsni.co.uk/assets/starlinglogo.svg" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <script src="https://kit.fontawesome.com/398c77c1ca.js" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="shop.css">



  <title>Starling bags-NI | Shop</title>



</head>





<body> <?php include("header.php") ?> <div class="shop">



    <h1 class="shop-title">Shop</h1>

    <div class="shop-filters">

      <div class="shop-filters-child">

        <?php

        $getid = "";

        if (isset($_GET['product']) && $_GET['product'] != '') {

          $getid = $_GET['product'];

          $result = $object->getProductCategories($_GET['product']);

          // print_r($result['name_of_category']);

          if (!empty($result)) {



            foreach ($result as $name) {

              echo '<button class="filter-btn" id="' . $name['name_of_category'] . '">

            <h4 class="text-nowrap">' . $name['name_of_category'] . '</h4>

            </button>';
            }
          } else {

            echo "";
          }
        } else { ?>

          <button class="filter-btn" id="All">

            <h4>All</h4>

          </button>

        <?php

          if (!empty($cat_data)) {

            //print_r($cat_data);

            foreach ($cat_data as $data) {

              //echo $data['name_of_category'];

              echo ' <button class="filter-btn" id="' . $data['id'] . '">

                      <h4 class="text-nowrap">' . $data['name_of_category'] . '</h4>

                      </button>';
            }
          } else {

            echo " ";
          }
        }

        ?>

      </div>



    </div>

    <div class="shop-items">

    </div>

  </div> <?php include("footer.php") ?> <script src="shop.js"></script>

</body>



</html>

<script src="./productNameLength.js"></script>

<script>
  $(document).ready(function() {

    var getid = '<?php echo $getid; ?>';

    //console.log(getid);

    if (getid == '') {

      //console.log('get id is empty');

      loadAllProducts();

    } else {

      loadSelectedProducts();

      //console.log('get id is not empty');



    }



    function loadSelectedProducts() {

      $.ajax({

        url: 'fetch-products.php',

        method: "GET",

        data: {

          reqaction: 'fetchselectedproducts',

          productid: getid

        },

        success: function(response) {

          console.log(response);

          if (response) {

            $('.shop-items').html(response);

            productNameLenghtSlice("product-name", 30)

          }

        }

      });

    }



    function loadAllProducts() {

      $.ajax({

        url: 'fetch-products.php',

        method: "GET",

        data: {

          reqstring: 'fetchallproducts'

        },

        success: function(response) {

          //console.log(response);

          if (response) {

            $('.shop-items').html(response);

            productNameLenghtSlice("product-name", 30)

          }

        }

      });

    }



    // function loadSeaechProducts() {

    //   $.ajax({

    //     url: 'fetch-products.php',

    //     method: "GET",

    //     data: {

    //       reqtext: 'fetchsearchproducts',

    //       serchtxt: getid

    //     },

    //     success: function(response) {

    //       //console.log(response);

    //       if (response) {

    //         $('.shop-items').html(response);

    //       }

    //     }

    //   });

    // }

    $(document).on('click', '.filter-btn', function() {

      var clickedBtn = $(this);

      // if ($(this).hasClass('active-btn')) {

      //   alert('yes');

      // }

      $('.filter-btn').each(function(index, elements) {

        //console.log(elements);

        $('.filter-btn').removeClass('active-btn');

        clickedBtn.addClass('active-btn');

      });

      var btnid = $(this).attr('id');

      //console.log(btnid);

      $.ajax({

        url: 'fetch-products.php',

        method: 'POST',

        data: {

          reqstring: 'getproduct',

          proname: btnid

        },

        success: function(response) {

          //console.log(response);

          if (response) {

            $('.shop-items').html(response);

            productNameLenghtSlice("product-name", 30)

          }

        }

      })

    });

    // $(document).on('click', '.shop-items', function() {

    //   // console.log($(this).attr('id'));

    //   var productId = $(this).attr('id');

    //   $.ajax({

    //     url: 'product_details.php',

    //     method: 'GET',

    //     data: {

    //       action: 'getproductdata',

    //       productId: productId

    //     },

    //     success: function(response) {

    //       console.log(response);

    //     }



    //   })

    // });

  });
</script>

<?php

if (isset($_SESSION['status']) == 200) {

  echo '<script>';

  echo 'Swal.fire({

                title: "Thank you for choosing Starling Bags",

                text: "We will get back to you with the quotation at the earliest!",

                icon: "success",

                confirmButtonText: "Close"

            }).then((result) => {

                if (result.isConfirmed) {

                    window.location.href = window.location.href;



                }

            })';

  echo '</script>';

  unset($_SESSION['status']);

  exit();
} elseif (isset($_SESSION['status']) == 500) {

  echo '<script>';

  echo 'Swal.fire({

                title: "Error",

                text: "Somthing went to wrong try again ",

                icon: "success",

                confirmButtonText: "Close"

            }).then((result) => {

                if (result.isConfirmed) {

                    window.location.href = window.location.href;



                }

            })';

  echo '</script>';

  unset($_SESSION['status']);

  exit();
}

?>