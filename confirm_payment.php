<?php //if login is successful then-only menu page will be accessible
include('../functions/connect.php');
include('../functions/common_function.php');
session_start();
if (!isset($_SESSION['user_email'])) {
    header('location:../user/signin.php');
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    //echo order id
    $select_data = "Select * from `user_order` where order_id=$order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}
if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "Insert into `user_payments` (order_id,invoice_number,amount,payment_mode)
    values($order_id,$invoice_number,$amount,'$payment_mode')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        echo "<script>alert('Payment Successful!')</script>";
        echo "<script>window.open('user_profile.php?my_orders','_self')</script>";
    }
    //updatin order status
    $update_orders = "Update `user_order` set order_status='Complete' where order_id=$order_id";
    $result = mysqli_query($con, $update_orders);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="bg-dark text-center text-light">
    <div class="container my-5">
        <h1>Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 w-50 m-auto">
                <label for="">Invoice Number</label>
                <input type="text" class="form-control w-50 m-auto" readonly name="invoice_number" value="<?php echo $invoice_number; ?>">
            </div>
            <div class="form-outline my-4 w-50 m-auto">
                <label for="">Amount</label>
                <input type="text" class="form-control w-50 m-auto" readonly name="amount" value="<?php echo $amount_due; ?>">
            </div>
            <div class="form-outline my-4 w-50 m-auto">
                <label for="">Select Payment Mode</label>
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>UPI</option>
                    <option>Net Banking</option>
                </select>
            </div>
            <div class="form-outline my-4 w-50 m-auto">
                <input type="submit" class=" px-3 py-1 rounded-2" value="confirm" name="confirm_payment">
            </div>
        </form>
    </div>

</body>

</html>