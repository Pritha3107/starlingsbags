<?php
include_once 'curd-model.php';
$object = new Customers();
$contactData = $object->getAppContactInfo();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starling bags-NI | About Us</title>
    <link rel="icon" href="./assets/faviconlogo.svg" type="image/x-icon">
    <meta property="og:site_name" content="Starling bags-NI | Personalized Bags" />
    <meta property="og:title" content="Starling bags-NI | customizable bags, promotional bags, eco-friendly bags" />
    <meta property="og:image" content="https://starlingbagsni.co.uk/assets/starlinglogo.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/about.css">
</head>

<body>

    <?php include("header.php") ?>

    <div class="about_page">
        <h1>About Us</h1>
        <div class="container">
            <div class="about_page_row row">

                <div class="about_page_row_about-us col-lg-6">

                    <p>
                        Starling bags NI is a manufacturer and wholesale supplier of reusable bags to all sorts of businesses. We based in Belfast, Northern Ireland partnering with manufacturing and supply chain company in India. <br>

                        <br>
                        Our wide range of collections include cotton, canvas and jute materials to choose from. We can make promotional bags in any shape, size, colour or print and can also customise any aspect of your bag including labels, handles, pockets or gussets. <br>
                        <br>
                        We have a great attention to detail, quality and making. To understand the care we put into each bag, you have to see it in action. To do this, we strive for the best quality materials, the best choice of colour and the quickest service we can offer. <br>

                        <br>
                        You describe it, we'll create it.
                        <br>

                        Please get in touch with us for more information or quotation <a href="mailto:<?= $contactData['email_id'] ?>" class="text-decoration-none"><?= $contactData['email_id'] ?></a> at or call <a href="tel:<?= $contactData['phone_number'] ?>" class="text-decoration-none"><?= $contactData['phone_number'] ?></a> to speak to one of our team.



                        <br><br>

                    </p>

                </div>

                <div class="about_page_row_about-us_img col-lg-6">
                    <img src="assets/images/about_image.png" alt="about_image">
                </div>

            </div>
        </div>


    </div>



    <?php include("footer.php") ?>
</body>

</html>