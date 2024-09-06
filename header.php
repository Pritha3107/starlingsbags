<?php
ob_start();
include_once 'curd-model.php';
$object = new Customers();
$contactData = $object->getAppContactInfo();
// print_r($contactData);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="assets/css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>

<body>
    <div class="header">
        <div class="header_section">
            <div class="contact_details">
                <div class="mail_id">
                    <a href="mailto:<?= $contactData['email_id'] ?>">
                        <i class="fa-solid fa-envelope"></i>
                        <span><?= $contactData['email_id'] ?></span>
                    </a>
                </div>
                <div class="phone_no">
                    <a href="tel:<?= $contactData['phone_number'] ?>">
                        <i class="fa-solid fa-phone"></i>
                        <span><?= $contactData['phone_number'] ?></span>
                    </a>
                </div>

            </div>
            <div>
                <div class="logo_section">
                    <div class="sm_menu-bar" id="menu_click">
                        <i class="fa-solid fa-bars menu_bar"></i>
                    </div>
                    <div class="logo">
                        <a href="https://starlingbagsni.co.uk/">
                            <span><img src="./assets/starlinglogo.svg" alt="starling bag" width="100%" height="100%" style="max-width: 200px; height:80px;"></span>
                        </a>
                    </div>
                </div>


            </div>

            <div class="search_tab">

                <input type="checkbox" class="d-none" id="clk_btn">
                <input type="text" id="search" placeholder="Search products..">

                <label class="search_btn serachbtn" for="clk_btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </label>

            </div>


        </div>
        <hr class="horizantalLine">
        <div class="menu">
            <ul>
                <li class="list"><a href="./adminpanel/home.php">Home</a></li>
                <li class="list"><a href="shop.php">Shop</a></li>
                <li class="list"><a href="about.php">About</a></li>
                <li class="list"><a href="contact.php">Contact</a></li>
                <li class="list"><a href="quote.php">Quote</a></li>
            </ul>
        </div>
    </div>

    <div class="sm_menu-section" id="menu_section">

        <div class="sm_logo_section">
            <div class="sm_close-bar" id="close_menu">
                <i class="fa-solid fa-arrow-left close_bar"></i>
            </div>
            <div class="sm_logo">
                <a href="https://starlingbagsni.co.uk/">
                    <span><img src="./assets/starlinglogo.svg" alt="starling bag" width="100%" style="max-width: 180px; height:80px;"></span>
                </a>
            </div>
        </div>

        <div class="sm_search_tab">
            <input type="text" class='search_txt' placeholder="Search products.." id="smDiviceSearch">
            <label class="sm_search_btn serachbtn" for="smDiviceSearch">
                <i class="fa-solid fa-magnifying-glass"></i>
            </label>
        </div>

        <div class="sm_menu">
            <ul>
                <li class="list"><a href="home.php">Home</a></li>
                <li class="list"><a href="shop.php">Shop</a></li>
                <li class="list"><a href="about">About</a></li>
                <li class="list"><a href="contact">Contact</a></li>
                <li class="list"><a href="quote">Quote</a></li>
            </ul>
        </div>



    </div>

    <div class="top_scroll" id="topscroll">
        <i class="fa-solid fa-arrow-up"></i>
    </div>


    <script src="header.js"></script>
</body>

</html>
<script>
    $(document).ready(function() {
        $(document).on('click', '.serachbtn', function() {
            console.log("hi")
            var inputValue = $('#search').val().trim() || $('#smDiviceSearch').val().trim();
            if (inputValue == '' || inputValue.length < 3) {
                return null;
            } else {
                window.location.href = "searchedProduct?searchtext=" + inputValue;
            }
            // inputValue = null;
        });
        $('#search').change(function() {
            search.addEventListener("keyup", function(event) {
                if (event.key === "Enter") {
                    var inputValue = $('#search').val().trim();
                    if (inputValue == '' || inputValue.length < 3) {
                        return null;
                    } else {
                        window.location.href = "searchedProduct?searchtext=" + inputValue;
                    }
                }
            });
        })
    });
</script>