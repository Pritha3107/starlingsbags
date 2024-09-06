<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>QUOTE</title>
    <style>
    .body {
        padding-left: 130px;
        height: 100%;
        padding-top: 40px;
        padding-right: 30px;
    }

    .textColor {
        color: #1b2627;
    }

    .mainQuotCard .QuotCard {
        width: 300px;
        border-radius: 10px;
    }

    .mainQuotCard .QuotCard img {
        border-radius: 10px;
        width: 100%;
    }

    .mainQuotCard .QuotCard a {
        background-color: #1b2627;
        color: #aacfda;
    }

    .mainQuotCard .QuotCard a:hover {
        transition: .5s;
        background-color: #aacfda;
        color: #1b2627;
    }

    @media screen and (max-width:700px) {

        .body {
            padding: 30px 30px 30px 30px;
        }
    }

    @media screen and (max-width:500px) {
        .body {
            padding: 30px 10px 30px 10px;
        }
    }
    </style>
</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <div class="h2">QUOTS EDIT PAGE</div>
        <hr>
        <div class="mainQuotCard d-flex flex-wrap justify-content-lg-start justify-content-center">
            <div class="card QuotCard p-3 m-3 shadow">
                <img src="./assets/normelquot.png">
                <div class="h5 pt-3 textColor">Normal Get a Quote</div>
                <small class="textColor">Click here to customize the "Get a Quot" Page</small>
                <a href="./quote?quoteType=normal" class="btn shadow-none mt-3 fw-bold">Edit Quot</a>
            </div>
            <div class="card QuotCard p-3 m-3 shadow">
                <img src="./assets/productquot.png">
                <div class="h5 pt-3 textColor">Products Get a Quote</div>
                <small class="textColor">Click here to customize the product "Get a Quot" Page</small>
                <a href="./quote?quoteType=product" class="btn shadow-none mt-3 fw-bold">Edit Quot</a>
            </div>
        </div>
    </div>

</body>

</html>
<script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>