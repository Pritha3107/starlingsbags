<?php
include_once 'curd-model.php';
$object = new Customers();

//echo 'product page';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/faviconlogo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/398c77c1ca.js" crossorigin="anonymous"></script>
    
    <meta property="og:site_name" content="Starling bags-NI | Personalized Bags" />
    <meta property="og:title" content="Starling bags-NI | customizable bags, promotional bags, eco-friendly bags" />
    <meta property="og:image" content="https://starlingbagsni.co.uk/assets/starlinglogo.svg" />

    <link rel="stylesheet" href="product_details.css">

    <title>Starling bags-NI | Product details</title>
</head>

<body>

    <?php include("header.php") ?>
    <?php
    if (isset($_GET['ProId']) && !empty($_GET['ProId'])) {
        $product_id = $_GET['ProId']; //
        // echo $product_id;
        $result = $object->getProductDetails($product_id);
    ?>
        <div class="main-Product-details">
            <div class="Product-details">
                <div class="single-pro-img">
                    <div class="single-img">
                        <img src="adminpanel/<?php echo $result['product_image'] ?>" alt="<?php echo $result['product_name'] ?>" class="main-single-img">
                    </div>
                    <div class="small-img-group">
                        <?php
                        if (!empty($result['product_images'])) {
                            $mainImage = $result['product_image'];
                            // var_dump($mainImage);
                            $imagesarr = json_decode($result['product_images']);
                            if (empty($imagesarr)) {
                                echo '';
                            } else {
                                echo '<img src="adminpanel/' . $mainImage  . '" class="indicator active">';
                                foreach ($imagesarr as $image) {
                                    echo '<img src="adminpanel/' . $image . '" class="indicator active">';
                                }
                            }
                        } else {
                            echo '';
                        }
                        ?>

                    </div>
                </div>
                <div class="single-product-des">
                    <div class="h5 single-product-name"><?= $result['product_name'] ?></div>
                    </p>

                    <div class="single-product-info">
                        <h5 class="single-product-info-title">Product info</h5>
                        <?php
                        if (!empty($result['editable_lable']) && !empty($result['editable_input'])) {
                            $lable_data = json_decode($result['editable_lable']);
                            //print_r($lable_data);
                            //$input_data = json_decode($result['editable_input']);
                            //echo $result['editable_input'];
                            //$inputarray = json_decode($inputs_json);
                            // $str = str_replace(array('"', '[', ']'), '', $result['editable_input']);
                            // $arr = preg_split('/,/', $str);
                        ?>
                            <table>
                                <tbody>
                                    <?php
                                    $arr = json_decode($result['editable_input']);
                                    if (!empty(array_keys($lable_data)) && !empty(array_keys($arr))) {
                                        // The array has keys
                                        // echo "The array contains " . count($myArray) . " elements";
                                        $combined_array = array_combine($lable_data, $arr);
                                        foreach ($combined_array as $label => $input) {
                                            // Echo out the label and input values
                                            echo '<tr> <td for="" class="single-product-info-name pb-3">' . $label . ' : </td> <td class="pb-3">' . $input . '</td> </tr>';
                                            //echo '<p><label class="company-name opt">' . $label . '</label> <span>' . $input . '</span></p>';

                                            // echo '<label>' . $label . '</label><input type="text" name="' . $label . '" value="' . $input . '"><br>';
                                        } ?>
                                </tbody>
                            </table>
                    <?php
                                    } else {
                                    }
                                } else {
                                    echo 'We can make promotional bags in any shape, size, colour or print and can also customise any aspect of your bag including labels, handles, pockets or gussets.';
                                }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="product-descrition">
            <h5 class="product-descrition-title">Description</h5>
            <p>
                <?= $result['pro_description'] ?>
            </p>
        </div>
        <div class="Product-details-btn">
            <button class="btn btn-lg btn-outline-dark Product-details-back-btn">Back</button>

            <a href="getquote?proid=<?php echo (!empty($product_id)) ? $product_id : ''; ?>" class="btn btn-lg btn-outline-dark Product-details-back-Quote">Get Quote</a>
        </div>
    <?php  } else {
        header("Location:404");
        // include("./404.php");
    ?>

    <?php } ?>


    <?php include("footer.php") ?>
    <script src="product_details.js">
    </script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
</body>

</html>
<script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".Product-details-back-btn").on("click", function() {
            // Call the history.back() method
            window.history.back();
        });
    });
</script>