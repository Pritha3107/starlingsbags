<?php
// Get the current date
$currentDate = date('Y-m-d');  // Format: YYYY-MM-DD

// Get the current time
$currentTime = date('H:i:s');  // Format: HH:MM:SS

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');  // Format: YYYY-MM-DD HH:MM:SS

// Print the values
echo "Current Date: $currentDate<br>";
echo "Current Time: $currentTime<br>";

echo "Current Date and Time: ORD-01-$currentDateTime<br>";
$timedata =  strtotime($currentDateTime);
$startOrderNumber = 100;

// Number of orders to generate
$orderID = '';

// Generate and print the order IDs
for ($i = 0; $i < $startOrderNumber; $i++) {

    $orderID = $i;

    // echo "Order ID: $orderID<br>";
}
// echo $orderID;
// $startOrderNumber++;
// $orderNumber = $startOrderNumber + $startOrderNumber;
// echo $orderNumber;

function password_generate($chars)
{
    $data = '1234567890';
    return substr(str_shuffle($data), 0, $chars);
}
$number =  password_generate(01);
$orderID = 'ORD-' . $number . '-' . $timedata;
echo $orderID;

// $oreder_id = "ORD-$number-$timedata";
// // echo $oreder_id;
// $lastOrderNumber = 1000;

// // Generate and print the order IDs
// for ($i = 0; $i < $numOrders; $i++) {
//     $orderNumber = $lastOrderNumber + $i + 1;
//     $orderID = 'ORD-' . $number;
//     echo "Order ID: $orderID<br>";
// }

// // Update the last generated order number (store in database or any other source)
// $lastOrderNumber += $numOrders;
// echo $lastOrderNumber;
