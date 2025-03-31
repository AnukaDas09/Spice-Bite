<?php
$user_email = $_SESSION['user_email'];
$get_user = "SELECT * FROM `user` WHERE user_email='$user_email'";
$result = mysqli_query($con, $get_user);
$row_fetch = mysqli_fetch_assoc($result);
$user_id = $row_fetch['id'];
?>

<table class="table table-bordered mt-5">
    <thead class="bg-danger text-light">
        <tr>
            <th>sl.no</th>
            <th>Amount</th>
            <th>Total Products</th>
            <th>View Details</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Payment Status</th>
            <th>Delivery Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get_order_details = "SELECT * FROM `user_order` WHERE user_id=$user_id ORDER BY order_id DESC";
        $result_orders = mysqli_query($con, $get_order_details);
        $total_rows = mysqli_num_rows($result_orders);
        $serial_number = $total_rows;
        while ($row_orders = mysqli_fetch_assoc($result_orders)) {
            $order_id = $row_orders['order_id'];
            $amount_due = $row_orders['amount_due'];
            $total_products = $row_orders['total_products'];
            $invoice_number = $row_orders['invoice_number'];
            $order_status = $row_orders['order_status'];
            $order_date = $row_orders['order_date'];
            $del_status = $row_orders['delivery_status'];
            if ($order_status == 'pending') {
                $order_status = 'Incomplete';
            } else {
                $order_status = 'Complete';
            }
            echo "<tr>
                    <td>$serial_number</td>
                    <td>$amount_due</td>
                    <td>$total_products</td>
                    <td><a href='order_details.php?order_id=$order_id'>Click Here</a></td>
                    <td>$invoice_number</td>
                    <td>$order_date</td>";
            if ($order_status == 'Complete') {
                echo "<td>Paid</td>
                        <td>$del_status</td>";
            } else {
                echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
                        <td>$del_status</td>
                    </tr>";
            }
            $serial_number--;
        }
        ?>
    </tbody>
</table>
