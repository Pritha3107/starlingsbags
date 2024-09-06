<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
// $results =  $classobj->getEnquiryTable();
$productData = $classobj->showAllProducts();
$productsRating = $classobj->productsRating();
$enquiryData = $classobj->getEnquiryTable();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enquiryId = $_POST['id'];

    // Perform deletion operation
    $result = $classobj->deleteEnquiryById($enquiryId);

    
    if ($result) {
        $data = array(
            'status' => 'success'
            
        );
        
        // Return the data as a JSON string
        echo json_encode($data);
       
    } else {
        echo 'failure';
    }
}
?>
