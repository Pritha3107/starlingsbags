<?php
include_once "admin_crud.php";
$classobj = new Admincrud();
$results =  $classobj->getOrdersDetailsCount();
$productData = $classobj->showAllProducts();
$productsRating = $classobj->productsRating();
$enquiryData = $classobj->getEnquiryTable();

/* Update all the UNREAD enquiry messages into READ */
$classobj->updateUnreadEnquiryRequests();

// echo '<pre>';
// print_r($enquiryData);
// print_r(count($productData->fetch_all()));
// echo '<pre>';
// print_r($productsRating);
// die();
if (!$results) {
    $orderscount = 0;
} else {
    $orderscount =  count($results);
}
if (!$productData) {
    $productcount = 0;
} else {
    $productcount =  count($productData->fetch_all());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <title>Dashboard</title>
    <style>
        #toast-container>.toast-success {
            background-color: #00bb9f;
            color: #000;
        }
        .swal2-modal {
        background-color: #04564c !important;
        color: #fff !important;

    }

    .form-group {
        width: 100%;
        max-width: 200px;
        position: relative;
        padding-bottom: 30px;
        margin-right:20px;
        /* margin: 0 0 0 200px !important; */
        /* margin-bottom: 45px; */
    }

    input {
        /* display: block; */
        width: 100%;
        /* max-width: 300px; */
        font-size: 14pt;
        /* padding: 10px; */
        border: none;
        border-bottom: 1px solid #ccc;
        /* margin: 0 0 0 170px !important; */
        background-color: transparent; 

    }

    input:focus {
        outline: none;
    }

    label {
        position: absolute;
        top: -2px;
        /* left: 5px; */
        color: #283638;
        font-size: 12pt;
        font-weight: normal;
        pointer-events: none;
        transition: all 0.2s ease;
        /* margin: 0 0 0 170px !important; */
    }

    input:focus~label,
    input:valid~label {
        top: -15px;
        font-size: 10pt;
        color: #283638;
    }

    .bar {
        display: block;
        position: relative;
        width: 100%;
        /* margin: 0 0 0 150px !important; */

    }

    .bar:before,
    .bar:after {
        content: "";
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #283638;
        transition: all 0.2s ease;

    }

    .bar:before {
        left: 50%;
    }

    .bar:after {
        right: 50%;
    }

    input:focus~.bar:before,
    input:focus~.bar:after,
    input:valid~.bar:before,
    input:valid~.bar:after {
        width: 50%;
    }


    .form-group .searchBtn {
        position: absolute;
        top: -10px;
        right: 0;
        height: 100%;
        display: none;
    }

    input:focus~.searchBtn,
    input:valid~.searchBtn {
        display: block;

    }
    .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #00bb9f;
            color: white;
            padding: 15px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }
        .view-btn i {
            color: #007bff !important; /* Vibrant blue color for view icon */
            font-size: 18px; /* Adjust size as needed */
            transition: color 0.3s ease; /* Smooth color transition */
        }

        .view-btn i:hover {
            color: #0056b3 !important; /* Darker blue color on hover */
        }

        .delete-btn i {
            color: #dc3545 !important; /* Vibrant red color for delete icon */
            font-size: 18px; /* Adjust size as needed */
            transition: color 0.3s ease; /* Smooth color transition */
        }

        .delete-btn i:hover {
            color: #c82333 !important; /* Darker red color on hover */
        }

    /* .dataTables_wrapper .dataTables_filter {
        float: left;
        text-align: left;
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_filter input {
        width: 300px;
        padding: 7px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        border-color: #000;
        background-color: #f7f7f7;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        font-size: 14px;
    } */
    </style>

</head>

