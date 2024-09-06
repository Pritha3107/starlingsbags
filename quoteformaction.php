<?php
include_once 'curd-model.php';
$object = new Customers();
// echo 'hi';
$input_json = '';
$color_json = '';
$select_json = '';
$product_id = '';
$product_code = '';
$label_names = '';
$referance_image = array();
$newArrayInput = array();
if (isset($_POST['submit'])) {
    // echo '<pre>';
    // print_r($_POST);
    // die();
    if (isset($_POST['additonal_input_groups'])) {
        // $inputarr = $_POST['additonal_input_groups'];
        if(array_filter($_POST['additonal_input_groups'])===[]){
            $input_json='';
        }else{
        $input_txt = $_POST['additonal_input_groups'];
        foreach ($input_txt as $key => $value) {
            array_push($newArrayInput, $value);
        }
        $input_json = json_encode($newArrayInput);
        // print_r($newArrayInput);
        }
        // die();
    }
    // $input_json = json_encode($newArrayInput);
    if (!empty(isset($_POST['colors']))) {
        if(array_filter($_POST['colors'])===[]){
            $color_json='';
        }else{
            $color_json = json_encode($_POST['colors']);
        }
    }

    if (!empty(isset($_POST['product_id']))) {
        $product_id = $_POST['product_id'];
        $product_code = $object->getProductDetails($product_id)['prod_id'];
    }
    if (!empty(isset($_POST['additional_label_info']))) {

        $labelArr = $_POST['additional_label_info'];
        foreach ($labelArr as $key => $name) {
            $newLabelArray[] = $name;
            // print_r($newLabelArray);
        }
        $label_names = json_encode($newLabelArray);
        // echo $label_names;
    }

    $mainimag = $_FILES['referance_image'];
    if ($mainimag['size'] > 0) {

        foreach ($mainimag['tmp_name'] as $key => $tmpName) {
            $newfilename = $mainimag['name'][$key];
            $cleanFileName = preg_replace('/[^\w\d\.-]/', '_', $newfilename);
            $fileName = $object->getMydirectory() . $cleanFileName;
            // echo $fileName;
            if (move_uploaded_file($tmpName, $fileName)) {
                array_push($referance_image, $fileName);

                // $fileSize = $imagefiles['size'][$key];
                // $fileType = $imagefiles['type'][$key];
                //$this->saveToDatabase($fileName, $uploadFile, $fileSize, $fileType);
            }
        }
    }
    // echo $input_json;
    // echo $color_json;
    // echo $label_names;
    // echo $product_id;
    // print_r($referance_image);
    // die();
    $insert_array = array(
        'name_of_company' => $object->dbConn->real_escape_string($_POST['name_of_company']),
        'cust_name' => $object->dbConn->real_escape_string($_POST['cust_name']),
        'cust_email' => $object->dbConn->real_escape_string($_POST['cust_email']),
        'cust_phno' => $object->dbConn->real_escape_string($_POST['cust_phno']),
        //MANO/'cust_address' => $object->dbConn->real_escape_string($_POST['cust_address']),
        'bag_qty' => $object->dbConn->real_escape_string($_POST['bag_qty']),
        'additonal_input_groups' => $object->dbConn->real_escape_string($input_json),
        // 'colors' => $object->dbConn->real_escape_string($color_json),
        //MANO/'bag_printing_text' => $object->dbConn->real_escape_string($_POST['bag_printing_text']),
        'cust_message' => $object->dbConn->real_escape_string($_POST['cust_message']),
        'referance_image' => $object->dbConn->real_escape_string(json_encode($referance_image)),
        'product_id' => $product_id,
        'product_code' => $product_code,
        'additional_label_info' => $object->dbConn->real_escape_string($label_names)
    );
    // echo '<pre>';
    // print_r($insert_array);
    // die();
    $insert = $object->addQuoteForm($insert_array);
    // echo $insert;
    // print_r($label_names);
    // die();
    if (!empty($product_id)) {
        $sql = "SELECT * FROM `rating_tbl` WHERE product_id = '$product_id' ";
        $result = $object->dbConn->query($sql);
        // print_r($result);
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO  `rating_tbl` (product_id,selling_count) VALUES('$product_id',1)";
            $insert_query = $object->dbConn->query($sql);
            //echo $insert_query;
        } else {
            $sellingCount =  $result->fetch_assoc();
            $incrementvalue = $sellingCount['selling_count'];
            ++$incrementvalue;
            // echo $incrementvalue;
            $sql = "UPDATE `rating_tbl` SET  selling_count = '$incrementvalue' WHERE  product_id = '$product_id'";
            $update_query = $object->dbConn->query($sql);
            // echo $update_query;
        }
    }
    if (!$insert) {
        $_SESSION['status'] = '500';
        // header("Location:shop.php");
        echo "Error";
        exit();
    } else {
        $_SESSION['status'] =  '200';
        // header("Location:shop.php");

        echo "Success";
        exit();
    }
}
// if (isset($_GET['action']) == "updatelabeldata") {
//     // echo 'well we did it';
//     $labelDatas = $_GET['datas'];
//     $jsonData = json_encode($labelDatas);
//     $sql = "UPDATE `quotation_info_tbl` SET additional_label_info = '$jsonData' ";
//     // echo $sql;
//     // echo  $label_names;
//     //$label_names = $jsonData;
//     $update =  $object->dbConn->query($sql);
//     // echo $update;
// }