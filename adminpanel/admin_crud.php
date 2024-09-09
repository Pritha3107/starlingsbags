<?php
//session_start();
//include '../Database/dbConfig.php';
include '../curd-model.php';

class Admincrud extends Customers
{
    public $dbconn;
    public $baseurl;
    public $cattable = "category_tbl";
    public $protable = "product_tbl";
    public $listingtable = "listing_tbl";
    public $ordertable = "quotation_info_tbl";
    public $ratingtabel = "rating_tbl";
    public $contactTable = "contact_tbl";
    public $EnquiryTable = "enquiry_request";
    private $uploadDir;
    private $categoryDir;
    public function __construct()
    {
        $connection = new DB();
        $this->dbconn = $connection->db_connection();
        $this->uploadDir = "productimages/";
        $this->categoryDir = "categoryimages/";
        $this->baseurl = $connection->basePath();
    }

    public function getMydirectory()
    {
        return $this->uploadDir;

    }

    public function getCatdirectory()

    {

        return $this->categoryDir;

    }

    public function categoryAdd($data, $image)

    {

        if ($data != '' && $image != "") {

            $fileok =  $this->validateFile($image);

            if (!$fileok) {

                echo $fileok;

            } else {

                $result = move_uploaded_file($image['tmp_name'], $this->categoryDir . $image['name']);

                $path = $this->categoryDir . $image['name'];

                if (!$result) {

                    echo $result;

                } else {

                    $insert = "INSERT INTO " . $this->cattable . "(name_of_category,image_of_category) VALUES ('$data','$path')";

                    $runsql = $this->dbconn->query($insert);

                    //print_r($runsql);

                    if ($runsql) {

                        //echo "Your category has been added Succesfully";

                        return true;

                    } else {

                        //echo "Your category Not added try agin..!!";

                        return false;

                    }

                }

            }

        }

    }

    public function validateFile($file)

    {

        // Check if file exists

        if (!file_exists($file['tmp_name'])) {

            echo 'File does not exist';

            return false;

        }



        // Check file size

        // if ($file['size'] > $this->maxFileSize) {

        //     throw new Exception('File is too large');

        // }



        // // Check file type

        // $fileType = mime_content_type($file['tmp_name']);

        // if (!in_array($fileType, $this->allowedFileTypes)) {

        //     throw new Exception('File type not allowed');

        // }



        // Check if file already exists

        if (file_exists($this->categoryDir . $file['name'])) {

            echo 'File already exists';

            return false;

        }



        return true;

    }



    public function showAllCategory()

    {

        $sql = "SELECT * FROM $this->cattable WHERE deleted_at IS NULL";

        //echo $sql;

        $runSql = $this->dbconn->query($sql);

        //print_r($runSql);

        if ($runSql->num_rows > 0) {

            while ($row = $runSql->fetch_assoc()) {



                echo '<div class="card col-lg-2 col-md-3 col-sm-4 col-6 m-3">

                        <div class="card-header">

                            <h3>' . $row['name_of_category'] . '</h3>

                        </div>

                        <div class="card-body">

                            <img  src="' . $row['image_of_category'] . '" alt="" height="200" style="object-fit:contain; mix-blend-mode: multiply;">

                        </div>

                        <div class="card-foot d-flex justify-content-evenly">

                            <button class="btn btn-outline-dark added-categories-edit-btn"id="' . $row['image_of_category'] . '" value="' . $row['id'] . '">Edit</button>

                            <button class="btn btn-outline-dark added-categories-delete-btn" id="' . $row['image_of_category'] . '" value="' . $row['id'] . '">Delete</button>

                         </div>

                    </div>';

            }

        } else {

            echo '

          <div class="card-body">

                    <img  src="assets/no-items-found.gif" width="400px" height="200px"  style="object-fit:contain; mix-blend-mode: multiply;">

                    </div>

                </div>';

            //return false;

        }

    }



    public function deleteCategory($id)

