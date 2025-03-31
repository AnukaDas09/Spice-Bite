<!DOCTYPE html>
<html>

<head>
    <title>Out for delivery</title>
    <style>
        body {
            background-color: yellow;
            font-family: Arial, sans-serif;
        }

        .box {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: red;
        }

        form {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        input[type="submit"] {
            background-color: yellow;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: red;
            color: white;
        }

        table {
            margin-top: 20px;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>Click on Submit, If you have delivered the order.</h2>

        <?php
        include('../functions/connect.php');
        include('../functions/common_function.php');
        session_start();

        if (!isset($_SESSION['delivery_email'])) {
            header('location: signin.php');
            exit;
        }

        if (isset($_GET['invoice_number'])) {
            $invoice_number = $_GET['invoice_number'];
        }

        $order = "SELECT order_id FROM `user_order` WHERE invoice_number = '$invoice_number'";
        $result_order_id = mysqli_query($con, $order);

        if ($result_order_id) {
            $row_order_id = mysqli_fetch_assoc($result_order_id);
            $order_id = $row_order_id['order_id'];
        }

        $user = "SELECT user_id, amount_due, order_status FROM `user_order` WHERE invoice_number = '$invoice_number'";
        $result_user = mysqli_query($con, $user);

        if ($result_user) {
            $row_user = mysqli_fetch_assoc($result_user);
            $user_id = $row_user['user_id'];
            $amount_due = $row_user['amount_due'];
            $payment_status = $row_user['order_status'];

            $sql = "SELECT name, address, user_mobile FROM user WHERE id = $user_id";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Amount</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    $address = $row['address'];
                    $user_mobile = $row['user_mobile'];

                    echo "<tr>
                            <td>$name</td>
                            <td>$address</td>
                            <td>$user_mobile</td>
                            <td>$amount_due</td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "No user found with the given user ID.";
            }
        } else {
            echo "Error fetching user ID: " . mysqli_error($con);
        }
        ?>

        <h3>Payment Status: <?php
                            if ($payment_status === 'pending') {
                                echo "Not done";
                            } else {
                                echo "Done";
                            }
                            ?></h3>

        <form method="post" action="">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    // Rest of the code...

    if ($payment_status === 'pending') {
        $update_payment_status = "UPDATE `user_order` SET order_status = 'Complete' WHERE invoice_number = '$invoice_number'";
        $update_payment_status = mysqli_query($con, $update_payment_status);

        $payment_mode = "Cash On Delivery";

        $insert_payment = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode, date) 
                VALUES ('$order_id', '$invoice_number', '$amount_due', '$payment_mode', NOW())";
        $insert_result = mysqli_query($con, $insert_payment);
    }

    $update_del_status = "UPDATE user_order SET delivery_status = 'Order Delivered' WHERE invoice_number = '$invoice_number'";
    $update_update_del_status = mysqli_query($con, $update_del_status);
    if ($update_update_del_status) {
        echo "<script>alert('Update Successful!'); window.location.href = 'index.php?invoice_number=$invoice_number';</script>";
        exit;
    }
}
?>