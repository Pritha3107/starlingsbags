<?php

include_once "admin_crud.php";
$classobj = new Admincrud();
$copyimag_json = '';
$mainimag_path = '';
$encodelable = '';
$encodeinput = '';
$exitlablearr = '';
if (isset($_POST['action']) == 'add') {
    $forProdId = $_POST['product_category'];
    $catProdId = strtoupper($classobj->getProductId($forProdId));
    // echo '<pre>';
    $prodId = '#' . str_split($catProdId)[0] . str_split($catProdId)[1] . str_split($catProdId)[2] . rand(0, 999);
    if ($classobj->verifyProductId($prodId) == false) {
        $prodId = '#' . str_split($catProdId)[0] . str_split($catProdId)[1] . str_split($catProdId)[2] . rand(0, 999);
    } else {
        $prodId = $classobj->verifyProductId($prodId);
    }
    // die();
    if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {

        $queryString = $_SERVER['QUERY_STRING'];
    }
    if (!empty($queryString)) {

        parse_str($queryString, $queryArray);
        $arrayValues = $queryArray['values'];
        $encodelable = json_encode($arrayValues);
    }
    // echo $queryString;
    // print_r($queryString);
    //print_r($_FILES['product_image']['size']);
    // die();
    if (empty($_POST['product_name']) && empty($_POST['product_category']) && $_FILES['product_image']['size'] == 0) {
        echo "error";
        return false;
    } else {
        $copy_images = $_FILES['product_images'];
        if ($copy_images['size'] > 0) {

            $functionCall = $classobj->upload($copy_images);
            //print_r($functionCall);
            if ($functionCall != '') {

                $copyimag_json = json_encode($functionCall);
            } else {
                return $copyimag_json;
            }
        }
        $mainimag = $_FILES['product_image'];
        if ($mainimag['size'] > 0) {

            $target_file = $classobj->getMydirectory() . basename($mainimag['name']);
            $result = move_uploaded_file($mainimag['tmp_name'], $target_file);
            if (!$result) {
                return $mainimag_path;
            } else {

                $mainimag_path = $classobj->getMydirectory() . $mainimag['name'];
            }
        }
        if (isset($_POST['editable_input']) != '') {
            $encodeinput = json_encode($_POST['editable_input']);
        }

        $insertarr = array(
            'prod_id' => $prodId,
            'product_name' => $classobj->dbconn->real_escape_string($_POST['product_name']),
            'product_category' => $classobj->dbconn->real_escape_string($_POST['product_category']),
            'product_listing' => $classobj->dbconn->real_escape_string($_POST['product_listing']),
            'product_image' => $classobj->dbconn->real_escape_string($mainimag_path),
            'product_images' => $classobj->dbconn->real_escape_string($copyimag_json),
            'editable_lable' => $classobj->dbconn->real_escape_string($encodelable),
            'editable_input' => $classobj->dbconn->real_escape_string($encodeinput),
            'pro_description' => $classobj->dbconn->real_escape_string($_POST['pro_description'])
        );
        // print_r($insertarr);
        // return true;
        $finalresult = $classobj->addProducts($insertarr);
        echo $finalresult;
    }
}
if (isset($_POST['myaction']) == 'edit') {
    if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {

        $queryString = $_SERVER['QUERY_STRING'];
    }
    //echo $queryString;
    if (!empty($queryString)) {

        parse_str($queryString, $queryArray);
        $arrayValues = $queryArray['values'];
        //print_r($arrayValues);
        $encodelable = json_encode($arrayValues);
        //$encodelable = array_push($newlablearr);
        //$exitlable = json_encode($encodelable);
    }
    //echo $encodelable;
    //print_r($newlablearr);
    //die();
    if ($_POST != '') {
        //print_r($_POST);
        $copy_images = $_FILES['product_images'];
        $old_image = $_POST['existing_images_file'];
        // print_r($copy_images);
        // print_r($old);
        if ($copy_images['size'] > 0) {

            $functionCall = $classobj->upload($copy_images);
            // print_r($functionCall);
            if (!empty($functionCall)) {

                $copyimag_json = json_encode($functionCall);
            } else {
                $copyimag_json = $old_image;
            }
        }
        // print_r($copyimag_json);
        $mainimag = $_FILES['product_image'];
        if ($mainimag['size'] > 0) {

            $target_file = $classobj->getMydirectory() . basename($mainimag['name']);
            $result = move_uploaded_file($mainimag['tmp_name'], $target_file);
            if (!$result) {
                return $mainimag_path;
            } else {
                $mainimag_path = $classobj->getMydirectory() . $mainimag['name'];
            }
        } else {
            $mainimag_path = $_POST['existing_image_file'];
        }
        if (isset($_POST['editable_input']) != '') {
            $encodeinput = json_encode($_POST['editable_input']);
        }
        $id = $_POST['editable-id'];
        $updatearr = array(
            'product_name' => $classobj->dbconn->real_escape_string($_POST['product_name']),
            'product_category' => $classobj->dbconn->real_escape_string($_POST['product_category']),
            'product_listing' => $classobj->dbconn->real_escape_string($_POST['product_listing']),
            'product_image' => $classobj->dbconn->real_escape_string($mainimag_path),
            'product_images' => $classobj->dbconn->real_escape_string($copyimag_json),
            'editable_lable' => $classobj->dbconn->real_escape_string($encodelable),
            'editable_input' => $classobj->dbconn->real_escape_string($encodeinput),
            'pro_description' => $classobj->dbconn->real_escape_string($_POST['pro_description'])
        );
        //echo $id;
        // print_r($updatearr);
        $res = $classobj->updateProduct($updatearr, $id);
        echo $res;
        // if ($finalresult) {
        //     return true;
        // } else {
        //     return false;
        // }
    } else {
        echo "Please Fill the required fields";
    }
}
if (isset($_GET['action']) == 'delete input') {
    //echo 'done';
    $lablevalue = $_GET['labletxt'];
    $inputvalue = $_GET['inputval'];
    $id = $_GET['product_id'];
    if (!empty($lablevalue) && !empty($inputvalue)) {
        $productData = $classobj->showAllProducts($id);
        //print_r($productData);
        if (!$productData) {
            echo 'Server down please try after some times..!';
            //die("Error executing query: " . $mysqli->error);
        } else {
            $row = $productData;
            $json_arr_of_label = json_decode($row["editable_lable"], true);
            $json_arr_of_input = json_decode($row["editable_input"], true);
            //$removeString = $lablevalue;
            //print_r($json_arr_of_label);
            //print_r($json_arr_of_input);
            foreach ($json_arr_of_label as $key => $value) {
                if ($value === $lablevalue) {
                    //echo $value;
                    //echo $json_arr_of_label[$key];
                    unset($json_arr_of_label[$key]);
                }
            }
            $new_json_label = json_encode($json_arr_of_label);
            //echo $new_json_label;
            foreach ($json_arr_of_input as $key => $data) {
                if ($data === $inputvalue) {
                    //echo $data;
                    //echo $json_arr_of_label[$key];
                    unset($json_arr_of_input[$key]);
                }
            }
            $new_json_input = json_encode($json_arr_of_input);
            //echo $new_json_input;
            if (!empty($new_json_label) && !empty($new_json_input)) {

                $result = $classobj->update_label_input($id, $new_json_label, $new_json_input);
                echo $result;
            }
        }
    }
}
if (isset($_GET['shopaction']) == 'delete product') {
    //echo "product delete";
    $delete_id = $_GET['delid'];
    $delete_image = $_GET['deleteimage'];
    $response = $classobj->deleteProduct($delete_id);
    $classobj->removeProductFromRating($delete_id);
    // echo $delete_image;
    if ($response) {
        unlink($delete_image);
    }
    // var_dump($response);
    echo $response;
}

