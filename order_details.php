<!DOCTYPE html>
<html>
<head>
  <title>Delivery Bill</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #e74c3c;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #f9f9f9;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
      color: #333;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:nth-child(odd) {
      background-color: #fff;
    }

    .total {
      font-weight: bold;
      color: #e74c3c;
    }

    .download-btn {
      display: block;
      width: 150px;
      padding: 10px;
      text-align: center;
      background-color: #f1c40f;
      color: #fff;
      text-decoration: none;
      margin: 20px auto;
      transition: background-color 0.3s;
    }

    .download-btn:hover {
      background-color: #e74c3c;
    }
  </style>
</head>
<body>
  <h1>Spice & Bite</h1>
  
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

    // Display the order details in a table or any other desired format
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

        // Display the order details and food items in a table
        echo "<table>
                <tr>
                  <th>Order ID</th>
                  <td>$order_id</td>
                </tr>
                <tr>
                  <th>Amount Due</th>
                  <td>$amount_due</td>
                </tr>
                <tr>
                  <th>Total Products</th>
                  <td>$total_products</td>
                </tr>
                <tr>
                  <th>Invoice Number</th>
                  <td>$invoice_number</td>
                </tr>
                <tr>
                  <th>Order Date</th>
                  <td>$order_date</td>
                </tr>
                <tr>
                  <th>Payment Status</th>
                  <td>$order_status</td>
                </tr>
                <tr>
                  <th>Delivery Status</th>
                  <td>$delivery_status</td>
                </tr>
                <tr>
                  <th>Food Items</th>
                  <td>";

        // Display the food items and quantities in a table
        echo "<table>
                <tr>
                  <th>Food Name</th>
                  <th>Quantity</th>
                </tr>";
        foreach ($food_names_array as $index => $food_name) {
            $quantity = $food_quantity_array[$index];

            echo "<tr>
                    <td>$food_name</td>
                    <td>$quantity</td>
                  </tr>";
        }
        echo "</table>";

        echo "</td>
              </tr>
            </table>";
    } else {
        echo "Invalid order ID.";
    }
  } else {
    echo "Order ID not specified.";
  }
  ?>

<a href="download.php?order_id=<?php echo $order_id; ?>" class="download-btn">Download Bill</a>
</body>
</html>