<body>
    <?php include("header.php") ?>
    <div class="body">
        <?php
        if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
            echo "<script type='text/javascript'>toastr.success('Welcome " . $_SESSION['name'] . "')</script>";
            unset($_SESSION['name']);
        }

        ?>
       <h2 style="color:#283638" class="pb-3">Inbox</h2>
        <hr>
        <div class="shop-top-btns d-flex justify-content-end align-items-center flex-wrap">
            <div class="form-group mt-2">
                <input type="text" name="name" id="searchproduct" class="pb-1" required />
                <!-- <i class="fa fa-search" aria-hidden="false"></i> -->
                <span class="highlight"></span>
                <span class="bar"></span>
                <label for="name">Search Product</label>
                <button type="button" class="searchBtn btn shadow-none"><i class="fa-solid fa-magnifying-glass"></i></button>

            </div>

        </div>
       
        <div class="dashboard-section d-flex">

            <div class="dashboard-left-section" style="width:99%">

            <!--<div id="messageNotification" class="notification"></div>-->

                <div class="order-list table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                
                    <table id="productTable" class="table table-lg table-hover   text-center">
                        <thead>
                            <tr>
                                <th>Enquiry ID</th>
                                <th> Customer Name </th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $enquiry_id = '';
                            if (!$enquiryData) {
                                echo '<tr><td colspan="4">There is no orders Placed</tr></td>';
                            } else {
                                $i = 1;
                                foreach ($enquiryData as $row) {
                                    $enquiryId = isset($row["id"]) ? $row["id"] : '';
                                    echo '<tr id="row-'.$enquiryId .'">
                                    <td style="min-width:150px;"><a href="order_details?orderid=' . $i. '" class="link-dark">' . $i . '</a></td>
                                    <td style="max-width:200px; min-width:100px; word-wrap: break-word;">' . $row["ctc_person_name"] . '</td>
                                    <td>' . $row["ctc_person_email"] . '</td>
                                    <td>' . $row["ctc_person_phno"] . '</td>
                                    <td>' . $row["ctc_person_msg"] . '</td>
                                                                     <td>
                                                                                <!-- View Icon -->
                                        <a href="view_enquiry.php?id=' . htmlspecialchars($enquiryId) . '" title="View" class="text-info view-btn">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- Delete Icon -->
                                        <a href="#" title="Delete" class="text-danger delete-btn" data-id="' . htmlspecialchars($enquiryId) . '">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
 

                                </tr>';
                                $i = $i + 1;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- View Enquiry Modal -->
    <div id="viewEnquiryModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enquiry Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Customer Name:</strong> <span id="modalCustomerName"></span></p>
                    <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                    <p><strong>Phone No:</strong> <span id="modalPhoneNo"></span></p>
                    <p><strong>Message:</strong> <span id="modalMessage"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#viewEnquiryModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var enquiryId = button.data('id'); // Extract info from data-* attributes
            
            // Make AJAX request to fetch enquiry details
            $.ajax({
                url: 'view_enquiry.php',
                type: 'GET',
                data: { id: enquiryId },
                dataType: 'json',
                success: function(data) {
                    // Populate modal with data
                    $('#modalCustomerName').text(data.ctc_person_name);
                    $('#modalEmail').text(data.ctc_person_email);
                    $('#modalPhoneNo').text(data.ctc_person_phno);
                    $('#modalMessage').text(data.ctc_person_msg);
                },
                error: function() {
                    toastr.error('Failed to load enquiry details');
                }
            });
        });

        // Check for new messages every 30 seconds
        setInterval(checkNewMessages, 30000);
        
        function checkNewMessages() {
            $.ajax({
                url: 'check_new_messages.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.newMessages > 0) {
                        showNotification("You have " + response.newMessages + " new message(s)!");
                    }
                }
            });
        }
        
        function showNotification(message) {
            $('#messageNotification').text(message).fadeIn();
            setTimeout(function() {
                $('#messageNotification').fadeOut();
            }, 5000);
        }
        
        $(".read-btn").click(function() {
            var enquiryId = $(this).data("id");
            var row = $(this).closest('tr');
            
            $.ajax({
                url: 'mark_as_read.php',
                type: 'POST',
                data: { id: enquiryId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        row.removeClass('unread');
                        toastr.success('Message marked as read');
                    } else {
                        toastr.error('Failed to mark message as read');
                    }
                }
            });
        });
    });
    </script>
</body>
<script>
$(document).ready(function(){
    $("#searchproduct").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#productTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
$(document).ready(function() {
    $("#productTable").on("click", ".delete-btn", function() {
        var enquiryId = $(this).data("id");
        var row = $(this).closest('tr');

        // Confirm before deleting
        if (confirm("Are you sure you want to delete this enquiry?")) {
            // Disable the button to prevent multiple clicks
            $(this).prop('disabled', true);

            // Send AJAX request to delete the entry
            $.ajax({
                url: 'delete_enquiry.php',
                type: 'POST',
                data: { id: enquiryId },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        row.fadeOut(400, function() {
                            $(this).remove();
                        });
                        toastr.success('Enquiry deleted successfully');
            // Delay the page reload by 2 seconds
            setTimeout(function() {
                window.location.reload();
            }, 2000); // 2000 milliseconds = 2 seconds
                    } else {
                        toastr.error('Failed to delete enquiry: ' + (response.message || 'Unknown error'));
                        // Re-enable the button on failure
                        row.find('.delete-btn').prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + " - " + error);
                    toastr.error('An error occurred while deleting the enquiry');
                    // Re-enable the button on error
                    row.find('.delete-btn').prop('disabled', false);
                }
            });
        }
    });
});


</script>

</html>