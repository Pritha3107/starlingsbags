<?php

include_once 'curd-model.php';

$object = new Customers();

$cat_data = $object->getProductCategories();

$pro_data = $object->getProductDetails();

// print_r($pro_data);

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./assets/faviconlogo.svg" type="image/x-icon">

    <meta name="description" content="Create your own custom cotton bags at our UK-based site. We offer a wide range of high-quality cotton bags that can be personalized with your unique designs, logos, or messages. Whether you need promotional bags for your business, event giveaways, or eco-friendly merchandise, our customizable options are perfect for you. Choose from various bag styles, sizes, and colors to match your brand or personal preferences. Start designing your custom cotton bags today and make a sustainable statement.">

    <meta name="keywords" content="custom cotton bags, personalized bags, UK, customizable bags, promotional bags, eco-friendly bags, sustainable bags">

    <meta property="og:site_name" content="Starling bags-NI | Personalized Bags" />

    <meta property="og:title" content="Starling bags-NI | customizable bags, promotional bags, eco-friendly bags" />

     <meta property="og:image" content="https://starlingbagsni.co.uk/assets/starlinglogo.svg" />

    <link rel="stylesheet" href="./style.css">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/398c77c1ca.js" crossorigin="anonymous"></script>





    <title>Starling bags-NI | Personalized Bags</title>

</head>

<style>

.customstyle {

    text-decoration: none;

    color: #000;



}



.customstyle:hover {

    color: #000;

}

</style>



<body>



    <?php include("header.php") ?>





    <!-- Home page -->







    <div class="main-img-section">



        <div class="main-bg-img">

            <img src="assets/main-img.png" alt="" width="100%">

        </div>

        <div class="main-Quotes">

            <h2>Creating happy hands.</h2>

            <p>It's all what you select.</p>

             <a href="shop"><button class="main-btn">Shop now</button></a> 

        </div>



    </div>

    <hr>



    <!-- Facilities -->

    <!--     

    <div class="facilities">

        <div class="card">

            <div class="card-body">

                <i class="fa-solid fa-truck-fast"></i>

                <h3>Free shipping</h3>



            </div>

        </div>

        <div class="card">

            <div class="card-body">

                <i class="fa fa-phone"></i>

                <h3>Dedicated support</h3>

            </div>

        </div>

        <div class="card">

            <div class="card-body">

                <i class="fa-solid fa-money-check-dollar"></i>

                <h3>Money-Back Guarantee</h3>

            </div>

        </div>

    </div>

    <hr>

 -->





    <!-- Categories -->









    <div class="Categories">

        <h2 class="Categories-title">Types of Bags</h2>

        <div class="Categories-of-bags">

            <?php

            if (!empty($cat_data)) {

                foreach ($cat_data as $data) {

                    // print_r($data);

                    echo '<div class="Categories-cotton-bags categories-bags">

                    <a href = "shop?product=' . $data['id'] . '" class ="customstyle">

                    <h4>' . $data["name_of_category"] . '</h4>

                    <img src="adminpanel/' . $data["image_of_category"] . '" alt="' . $data["name_of_category"] . '">

                    </a>

                </div>';

                }

            } else {

                echo '

                <div>

                    <img src="./assets/no-items-found.gif" style="mix-blend-mode: multiply; width:100%; max-width:300px">

                </div>';

            }

            ?>





        </div>



    </div>

    <hr>



    <!-- Fetured products -->

    <div id='listing-area'>







    </div>

    <hr>



    <?php include("footer.php") ?>





    <script src="indexScript.js"></script>



</body>



</html>

<script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- <script>

    function locations() {



        window.location.href = "shop.php";

    }

</script> -->

<script src="./productNameLength.js"></script>

<script>

$(document).ready(function() {

    getlisting();



    function getlisting() {

        $.ajax({

            url: "fetch-products.php",

            method: 'GET',

            data: {

                listing: 'get listing wise products'

            },

            success: function(response) {

                //console.log(response);

                if (!response) {

                    $('#listing-area').html();

                } else {

                    $('#listing-area').html(response);





                    const featured = document.querySelector(".bestseller-card")





                    let pressed = false;

                    let startX;

                    let scrollLeft;

                    featured.addEventListener('mousedown', function(e) {

                        pressed = true

                        featured.classList.add('active')

                        startX = e.pageX - featured.offsetLeft;

                        scrollLeft = featured.scrollLeft;

                        // this.style.curser = 'grabbing'

                    })



                    window.addEventListener('mouseleave', function(e) {

                        pressed = false

                        featured.classList.remove('active')



                    })

                    window.addEventListener('mouseup', function(e) {

                        pressed = false

                        featured.classList.remove('active')

                        //    featured.style.cursor = 'grab'



                    })

                    featured.addEventListener('mousemove', function(e) {

                        if (!pressed) return;

                        e.preventDefault();

                        const x = e.pageX - featured.offsetLeft;

                        const walk = x - startX;

                        featured.scrollLeft = scrollLeft - walk;

                    })

                    productNameLenghtSlice("product_name",60)



                }

            }

        })

    }



    // $(document).on('click', '.customstyle', function() {



});

</script>