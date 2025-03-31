<?php
include('../functions/connect.php');
include('../functions/common_function.php');
session_start();
if (!isset($_SESSION['user_email'])) {
    header('location:../user/signin.php');
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$get_email = getEmail();
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE email='$get_email'";
$result_cart_price = mysqli_query($con, $cart_query_price);
$invoice_number = mt_rand();
$status = 'pending';
$count_foods = mysqli_num_rows($result_cart_price);

$food_names = array();
$food_quantities = array();

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $food_id = $row_price['food_id'];
    $select_food = "SELECT * FROM `food` WHERE food_id='$food_id'";
    $run_price = mysqli_query($con, $select_food);

    while ($row_food_price = mysqli_fetch_array($run_price)) {
        $food_price = array($row_food_price['food_price']);
        $food_value = array_sum($food_price);
        $total_price += $food_value;

        // Get the quantity and add it to the quantities array
        $quantity = $row_price['quantity'];
        $food_quantities[] = $quantity;

        $food_name = $row_food_price['food_title'];
        $food_names[] = $food_name;
    }
}

$get_cart = "SELECT * FROM `cart_details` WHERE email='$get_email'";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];

// Calculate the subtotal after fetching the quantity
if ($quantity == 0) {
    $quantity = 1;
}

$subtotal = final_cart_price();

// Convert the quantities and names arrays to comma-separated strings
$food_quantities_string = implode(", ", $food_quantities);
$food_names_string = implode(", ", $food_names);

$insert_orders = "INSERT INTO `user_order` (user_id, amount_due, invoice_number, total_products, food_names, food_quantities, order_date, order_status, delivery_status) 
VALUES ('$user_id', '$subtotal', '$invoice_number', '$count_foods', '$food_names_string', '$food_quantities_string', NOW(), '$status', 'Order Received')";

$result_query = mysqli_query($con, $insert_orders);
if ($result_query) {
    echo "<script>alert('Order(s) successful!')</script>";
    echo "<script>window.open('user_profile.php','_self')</script>";
}

//pending orders
$insert_pending_orders = "Insert into `orders_pending` (user_id,invoice_number,food_id,quantity,order_status) 
values($user_id,$invoice_number,$food_id,$quantity,'$status')";
$result_pending_orders = mysqli_query($con, $insert_pending_orders);

$empty_cart = "DELETE FROM `cart_details` WHERE email='$get_email'";
$result_delete = mysqli_query($con, $empty_cart);
?>