if (isset($_POST['ajaxaction']) == 'quoteFormStructure') {
    $quoteType= $_POST['quotetype'];
    // echo 'quoteFormStructure';
    // print_r($_POST);
    // die();
    // $formstructure_json = '';
    if (!empty($_POST['formdata'])) {

        $formstructure_json = json_encode($_POST['formdata']);
    } else {
        $formstructure_json = $_POST['formdata'];
    }
    // echo $formstructure_json;
    // if (!empty($formstructure_json)) {
    $select = "SELECT * FROM `quote_form_tbl` WHERE `type`= '$quoteType'";
    $selected_row =  $classobj->dbconn->query($select);
    // $rows = $selected_row->num_rows;
    if ($selected_row->num_rows == 0) {

        $query = "INSERT INTO `quote_form_tbl` (type,form_structure_json) VALUES ('$quoteType','$formstructure_json')";
        //echo $query;
        $result =  $classobj->dbconn->query($query);
        echo $result;
    } else {
        $update = "UPDATE  `quote_form_tbl` SET  form_structure_json = '$formstructure_json' WHERE `type`= '$quoteType' ";
        //echo $update;
        $result =  $classobj->dbconn->query($update);
        echo $result;
        //$fetch_data = $selected_row->fetch_all();
        //print_r($fetch_data);
    }
}
if (isset($_GET['fetchform']) == 'fetch form data') {
    // echo 'select';
    $quoteType= $_GET['quotetype'];
    $select = "SELECT form_structure_json FROM `quote_form_tbl` WHERE `type`='$quoteType'";
    $selected_row =  $classobj->dbconn->query($select);
    $fetch_data = $selected_row->fetch_assoc();
    //print_r($fetch_data);
    // foreach ($fetch_data as $data) {
    //     $strArr[] = $data;
    //     //print_r($data);
    // }
    // print_r($strArr);
    print_r($fetch_data['form_structure_json']);
}
if (isset($_GET['orderdelete']) == 'deleteorder') {
    $orderid = $_GET['deletid'];
    // echo $orderid;

    $select = "SELECT referance_image FROM `quotation_info_tbl` WHERE id = '$orderid' ";
    $imageData =  $classobj->dbconn->query($select);
    if ($imageData->num_rows > 0) {
        $images = $imageData->fetch_assoc();
        // print_r(json_decode($images));
        $newImageArr = '';
        foreach ($images as $file) {
            $newImageArr = json_decode($file);
        }
        // print_r($newImageArr);
        if (!empty($newImageArr)) {
            // print_r($newImageArr);
            foreach ($newImageArr as $image) {
                $dir = "../" . $image;
                //echo $dir;
                unlink($dir);
                // echo 'done';
            }
        }
    }
    $sql = "DELETE FROM `quotation_info_tbl` WHERE id = '$orderid'";
    $response =  $classobj->dbconn->query($sql);

    if ($response) {
        // return true;
        echo 'done';
    } else {
        echo 'error';
        // return false;
    }
}
if (isset($_POST['query'])) {
    // echo 'haee';
    $searchTerm = $_POST['query'];
    // print_r($searchTerm);
    $result = $classobj->searchOrderByData($searchTerm);
    echo $result;
}

if (isset($_GET['searchquery'])) {
    // echo 'haee';
    $searchTerm = $_GET['searchquery'];
    // print_r($searchTerm);
    $result = $classobj->searchProductByData($searchTerm);
    echo $result;
}

if(isset($_POST['status'])){
    $statusId=$_POST['prodID'];
    $sql = "UPDATE `quotation_info_tbl` SET `seen` = 1  WHERE `id` = '$statusId'";
    $runSql=$classobj->dbconn->query($sql);
    if($runSql){
        echo true;
    }else{
        echo false;
    }
}
