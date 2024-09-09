<?php
include_once "admin_crud.php";
$classobj = new Admincrud();

// Retrieve the enquiry ID from the query parameter
$enquiryId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch enquiry data based on the ID
$enquiryData = $classobj->getEnquiryById($enquiryId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Enquiry</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .modal-content {
            border-radius: 0.5rem;
        }
        .modal-header {
            background-color: #007bff;
            color: #fff;
        }
        .modal-title {
            font-size: 1.25rem;
        }
        .modal-body {
            font-size: 1rem;
            line-height: 1.5;
        }
        .modal-footer {
            border-top: 1px solid #e9ecef;
        }
        .modal-body p {
            margin-bottom: 0.5rem;
        }
        .modal-body strong {
            color: #333;
        }
        .modal-body span {
            display: block;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Modal HTML -->
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
                    <p><strong>Customer Name:</strong> <span><?php echo htmlspecialchars($enquiryData['ctc_person_name']); ?></span></p>
                    <p><strong>Email:</strong> <span><?php echo htmlspecialchars($enquiryData['ctc_person_email']); ?></span></p>
                    <p><strong>Phone No:</strong> <span><?php echo htmlspecialchars($enquiryData['ctc_person_phno']); ?></span></p>
                    <p><strong>Message:</strong> <span><?php echo nl2br(htmlspecialchars($enquiryData['ctc_person_msg'])); ?></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to trigger the modal and handle redirection -->
    <script>
    $(document).ready(function() {
        // Store the referrer URL
        var referrer = document.referrer;

        // Show the modal
        $('#viewEnquiryModal').modal('show');

        // Handle the modal close event
        $('#viewEnquiryModal').on('hidden.bs.modal', function () {
            // Redirect to the referrer URL
            if (referrer) {
                window.location.href = referrer;
            } else {
                // Fallback redirect if referrer is not available
                window.location.href = 'dashboard.php'; // Adjust as needed
            }
        });
    });
    </script>
</body>
</html>
