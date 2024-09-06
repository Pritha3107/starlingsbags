<?php
include_once "admin_crud.php";
$classobj = new Admincrud();

if (isset($_POST['action']) == "addcat") {
    //print_r($_POST);
    //print_r($_FILES);
    $file = $_FILES['image_of_category'];
    $cat_name = $classobj->dbconn->real_escape_string($_POST['name_of_categoryadd']);
    $output = $classobj->categoryAdd($cat_name, $file);
    if (!$output) {
        // $res = [
        //     'status' => 204,
        //     'message' => 'Category is failed to updated try again..!'
        // ];
        // echo json_encode($res);
        //print_r($output);
        return false;
    } else {
        $res = [
            'status' => 200,
            'message' => 'Your category has been added Succesfully'
        ];
        echo json_encode($res);
        //print_r($output);
        //return false;
        return true;
    }
}
if (isset($_GET['action']) == 'getcat') {
    //echo "yes get";
    $out = $classobj->showAllCategory();
    print_r($out);
    //return true;
}
if (isset($_GET['request']) == 'checkcat') {
    //echo 'delete function';
    $categoryExists = false;
    //print_r($_GET['delid']);
    if ($_GET['path'] != '' && $_GET['delid'] != '') {
        $product_list = $classobj->showAllProducts();
        if (!$product_list) {
            unlink($_GET['path']);
            $result = $classobj->deleteCategory($_GET['delid']);
            echo $result;
            // echo $result;
            return true;
        } else {
            $rows = $product_list->fetch_all(MYSQLI_ASSOC);

            if ($rows) {
                foreach ($rows as $row) {
                    //print_r($row['product_category']);
                    if ($row['product_category'] == $_GET['delid']) {
                        $categoryExists = true;
                        break;
                    }
                }
                if ($categoryExists) {
                    echo 'already used';
                } else {
                    //echo 'delete action ok';
                    if (unlink($_GET['path'])) {
                        $result = $classobj->deleteCategory($_GET['delid']);
                        echo $result;
                        return true;
                    }
                }
            }
        }
    } else {
        return false;
    }
}
if (isset($_GET['deletcat']) == 'confirm delete') {
    if ($_GET['path'] != '' && $_GET['delid'] != '') {
        //echo $_GET['delid'];
        $id = $_GET['delid'];
        $selectDependingProducts = $classobj->getProductByCatId($_GET['delid']);
        //print_r($selectDependingProducts);
        if (!empty($selectDependingProducts)) {
            //echo 'yes';
            $updated_data = $selectDependingProducts->fetch_all();
            for ($i = 0; $i < count($updated_data); $i++) {
                $query = " UPDATE `product_tbl` SET product_category = NULL WHERE  product_category = '$id' ";
                //$classobj->dbConn
                $runSql = $classobj->dbconn->query($query);
                //echo $runSql;
            }
            // foreach ($updated_data as $data) {

            //     echo $query;
            //     // if ($data['product_category'] == $_GET['delid']) {
            //     // }
            // }
        }
        //die();
        if (unlink($_GET['path'])) {
            $result = $classobj->deleteCategory($_GET['delid']);

            echo $result;
            return true;
        } else {
            return false;
        }
    }
}
if (isset($_GET['req']) == 'chack old Password') {
    //echo "check password";
    // echo $_GET['userId'];
    // echo $_GET['oldPass'];
    $userData =  $classobj->selectUser($_GET['userId']);
    if (!$userData) {
        return false;
    } else {

        print_r($userData['password']);
        return true;
    }
}
if (isset($_GET['actionreq']) == 'get cat') {
    $editcat =  $classobj->getCategories($_GET['editId']);
    if (!$editcat) {
        return false;
    } else {
        echo json_encode($editcat);
        //print_r($editcat);
        return true;
    }
}
$new_image = '';
if (isset($_POST['editaction']) == "editcat") {
    // echo 'hi';
    // print_r($_POST['name_of_category']);
    // print_r($_POST['oldimage']);
    // print_r($_FILES['image_of_category']);
    // print_r($_POST['editid']);
    //var_dump($_POST);
    $id = $_POST['editid'];
    $edit_cat_name = $classobj->dbconn->real_escape_string($_POST['name_of_category']);
    $existing_image = $_POST['oldimage'];
    $new_image = $_FILES['image_of_category'];
    //print($new_image['error']);
    if ($new_image != '' && $new_image['error'] == 0) {
        $fileok =  $classobj->validateFile($new_image);
        if (!$fileok) {
            //echo $fileok;
            // $res = [
            //     'status' => 400,
            //     'message' => 'File already exists'
            // ];
            // echo json_encode($res);
            //echo $res;
            return false;
        } else {
            if (unlink($existing_image)) {
                $result = move_uploaded_file($new_image['tmp_name'], $classobj->getCatdirectory() . $new_image['name']);
                $path =  $classobj->getCatdirectory() . $new_image['name'];
                $updated_data = array(
                    'name_of_category' => $edit_cat_name,
                    'image_of_category' => $path,
                );
                $output = $classobj->updateCat($updated_data, $id);
                if (!$output) {
                    $res = [
                        'status' => 204,
                        'message' => 'Somthing went to wrong try agin..!'
                    ];
                    echo json_encode($res);
                    //print_r($output);
                    return false;
                } else {
                    $res = [
                        'status' => 200,
                        'message' => 'Category has been updated successfully..!'
                    ];
                    echo json_encode($res);
                    //print_r($output);
                    return true;
                }
            }
        }
    } else {
        // $edit_cat_name;
        // $existing_image;
        $updated_data = array(
            'name_of_category' => $edit_cat_name,
            'image_of_category' => $existing_image,
        );
        if ($updated_data != '') {
            $output = $classobj->updateCat($updated_data, $id);
            if (!$output) {
                $res = [
                    'status' => 204,
                    'message' => 'Category is failed to updated try again..!'
                ];
                echo json_encode($res);
                //print_r($output);
                return false;
            } else {
                $res = [
                    'status' => 200,
                    'message' => 'Category has been updated successfully..!'
                ];
                echo json_encode($res);
                //print_r($output);
                //return false;
                return true;
            }
        }
    }
}
if (isset($_GET['req']) == 'chack old Password') {
    //echo "check password";
    // echo $_GET['userId'];
    // echo $_GET['oldPass'];
    $userData =  $classobj->selectUser($_GET['userId']);
    print_r($userData['password']);
}
if (isset($_POST['formaction']) == 'changepassword') {
    //echo 'changepassword';
    //echo $_SESSION['id'];
    $userid =  $_SESSION['id'];
    $newpassword = $_POST['newpassword'];
    if ($userid != '' && $newpassword != '') {
        $output = $classobj->changePassword($newpassword, $userid);
        //print_r($output);
        if ($output) {
            echo 'ok';
            //return 1;
        } else {
            return 'notok';
            //echo 'Your password has been changed succssfully...!';
        }
    }
}
if (isset($_GET['listaction']) == 'addlisting') {
    //echo 'add listing';
    if ($_GET['title'] != '') {
        $listing_title = $classobj->dbconn->real_escape_string($_GET['title']);
        $insert = $classobj->addListing($listing_title);
        echo $insert;
    }
}
if (isset($_GET['listingaction']) == 'getlisting') {
    //echo 'get listing';
    $output = $classobj->getListingName();
    echo $output;
}
if (isset($_GET['getname']) == 'get-list-name') {
    $result = $classobj->getListingNameById($_GET['id']);
    echo $result;
}
if (isset($_GET['setname']) == 'set-list-name') {
    $edited_txt =  $classobj->dbconn->real_escape_string($_GET['title']);
    $id = $_GET['id'];
    if (!empty($edited_txt) && !empty($id)) {
        $output = $classobj->updateListing($id, $edited_txt);
        echo $output;
    }
}
if (isset($_GET['removename']) == 'check-list-name') {
    //echo 'update listing';removeListing
    $del_id = $_GET['id'];
    if (!empty($del_id)) {
        // $output = $classobj->removeListing($del_id);
        // echo $output;
        $dependingProducts = $classobj->getProductBylistId($del_id);
        //$output = $classobj->removeListing($del_id);
        //print_r($dependingProducts);
        if (!empty($dependingProducts)) {
            // $updated_data = $dependingProducts->fetch_all();
            // for ($i = 0; $i < count($updated_data); $i++) {
            //     $query = " UPDATE `product_tbl` SET product_listing = NULL WHERE  product_listing = '$del_id' ";
            //     //$classobj->dbConn
            //     $runSql = $classobj->dbconn->query($query);
            // }
            echo 'already used';
            //return false;
        } else {
            $output = $classobj->removeListing($del_id);
            echo $output;
            //echo 'not used';
        }
    }
}
if (isset($_GET['removelist']) == 'remove-list-name') {
    $remove_id = $_GET['id'];
    if (!empty($remove_id)) {
        $dependingProducts = $classobj->getProductBylistId($remove_id);
        $updated_data = $dependingProducts->fetch_all();
        //print_r($updated_data);
        for ($i = 0; $i < count($updated_data); $i++) {
            $query = " UPDATE `product_tbl` SET product_listing = NULL WHERE  product_listing = '$remove_id' ";
            //$classobj->dbConn
            $runSql = $classobj->dbconn->query($query);
        }
        $output = $classobj->removeListing($remove_id);
        echo $output;
    }
}
if (isset($_POST['contactform']) == "addcontact") {
    // echo ("contact form functionality");
    // $id = 1;
    unset($_POST['contactform']);
    $array = $_POST;
    $sql = "UPDATE `contact_tbl` SET ";
    // Construct the update statement dynamically
    foreach ($array as $key => $value) {
        $value = $classobj->dbconn->real_escape_string($value); // Sanitize the value
        $sql .= "$key = '$value', ";
    }

    // Remove the trailing comma and space
    $sql = rtrim($sql, ', ');

    // Add the WHERE clause to specify the row to update
    // $sql .= " WHERE id = $id";
    // echo $sql;
    $result = $classobj->dbconn->query($sql);
    echo $result;
}
if (isset($_GET['showcontact']) == "fetchcontactdata") {
    // echo "showing contact data input";
    $query = " SELECT * FROM `contact_tbl` ";
    $runSql = $classobj->dbconn->query($query);
    if (!$runSql) {
        return false;
    } else {
        if ($runSql->num_rows > 0) {
            $result = $runSql->fetch_assoc();
            // print_r($result['socialmedia_links']);

            echo json_encode($result);
        } else {
            return false;
        }
    }
}
