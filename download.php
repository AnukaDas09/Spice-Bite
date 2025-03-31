<?php
include('../functions/connect.php');
include('../functions/common_function.php');
session_start();
if (!isset($_SESSION['user_email'])) {
  header('location:../user/signin.php');
}

if (isset($_GET['order_id'])) {
  $order_id = $_GET['order_id'];

  // Retrieve order details from the database based on the order_id
  $get_order_details = "SELECT * FROM `user_order` WHERE order_id = '$order_id'";
  $result_order_details = mysqli_query($con, $get_order_details);
  $row_order_details = mysqli_fetch_assoc($result_order_details);

  // Generate the bill content
  if ($row_order_details) {
    $amount_due = $row_order_details['amount_due'];
    $total_products = $row_order_details['total_products'];
    $invoice_number = $row_order_details['invoice_number'];
    $order_date = $row_order_details['order_date'];
    $order_status = $row_order_details['order_status'];
    $delivery_status = $row_order_details['delivery_status'];
    $food_names = $row_order_details['food_names'];
    $food_quantity = $row_order_details['food_quantities'];

    // Explode the food names and quantities into arrays
    $food_names_array = explode(',', $food_names);
    $food_quantity_array = explode(',', $food_quantity);

    // Generate the bill content as a string
    $bill_content = "Order ID: $order_id\n";
    $bill_content .= "Amount Due: $amount_due\n";
    $bill_content .= "Total Products: $total_products\n";
    $bill_content .= "Invoice Number: $invoice_number\n";
    $bill_content .= "Order Date: $order_date\n";
    $bill_content .= "Payment Status: $order_status\n";
    $bill_content .= "Delivery Status: $delivery_status\n\n";
    $bill_content .= "Food Items:\n";
    for ($i = 0; $i < count($food_names_array); $i++) {
      $food_name = $food_names_array[$i];
      $quantity = $food_quantity_array[$i];
      $bill_content .= "- $food_name: $quantity\n";
    }

    // Set the headers for file download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="bill.txt"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($bill_content));

    // Output the bill content for download
    echo $bill_content;
  } else {
    echo "Invalid order ID.";
  }
} else {
  echo "Order ID not specified.";
}
?>
