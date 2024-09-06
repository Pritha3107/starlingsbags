<?php
session_start();
include 'Database/dbConfig.php';
require_once "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Customers extends db
{
    public $dbConn;
    public $loingtable = "authentication";
    // public $bTable = "bags_collection";
    public $cTable = 'enquiry_request';
    public $cat_tbl = 'category_tbl';
    public $pro_tbl = 'product_tbl';
    public $listing_tbl = 'listing_tbl';
    public $formStru_tbl = 'quotation_info_tbl';
    public $contact_tbl = "contact_tbl";
    public $errmsg = '';
    private $uploadDir;
    public function __construct()
    {
        $connect = new DB();
        $this->dbConn = $connect->db_connection();
        $this->uploadDir = "ordersFilesandimages/";
    }
    public function getMydirectory()
    {
        return $this->uploadDir;
    }
    public function insert($tbl, $data)
    {

        $sql = "INSERT INTO " . $tbl . " (";
        $sql .= implode(",", array_keys($data)) . ') VALUES (';
        $sql .= "'" . implode("','", array_values($data)) . "')";
        //echo $sql;
        $runSql = $this->dbConn->query($sql);
        if ($runSql) {
            //echo "Your Data uploaded Succesfully";
            return true;
        } else {
            //echo 'error on db';
            return false;
        }
    }

    // public function update($data, $id)
    // {
    //     $query = '';
    //     $condition = '';
    //     foreach ($data as $key => $value) {
    //         $query .= $key . "='" . $value . "', ";
    //     }
    //     $query = substr($query, 0, -2);

    //     foreach ($id as $key => $value) {
    //         $condition .= $key . "='" . $value . "' AND ";
    //     }
    //     $condition = substr($condition, 0, -5);

    //     $query = "UPDATE " . $this->bTable . " SET " . $query . " WHERE " . $condition . "";
    //     $runSql = $this->dbConn->query($query);
    //     if ($runSql) {
    //         return true;
    //     } else {
    //         echo "somthing went to wrong";
    //     }
    // }


    public function login($email, $pass)
    {
        if ($email != '' && $pass != '') {
            $sql = "SELECT * FROM " . $this->loingtable . " WHERE email_id = '$email' and password = '$pass'";
            $runSql = $this->dbConn->query($sql);
            if ($runSql->num_rows > 0) {
                $creationals = $runSql->fetch_assoc();
                $_SESSION['login'] = true;
                $_SESSION['id'] = $creationals['id'];
                $_SESSION['name'] = $creationals['username'];
                header('Location:adminpanel/dashboard');
                return true;
            } else {
                $_SESSION['status'] = "Invaild Email or Password";
                //echo "<script type='text/javascript'>alert('Invaild Login Credentials')</script>";
                return false;
            }
        }
    }

    // public function email($name, $mail_id, $phno, $msg)
    // {
    //     $mailer = new PHPMailer(true);
    
    //     try {
    //         // Server settings
    //         $mailer->isSMTP();
    //         $mailer->Host       = 'smtp.gmail.com';
    //         $mailer->SMTPAuth   = true;
    //         $mailer->Username   = 'sivaathriaahasolutions@gmail.com';
    //         $mailer->Password   = 'yrkt ghwt jaie eman'; // Use an app password, not your regular password
    //         $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //         $mailer->Port       = 587;
    
    //         // Recipients
    //         $mailer->setFrom('sivaathriaahasolutions@gmail.com', 'Your Name');
    //         $mailer->addAddress($mail_id);
    
    //         // Content
    //         $mailer->isHTML(true);
    //         $mailer->Subject = 'New Contact Form Submission';
    //         $mailer->Body    = "Name: $name<br>Email: $mail_id<br>Phone: $phno<br>Message: $msg";
    //         $mailer->AltBody = "Name: $name\nEmail: $mail_id\nPhone: $phno\nMessage: $msg";
    
    //         // Send email
    //         $mailer->send();
    //         return true;
    //     } catch (Exception $e) {
    //         return "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    //     }
    // }

    public function email($name, $mail_id, $phno, $msg)
    {

        $mailer = new PHPMailer(true);
        $usertmpt = file_get_contents('useremailtmpt.phtml');
        $usertmpt = str_replace('%username%', $name, $usertmpt);
        $usertmpt = str_replace('%usermail%', $mail_id, $usertmpt);

        $admintmpt = file_get_contents('adminemailtmpt.phtml');
        $admintmpt = str_replace('%username%', $name, $admintmpt);
        $admintmpt = str_replace('%usermail%', $mail_id, $admintmpt);
        $admintmpt = str_replace('%userphno%', $phno, $admintmpt);
        $admintmpt = str_replace('%message%', $msg, $admintmpt);
        $adminMailId = $this->getAppContactInfo();
        try {
            //Server settings
    //         // Server settings
            $mailer->isSMTP();
            $mailer->Host       = 'smtp.gmail.com';
            $mailer->SMTPAuth   = true;
            $mailer->Username   = 'sivaathriaahasolutions@gmail.com';
            $mailer->Password   = 'yrkt ghwt jaie eman'; // Use an app password, not your regular password
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port       = 587;

            //Recipients
            $mailer->setFrom('sivaathriaahasolutions@gmail.com', 'admin');
            $mailer->addAddress($adminMailId['contact_mail'], 'Admin');     //Add a recipient
            //$mailer->addReplyTo('your_email@gmail.com', 'admin');
            
            //Attachments (optional)
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachmentshttp://localhost/DJ-BAGS/forgotpassword.php
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
            //Content
            $mailer->isHTML(true);                                  //Set email format to HTML
            $mailer->Subject = 'Contact Request From Customers';
            $mailer->Body = $admintmpt;
            $mailer->AltBody = 'Plain text message of the email';
            if ($mailer->send()) {
                $mailer->clearAddresses();
                $mailer->addAddress($mail_id, $name);
                $mailer->isHTML(true);                                  //Set email format to HTML
                $mailer->Subject = 'Thank you for contacting us !!!';
                $mailer->Body = $usertmpt;
                $mailer->AltBody = 'Plain text message of the email';

                //This should be the same as the domain of your From address
                $mailer->DKIM_domain = 'starlingbagsni.co.uk';
                //See the DKIM_gen_keys.phps script for making a key pair -
                //here we assume you've already done that.
                //Path to your private key:
                $mailer->DKIM_private = 'dkim_private.pem';
                //Set this to your own selector
                $mailer->DKIM_selector = 'default';
                //Put your private key's passphrase in here if it has one
                $mailer->DKIM_passphrase = '';
                //The identity you're signing as - usually your From address
                $mailer->DKIM_identity = $mailer->From;
                //Suppress listing signed header fields in signature, defaults to true for debugging purpose
                $mailer->DKIM_copyHeaderFields = false;

                $mailer->send();
                //echo 'mail2 sened';
                return true;
            } else {
                echo 'mail2 not send';
            }
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
        }
    }

    public function getProductCategories($id = null)
    {
        if ($id == null) {

            $sql = "SELECT * FROM  $this->cat_tbl WHERE deleted_at IS NULL";
            //echo $sql;
            $runSql = $this->dbConn->query($sql);
            if ($runSql->num_rows > 0) {

                $category_data = $runSql->fetch_all(MYSQLI_ASSOC);
                return $category_data;
            }
        } else {
            $sql = "SELECT * FROM  $this->cat_tbl WHERE id = '$id' AND deleted_at IS NULL";
            //echo $sql;
            $runSql = $this->dbConn->query($sql);
            if ($runSql->num_rows > 0) {

                $category_data = $runSql->fetch_all(MYSQLI_ASSOC);
                return $category_data;
            } else {
                return false;
            }
        }
    }
    public function getProductDetails($id = null)
    {
        if ($id == null) {

            $sql = "SELECT pro_id,product_name,product_category,product_listing,product_image FROM  $this->pro_tbl  WHERE deleted_at IS NULL";
            //echo $sql;
            $runSql = $this->dbConn->query($sql);
            if ($runSql->num_rows > 0) {

                $product_data = $runSql->fetch_all(MYSQLI_ASSOC);
                return $product_data;
            }
        } else {
            $sql = "SELECT * FROM " . $this->pro_tbl . " WHERE pro_id = '$id' AND  deleted_at IS NULL ";
            //echo $sql;
            $runSql = $this->dbConn->query($sql);
            if ($runSql->num_rows > 0) {

                $product_data = $runSql->fetch_assoc();

                return $product_data;
            }
        }
    }
    public function getproductByName($proname)
    {
        $sql = "SELECT pro_id,product_name,product_category,product_listing,product_image FROM " . $this->pro_tbl . " WHERE product_category = '$proname' AND  deleted_at IS NULL ";
        //echo $sql;
        $runSql = $this->dbConn->query($sql);
        if ($runSql->num_rows > 0) {

            $product_data = $runSql->fetch_all(MYSQLI_ASSOC);
            return $product_data;
        } else {
            return false;
            //echo 'No category found';
        }
    }

    public function getListing()
    {
        //$sql = "SELECT * FROM " . $this->listing_tbl . " WHERE id = '$id' AND deleted_at IS NULL ";
        // $query = "SELECT product_listings.id, product_listings.name AS listing_name, products.name AS product_name, products.price FROM product_listings JOIN products ON product_listings.id = products.listing_id";
        $sql = "SELECT product_tbl.pro_id,product_tbl.product_image, product_tbl.product_name,product_listing,name_of_list,id
        FROM " . $this->pro_tbl . "
        INNER JOIN " . $this->listing_tbl . "
        ON " . $this->pro_tbl . ".product_listing = " . $this->listing_tbl . ".id        
        WHERE " . $this->pro_tbl . ".deleted_at IS NULL";
        // echo $sql;
        if (!$this->dbConn->query($sql)) {
            echo 'Server down !!!';
        } else {
            $runSql = $this->dbConn->query($sql);
            if ($runSql->num_rows > 0) {

                $listings = array();
                //$product_data = $runSql->fetch_all(MYSQLI_ASSOC);
                //return $product_data;
                while ($row = $runSql->fetch_all(MYSQLI_ASSOC)) {
                    // print_r($row);
                    foreach ($row as $data) {

                        $listing_id = $data['id'];
                        $listing_name = $data['name_of_list'];
                        $product_id = $data['pro_id'];
                        $product_name = $data['product_name'];
                        $product_image = $data['product_image'];

                        if (!array_key_exists($listing_id, $listings)) {
                            // Add the listing to the array if it doesn't exist yet
                            $listings[$listing_id] = array(
                                'listing_name' => $listing_name,
                                'products' => array()
                            );
                        }

                        // Add the product to the listing's products array
                        $listings[$listing_id]['products'][] = array(
                            'id' => $product_id,
                            'name' => $product_name,
                            'image' => $product_image
                        );
                    }
                }
                //print_r($listings);
                return $listings;
            } else {
                return false;
                //echo 'No category found';
            }
        }
        // database connection code here

    }

    public function searchableResult($search)
    {
        if (!empty($search)) {
            $query = "SELECT p.pro_id ,p.product_name,p.product_image, c.name_of_category
                        FROM product_tbl p
                        JOIN category_tbl c ON p.product_category = c.id 
                        WHERE p.product_name LIKE '%$search%' OR c.name_of_category LIKE '%$search%'";

            // $sql =  " SELECT * FROM "  . $this->pro_tbl . " WHERE product_name LIKE '%$search%' 
            //             OR product_category LIKE '%$search%' AND deleted_at IS NULL ";
            //echo $query;
            if (!$this->dbConn->query($query)) {
                echo 'Server down !!!';
            } else {
                $runSql = $this->dbConn->query($query);
                if ($runSql->num_rows > 0) {

                    $product_data = $runSql->fetch_all(MYSQLI_ASSOC);
                    return $product_data;
                } else {
                    return false;
                    //echo 'No category found';
                }
            }
        }
    }
    public function addQuoteForm($data)
    {
        // print_r($data);
        // die();
        $sql = "INSERT INTO " . $this->formStru_tbl . " (";
        $sql .= implode(",", array_keys($data)) . ') VALUES (';
        $sql .= "'" . implode("','", array_values($data)) . "')";
        // print_r($sql);
        // die();
        if (!$this->dbConn->query($sql)) {
            //echo "Errors on database";
            return false;
        } else {
            $lastInsertedID = $this->dbConn->insert_id;
            //MANO/ Add Dummy address as Customer address
            if (!isset($data['cust_address']) ){
                $data['cust_address'] = "NA";
            }
            
            $this->emailForQuote($data['cust_name'], $data['cust_email'], $data['cust_phno'], $data['cust_address']);
            // echo $lastInsertedID;
            // die();
            function generateOrderID($id)
            {
                $prefix = 'ORD';
                $date = date('ymd');
                $uniqueIdentifier = $id; // You need to implement your own logic to generate a unique identifier

                $orderID = $prefix . '-' . $date . '-' . $uniqueIdentifier;

                return $orderID;
            }

            $orderID = generateOrderID($lastInsertedID);
            $sql = "UPDATE `quotation_info_tbl` SET order_id = '$orderID' WHERE id = '$lastInsertedID'";
            $this->dbConn->query($sql);
            if (!$this->dbConn->query($sql)) {

                return false;
            } else {
                // print_r($this->dbConn->query($sql));
                return true;
            }
            // echo $orderID;
            // return $emailResult;
            // echo 'Your Data uploaded Succesfully';
            return true;
        }
    }

    public function emailForQuote($name, $mail_id, $phno, $address)
    {

        $mailer = new PHPMailer(true);
        $usertmpt = file_get_contents('quote_mail_tmpt.phtml');
        $usertmpt = str_replace('%username%', $name, $usertmpt);
        $usertmpt = str_replace('%usermail%', $mail_id, $usertmpt);
        $usertmpt = str_replace('%userphno%', $phno, $usertmpt);
        $usertmpt = str_replace('%useraddress%', $address, $usertmpt);
        $adminmailId = $this->getAppContactInfo();
        try {
            //Server settings
            $mailer->SMTPDebug = 0;                                    //Enable verbose debug output
            $mailer->isMail();                                         //Send using SMTP
            $mailer->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
            $mailer->SMTPAuth   = true;                                //Enable SMTP authentication
            $mailer->Username   = 'sivaathriaahasolutions@gmail.com';  //SMTP username
            $mailer->Password   = 'yrkt ghwt jaie eman';                
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //SMTP password
            //$mailer->SMTPSecure = 'tls';                               //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mailer->Port       = 587;                                 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mailer->setFrom('info@starlingbagsni.co.uk', 'admin');
            $mailer->addAddress($adminmailId['contact_mail'], 'Admin');     //Add a recipient
            //$mailer->addReplyTo('your_email@gmail.com', 'admin');

            //Attachments (optional)
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachmentshttp://localhost/DJ-BAGS/forgotpassword.php
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mailer->isHTML(true);                                  //Set email format to HTML
            $mailer->Subject = 'New Quotation Request for Bags - Action Required';
            $mailer->Body = $usertmpt;
            $mailer->AltBody = 'Plain text message of the email';

              //This should be the same as the domain of your From address
              $mailer->DKIM_domain = 'starlingbagsni.co.uk';
              //See the DKIM_gen_keys.phps script for making a key pair -
              //here we assume you've already done that.
              //Path to your private key:
              $mailer->DKIM_private = 'dkim_private.pem';
              //Set this to your own selector
              $mailer->DKIM_selector = 'default';
              //Put your private key's passphrase in here if it has one
              $mailer->DKIM_passphrase = '';
              //The identity you're signing as - usually your From address
              $mailer->DKIM_identity = $mailer->From;
              //Suppress listing signed header fields in signature, defaults to true for debugging purpose
              $mailer->DKIM_copyHeaderFields = false;


            if ($mailer->send()) {
                //echo 'mail was send';
                return true;
            } else {
                echo 'mail not send';
                return false;
            }
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
        }
    }

public function getAppContactInfo()
    {
        $sql = "SELECT * FROM " . $this->contact_tbl;
        $query = $this->dbConn->query($sql);
        if (!$query) {
            echo "server down";
        } else {
            if ($query->num_rows > 0) {
                $result = $query->fetch_assoc();
                return $result;
            }
        }
    }


}