    {

        // $selectDependingProducts = $this->getProductByCatId($id);

        // print_r($selectDependingProducts);

        // die();

        $query =  "DELETE FROM " . $this->cattable . " WHERE id = '$id' ";

        // echo $query;

        // die();

        $okid = $this->dbconn->query($query);

        //echo $okid;

        //die();

        if ($okid) {



            echo "Category Removed Successfully..!";

            //return true;

        } else {

            //echo "Somthing went wrong Try agin..!";

            return false;

        }

    }

    public function getProductByCatId($id)

    {

        if (!empty($id)) {

            $sql = "SELECT product_category FROM " . $this->protable . " WHERE product_category = " . $id . " AND deleted_at IS NULL";

            //echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql->num_rows > 0) {

                return $runsql;

            } else {

                return false;

            }

        } else {

            echo 'category id was missing';

        }

    }

    public function getProductBylistId($id)

    {

        if (!empty($id)) {

            $sql = "SELECT product_listing FROM " . $this->protable . " WHERE product_listing = " . $id . " AND deleted_at IS NULL";

            //echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql->num_rows > 0) {

                return $runsql;

            }

        } else {

            echo 'category id was missing';

        }

    }

    public function getCategories($id = null)

    {

        if ($id == null) {

            $sql = "SELECT * FROM $this->cattable WHERE deleted_at IS NULL ";

            // echo $sql;

            $runSql = $this->dbconn->query($sql);

            if ($runSql->num_rows > 0) {



                $edit_data = $runSql->fetch_all(MYSQLI_ASSOC);

                return $edit_data;

            }

        } else {

            $sql = "SELECT * FROM $this->cattable WHERE id = '$id' AND deleted_at IS NULL ";

            //echo $sql;

            $runSql = $this->dbconn->query($sql);

            // print_r($runSql);

            if ($runSql->num_rows > 0) {

                $editdata =  $runSql->fetch_assoc();

                // return $editdata['name_of_category'];

                return $editdata;

            } else {

                return false;

            }

        }

    }

    public function updateCat($data, $id)

    {

        $query = '';

        if ($data && $id) {



            foreach ($data as $key => $value) {

                $query .= $key . "='" . $value . "', ";

            }

            $query = substr($query, 0, -2);

            //print_r($query);



            $query = "UPDATE " . $this->cattable . " SET " . $query . " WHERE id= " . $id . "";

            // echo $query;

            $runSql = $this->dbconn->query($query);

            if ($runSql) {

                //echo "Category is successfully updated..!";

                return true;

            } else {

                //echo "somthing went to wrong";

                return false;

            }

        }

    }

    public function selectUser($id = null)

    {

        if ($id == null) {

            $sql = "SELECT * FROM $this->loingtable";

            //echo $sql;

            $runSql = $this->dbconn->query($sql);

            //print_r($runSql);

            if ($runSql->num_rows > 0) {

                $user_data = $runSql->fetch_all();

                return $user_data;

            }

        } else {

            $sql = "SELECT * FROM $this->loingtable WHERE id = '$id'";

            //echo $sql;

            $runSql = $this->dbconn->query($sql);

            //print_r($runSql);

            if ($runSql->num_rows > 0) {

                $user_data = $runSql->fetch_assoc();

                return $user_data;

            }

        }

    }

    public function changePassword($pass, $id)

    {

        if ($pass && $id) {

            $query = "UPDATE $this->loingtable SET password = '$pass' WHERE id= '$id'";

            //$query = "UPDATE " . $this->loingtable . " SET password = " . $pass . " WHERE id = " . $id . "";

            //echo $query;

            $runquery = $this->dbconn->query($query);

            //print_r($runquery);

            if ($runquery) {

                return true;

            } else {

                return false;

            }

        }

    }



    public function addProducts($data)

    {

        if ($data != '') {

            // print_r($data);

            $sql = "INSERT INTO " . $this->protable . " (";

            $sql .= implode(",", array_keys($data)) . ') VALUES (';

            $sql .= "'" . implode("','", array_values($data)) . "')";

            // echo $sql;

            // die();

            //$runsql = $this->dbconn->query($sql);

            if (!$this->dbconn->query($sql)) {

                return false;

            } else {

                // echo "success";

                return "success";

            }

        }

    }

    public function upload($imagefiles)

    {

        $uploadedFiles = array();

        foreach ($imagefiles['tmp_name'] as $key => $tmpName) {

            $fileName = $this->uploadDir . basename($imagefiles['name'][$key]);

            if (move_uploaded_file($tmpName, $fileName)) {

                $uploadedFiles[] = $fileName;

                // $fileSize = $imagefiles['size'][$key];

                // $fileType = $imagefiles['type'][$key];

                //$this->saveToDatabase($fileName, $uploadFile, $fileSize, $fileType);

            }

        }

        return $uploadedFiles;

    }



    public function getProductId($id)

    {

        $sql = "SELECT * FROM $this->cattable WHERE id = '$id' AND deleted_at IS NULL ";

        $runSql = $this->dbconn->query($sql);

        // print_r($runSql);

        if ($runSql->num_rows > 0) {

            $editdata =  $runSql->fetch_assoc();

            return $editdata['name_of_category'];

        } else {

            return false;

        }

    }



    public function verifyProductId($id)

    {

        $verifySql = "SELECT prod_id FROM " . $this->protable . " WHERE prod_id = '$id'";

        $runVerifySql = $this->dbconn->query($verifySql);

        if ($runVerifySql->num_rows > 0) {

            return false;

        } else {

            return $id;

        }

    }

    public function createProductId($id)

    {

        $sql = "SELECT pro_id,prod_id,product_name FROM " . $this->protable . " WHERE deleted_at IS NULL";

        $runsql = $this->dbconn->query($sql);

        if ($runsql) {

            // return $runsql;

            $id = $runsql->fetch_assoc()['product_category'];

            return $this->getProductId($id);

        } else {

            return false;

        }

    }



    public function showAllProducts($id = null)

    {

        if ($id == null) {



            $sql = "SELECT pro_id,prod_id,product_name,product_category,product_image FROM " . $this->protable . " WHERE deleted_at IS NULL";

            //echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql->num_rows > 0) {

                return $runsql;

            } else {

                return false;

            }

        } else {

            $sql = "SELECT * FROM " . $this->protable . " WHERE pro_id = '$id' AND deleted_at IS NULL";

            //echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql->num_rows > 0) {

                $rows = $runsql->fetch_assoc();

                return $rows;

            } else {

                return false;

            }

        }

    }

    public function updateProduct($update_data, $id)

    {

        $update_query = "UPDATE " . $this->protable . " SET ";

        foreach ($update_data as $column => $value) {

            $update_query .= $column . "='" . $value . "',";

        }

        $update_query = rtrim($update_query, ',');

        $update_query .= " WHERE pro_id = $id";

        //echo '<pre>';

        //print_r($update_query);

        //die();

        $runsql = $this->dbconn->query($update_query);

        if ($runsql) {

            //echo "Your Data uploaded Succesfully";

            return true;

        } else {

            //echo 'error on db';

            return false;

        }

    }

    public function update_label_input($id, $label, $input)

    {

        $update = " UPDATE " . $this->protable . " SET editable_lable = '$label', editable_input = '$input' WHERE pro_id = '$id'";

        //echo $update;

        //$runSql = $this->dbconn->query($update);

        if ($update) {

            echo 'success';

            //return true;

        } else {

            echo 'not updated';

            //return false;

        }

    }

    public function deleteProduct($id)

    {

        $sql = "DELETE FROM " . $this->protable . " WHERE pro_id = '$id' ";

        //echo $sql;

        $runSql = $this->dbconn->query($sql);

        if ($runSql) {

            //echo 'success';

            return true;

        } else {

            //echo 'not updated';

            return false;

        }

    }

    public function addListing($data)

    {

        if ($data != '') {

            $sql = "INSERT INTO " . $this->listingtable . "(name_of_list) VALUES ('$data') ";

            //echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql) {

                //echo "Your Data uploaded Succesfully";

                return true;

            } else {

                //echo 'error on db';

                return false;

            }

        }

    }

    public function getListingName()

    {

        //$sql = "SELECT * FROM " . $this->listingtable . " WHERE deleted_at NULL ";

        $sql = "SELECT * FROM " . $this->listingtable . " WHERE deleted_at IS NULL";

        //echo $sql;

        $runsql = $this->dbconn->query($sql);

        if ($runsql->num_rows > 0) {

            while ($rows = $runsql->fetch_assoc()) {

                //print_r($rows);

                echo '<div class="card text-center added-listing-card">

                    <div class="card-header">

                        <h3 class="added-list-title">' . $rows['name_of_list'] . '</h3>

                        

                    </div>

                

                    <div class="card-body w-100">

                        <div class="w-100">

                            <button class="btn btn-outline-dark added-listing-edit-btn" id="added_listing_edit_btn" data-srno=' . $rows['id'] . '>Edit</button>

                            <button class="btn btn-outline-dark added-listing-delete-btn" id="added-listing-delete-btn ' . $rows['id'] . '" data-srno=' . $rows['id'] . '>Delete</button>

                        </div>

                

                    </div>

                </div>';

            }

        }

    }

    public function getListingNameById($id)

    {

        if (!empty($id)) {

            $sql = "SELECT * FROM " . $this->listingtable . " WHERE id = '$id' AND deleted_at IS NULL ";

            //echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql->num_rows > 0) {

                $row = $runsql->fetch_assoc();

                echo json_encode($row);

                //return $row['name_of_list'];

            }

        }

    }

    public function updateListing($id, $data)

    {

        if (!empty($id)) {

            $sql = "UPDATE `$this->listingtable` SET `name_of_list`='$data' WHERE id = '$id'";

            echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql) {

                return true;

            } else {

                return false;

            }

        }

    }

    public function removeListing($id)

    {

        if (!empty($id)) {

            $sql = "UPDATE `$this->listingtable` SET `deleted_at`= true WHERE id = '$id'";

            //echo $sql;

            $runsql = $this->dbconn->query($sql);



            // $update_product = "UPDATE `$this->protable` SET `product_listing`= NULL WHERE id = '$id'";

            //echo $sql;

            // $update = $this->dbconn->query($update_product);

            if ($runsql) {



                return true;

            } else {

                return false;

            }

        }

    }

    public function getlistingCategory()

    {

        $sql = "SELECT * FROM " . $this->listingtable . " WHERE deleted_at IS NULL";

        //echo $sql;

        $runsql = $this->dbconn->query($sql);

        if ($runsql->num_rows > 0) {

            $listing_data = $runsql->fetch_all(MYSQLI_ASSOC);

            return $listing_data;

        }

    }

    public function listingNameById($id)

    {

        if (!empty($id)) {

            $sql = "SELECT * FROM " . $this->listingtable . " WHERE id = '$id' AND deleted_at IS NULL ";

            // echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql->num_rows > 0) {

                $row = $runsql->fetch_assoc();

                //echo json_encode($row);

                return $row;

            } else {

                return false;

            }

        }

    }



    public function getOrdersDetailsCount()

    {



        $sql = "SELECT * FROM " . $this->ordertable . " ORDER BY `id` DESC";

        // echo $sql;

        $runsql = $this->dbconn->query($sql);

        if ($runsql->num_rows > 0) {

            $row = $runsql->fetch_all(MYSQLI_ASSOC);

            //echo json_encode($row);

            return $row;

        } else {

            return false;

        }

    }

    public function removeOrders($id)

    {

        $sql = " UPDATE " . $this->ordertable . " SET deleted_at = true  WHERE order_id = '$id' ";

        echo $sql;

    }

    public function getOrderByOderid($id)

    {

        $sql = "SELECT * FROM " . $this->ordertable . " WHERE order_id = '$id'  ";

        // echo $sql;

        $runsql = $this->dbconn->query($sql);

        if (!$runsql) {

            // echo 'server down';

            return false;

        } else {

            if ($runsql->num_rows > 0) {

                $rows = $runsql->fetch_assoc();

                return $rows;

            } else {

                //echo 'no data found';

                return false;

            }

        }

    }

    public function productsRating()

    {

        $sql = "SELECT * FROM " . $this->ratingtabel . " ORDER BY `selling_count` DESC ";

        // echo $sql;

        $runSql = $this->dbconn->query($sql);

        if (!$runSql) {

            return false;

        } else {

            if ($runSql->num_rows > 0) {

                $rows = $runSql->fetch_all(MYSQLI_ASSOC);

                return $rows;

            } else {

                return false;

            }

        }

    }

    public function fetchProductsByProId($id)

    {



        $sql = "SELECT pro_id,prod_id,product_name,product_image FROM " . $this->protable . " WHERE pro_id = '$id' ";

        // echo $sql;

        $runSql = $this->dbconn->query($sql);

        if (!$runSql) {

            return false;

        } else {

            if ($runSql->num_rows > 0) {

                $rows = $runSql->fetch_all(MYSQLI_ASSOC);

                return $rows;

            } else {

                return false;

            }

        }

    }

    public function removeProductFromRating($id)

    {

        $sql = " DELETE FROM " . $this->ratingtabel . " WHERE  product_id = '$id' ";

        //echo $sql;

        $this->dbconn->query($sql);

    }



    public function searchOrderByData($searchstr)

    {



        $sql = "SELECT * FROM " . $this->ordertable . " WHERE order_id LIKE '%$searchstr%' 

        OR name_of_company LIKE '%$searchstr%' 

        OR cust_name LIKE '%$searchstr%' 

        OR cust_email LIKE '%$searchstr%'

        OR cust_phno LIKE '%$searchstr%'

        OR cust_address LIKE '%$searchstr%'

        OR product_code LIKE '%$searchstr%' ";

        // echo $sql;

        $runSql = $this->dbconn->query($sql);

        if (!$runSql) {

            return false;

        } else {

            if ($runSql->num_rows > 0) {

                // $rows = $runSql->fetch_all(MYSQLI_ASSOC);

                // print_r($rows);

                // echo json_encode($rows);

                while ($row = $runSql->fetch_assoc()) {

                    // echo $row['order_id'];

                    $datetime = $row['crated_at'];

                    $timestamp = strtotime($datetime);

                    $formattedDate = date('M d, Y', $timestamp);

                    $formattedTime = date('h:i A', $timestamp);

                    echo '<div class="card search" id = "row' . $row['id'] . '">

                    

                    <div class="card-header">

                        <h4 class="order-id-name">Order ID :

                            <span id="order-id">' . $row['order_id'] . '</span>

                        </h4>';

                    if ($row['product_code'] != '') {

                        echo ' <h4 class="order-id-name">Product Code :

                        <span id="order-id">' . $row['product_code'] . '</span>

                    </h4>';

                    }

                    echo '<div class="date-time">

                            <p class="date">' . $formattedDate . '</p>

                            <p class="time">' . $formattedTime . '</p>

                        </div>

                    </div>

                    <hr>

                    <div class="card-body table-responsive">

                        <table>

                            <tbody>

                                <tr>

                                    <th class="text-center"> Name</th>

                                    <td class="text-center">

                                        <h5 class="user-name ">' . $row['cust_name'] . ' </h5>

                                        <span class="user-mail-id ">' . $row['cust_email'] . ' </span>

                                    </td>

                                </tr>

                                <tr>

                                    <th class="text-center">Address</th>

                                    <td class="text-center">

                                        <h7>' . $row['cust_address'] . ' </h7>

                                    </td>



                                </tr>

                                <tr>

                                    <td class="button">

                                        <a href="order_details.php?orderid=' . $row['order_id'] . '" class="btn btn-outline-success" data-bs-toggle="tooltip" title="View"><i class="fa-solid fa-eye"></i></a>

                                        <button class="btn btn-outline-danger delete" data-bs-toggle="tooltip" title="Delete" data-id="' . $row['id'] . '">

                                            <i class="fa-solid fa-trash-can"></i>

                                        </button>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>';

                }

            } else {

                // return false;

                echo '<div class="card">

                <div class="card-header">



                    <h4 class="order-id-name">

                        <span id="order-id"></span>

                    </h4>

                    <h4 class="order-id-name">

                        <span id="order-id"></span>

                    </h4>

                    <div class="date-time">

                        <p class="date"></p>

                        <p class="time"></p>

                    </div>

                </div>

                <hr>

                <div class="card-body table-responsive">

                    <table>

                        <tbody>

                            <tr>

                            <div class="d-flex justify-content-center"><img src="assets/no-items-found.gif" alt="" width="300px" style="object-fit:contain; mix-blend-mode: multiply;"></div>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>';

            }

        }

    }



    public function searchProductByData($searchstr)

    {



        $sql = "SELECT * FROM " . $this->protable . " WHERE pro_id LIKE '%$searchstr%' 

        OR prod_id LIKE '%$searchstr%' 

        OR product_name LIKE '%$searchstr%' 

        OR product_category LIKE '%$searchstr%' ";

        // echo $sql;

        $runSql = $this->dbconn->query($sql);

        if (!$runSql) {

            return false;

        } else {

            if ($runSql->num_rows > 0) {

                // $rows = $runSql->fetch_all(MYSQLI_ASSOC);

                // print_r($rows);

                // echo json_encode($rows);

                while ($result = $runSql->fetch_assoc()) {

                    // echo $row['order_id'];

                    $category_id = $result['product_category'];

                    echo ' <tr id="row' . $result['pro_id'] . '">

                                <td>

                                <h6>' . $result['prod_id'] . '</h6>

                                </td>

                            <td>

                                <h6><img src="' . $result['product_image'] . '" alt="" width="100px" height="100px"></h6>

                            </td>

                            <td>

                            <h6>' . $result['product_name'] . '</h6>

                            </td>';

                    echo '<td>';

                    if ($category_id != '') {

                        $cat_name = $this->getCategories($category_id);

                        //print_r($cat_name['name_of_category']);

                        echo '<h6>

                                ' . $cat_name['name_of_category'] . '

                        </h6>';

                    } else {

                        echo '<h6>



                        </h6>';

                    }

                    echo '</td>';

                    echo '<td>

                            <a href="view_product.php?id=' . $result['pro_id'] . '" class="btn btn-outline-success" data-bs-toggle="tooltip" title="View"><i class="fa-solid fa-eye"></i></a>

                            <a href="editnew_product.php?id=' . $result['pro_id'] . '" class="btn btn-outline-info" data-bs-toggle="tooltip" title="Edit"><i class="fa-solid fa-pen-to-square" title="Edit" class="tooltip"></i></a>

                            <button class="btn btn-outline-danger delete" data-bs-toggle="tooltip" title="Delete" data-id="' . $result['pro_id'] . '" data-value="' . $result['product_image'] . '">

                                <i class="fa-solid fa-trash-can"></i>

                            </button>

                        </td>';

                    echo '</tr>';

                }

            } else {

                // return false;

                echo '<tr>';

                echo '<td colspan="5"><h6> <img src="assets/no-items-found.gif" alt="" width="300px" style="object-fit:contain; mix-blend-mode: multiply;"></h6></td>';

            }

        }

    }


    public function newOrderCount()
    {
        $sql="SELECT * FROM " . $this->ordertable . " WHERE `seen` LIKE '0%'";
        $runSql=$this->dbconn->query($sql);
        return $runSql->fetch_all(MYSQLI_ASSOC);
    }

    /*
      This function used to return the count for the UNREAD messages from the database table
      enquiry_request

      If the return value > 0 then it will show the count
      If the return value <= 0 then NO-NOTIFICATION will be displayed to the end-user

      return value => count of unread messages
    */
    public function newEnquiryRequestCount()
    {
        $sql="SELECT count(id) FROM " . $this->EnquiryTable . " WHERE read_status != 1";
        $runSql=$this->dbconn->query($sql);
        return $runSql->fetch_all(MYSQLI_ASSOC);
    }

    /*
      This function used to UPDATE all the UNREAD messages from the database table
      enquiry_request
    */
    public function updateUnreadEnquiryRequests()
    {
        $sql="UPDATE " . $this->EnquiryTable . " SET read_status = 1 WHERE read_status != 1";
        $runSql=$this->dbconn->query($sql);
    }


    // future purpose :

    // public function addContactInfo($data)

    // {

    //     if ($data != '') {

    //         // print_r($data);

    //         $sql = "INSERT INTO " . $this->contactTable . " (";

    //         $sql .= implode(",", array_keys($data)) . ') VALUES (';

    //         $sql .= "'" . implode("','", array_values($data)) . "')";

    //         // echo $sql;

    //         // die();

    //         //$runsql = $this->dbconn->query($sql);

    //         if (!$this->dbconn->query($sql)) {

    //             return false;

    //         } else {

    //             // echo "success";

    //             return true;

    //         }

    //     }

    // }

    public function getEnquiryTable()

    {


        $sql = "SELECT * FROM `enquiry_request` ORDER BY `id` DESC;";



            // echo $sql;

            $runsql = $this->dbconn->query($sql);

            if ($runsql->num_rows > 0) {

                return $runsql;

            } else {

                return false;

            }

    }
    
    // public function deleteEnquiryById($enquiryId) {
    //     // Your database deletion logic goes here...
    //     // Return true if deletion is successful, false otherwise
    //     // For example:
    //     $sql = "DELETE FROM `enquiry_request` WHERE id = '$enquiryId'";
    //     if (mysqli_query($this->conn, $sql)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    //     // $sql = "DELETE FROM `enquiry_request` WHERE id = ?";
    //     // $stmt = mysqli_query($this->conn, $sql);
    //     // mysqli_stmt_bind_param($stmt, "i", $enquiryId);
    //     // mysqli_stmt_execute($stmt);
    //     // $result = mysqli_stmt_affected_rows($stmt);
    //     // mysqli_stmt_close($stmt);
    //     // return $result > 0;
    // }
    public function deleteEnquiryById($id) {
        $query = "DELETE FROM " . $this->EnquiryTable . " WHERE id = '$id'";
        if ($this->dbconn) {
            $result = $this->dbconn->query($query);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            // Handle the error
            return false;
        }
    }
    public function getUnreadMessageCount() {
        $sql = "SELECT COUNT(*) as unread_count FROM enquiry_request WHERE is_read = 0";
        $result = $this->conn->query($sql);
        
        if ($result && $row = $result->fetch_assoc()) {
            return (int)$row['unread_count'];
        }
        
        return 0;
    }

    /**
     * Mark a message as read
     * 
     * @param int $id The ID of the message to mark as read
     * @return bool True if successful, false otherwise
     */
    public function markMessageAsRead($id) {
        $id = $this->conn->real_escape_string($id);
        $sql = "UPDATE enquiry_request SET is_read = 1 WHERE id = '$id'";
        
        if ($this->conn->query($sql)) {
            return true;
        }
        
        return false;
    }

    public function getEnquiryById($id)
    {
        // Get the connection using the db_connection() method
        $conn = $this->db_connection();

        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT * FROM enquiry_request WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $enquiry = $result->fetch_assoc();

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        return $enquiry;
    }
    
}

