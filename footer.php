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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/398c77c1ca.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="footer.css">
    <title>footer</title>
</head>

<body>
    <div class="footer">
        <div class="copyrights">
            <small><a href="https://aahasolutions.com/" class="text-decoration-none text-white">© 2023 AAHA Solutions . All Rights Reserved</a></small>
        </div>
        <div class="social-media-icons">

            <a href="./login"><i class="fa-solid fa-right-to-bracket"></i></a>
            <?php
            if (!empty($contactData['facebook_link'])) {
                echo ' <a href="' . $contactData['facebook_link'] . '"><i class="fa-brands fa-facebook"></i></a>';
            }
            if (!empty($contactData['instagram_link'])) {
                echo ' <a href="' . $contactData['instagram_link'] . '"><i class="fa-brands fa-instagram"></i></a>';
            }
            if (!empty($contactData['youtube_link'])) {
                echo ' <a href="' . $contactData['youtube_link'] . '"><i class="fa-brands fa-youtube"></i></a>';
            }
            if (!empty($contactData['twitter_link'])) {
                echo ' <a href="' . $contactData['twitter_link'] . '"><i class="fa-brands fa-twitter"></i></a>';
            }
            ?>

            <!-- <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a> -->

        </div>
    </div>
</body>

</html>