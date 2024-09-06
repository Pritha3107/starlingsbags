<?php
require_once 'curd-model.php';
require_once 'forgotpwd-model.php';
$classobj = new Customers();
$dbconn = $classobj->dbConn;
$cTable = 'enquiry_request';

$mailobject = new User($dbconn);
$msg = '';
if (isset($_POST["action"]) == 'insert') {
    //    echo "yessss";

    $name = $_POST['ctc_person_name'];
    $mail = $_POST['ctc_person_email'];
    $phno = $_POST['ctc_person_phno'];
    if (!empty(isset($_POST['ctc_person_msg']))) {
        $msg = $_POST['ctc_person_msg'];
    }
    $insertData = array(
        'ctc_person_name' => $classobj->dbConn->real_escape_string($_POST['ctc_person_name']),
        'ctc_person_email' => $classobj->dbConn->real_escape_string($_POST['ctc_person_email']),
        'ctc_person_phno' => $classobj->dbConn->real_escape_string($_POST['ctc_person_phno']),
        'ctc_person_msg' => $classobj->dbConn->real_escape_string($_POST['ctc_person_msg'])
    );
    //print_r($insertData);
    //die();
    if ($name != '' && $mail != '' && $phno != '') {
        //echo 'data found';
        $response = $classobj->insert($cTable, $insertData);
        $classobj->email($name, $mail, $phno, $msg);
        //print_r($mail);
        echo $response;
        //return true;
    } else {
        //echo 'no data found';
        return false;
    }
}

if (isset($_GET['request']) == 'send mail') {
    // echo 'forgot password';
    //print_r($_GET['email']);
    $send = $mailobject->forgotPassword($_GET['email']);
    print_r($send);
}
