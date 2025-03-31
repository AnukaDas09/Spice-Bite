<h3 class="text-center">All orders</h3>
<table class="table table-bordered mt-5 text-center">
    <thead>
        <?php
        $get_orders = "SELECT * FROM `user_order` ORDER BY order_id DESC";
        $result = mysqli_query($con, $get_orders);
        $row_count = mysqli_num_rows($result);
        echo "<tr>
            <th>Sl.No</th>
            <th>Amount</th>
            <th>Invoice Number</th>
            <th>No of Items</th>
            <th>View Details</th>
            <th>Order Date</th>
            <th>Payment Status</th>
            <th>Delivery Status</th>
        </tr>
    </thead>
    <tbody>";
        if ($row_count == 0) {
            echo "<h3>No Orders Yet</h3>";
        } else {
            $number = $row_count; // Starting with the highest number for reverse order.
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $user_id = $row_data['user_id'];
                $amount_due = $row_data['amount_due'];
                $invoice_number = $row_data['invoice_number'];
                $order_id=$row_data['order_id'];
                $total_products = $row_data['total_products'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $del_status = $row_data['delivery_status'];
                echo "<tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$invoice_number</td>
                <td>$total_products</td>
                <td><a href='../user/order_details.php?order_id=$order_id'>Click Here</a></td>
                <td>$order_date</td>
                <td>$order_status</td>
                <td>$del_status</td>
            </tr>";
                $number--;
            }
        }
        ?>
        </tbody>
</table>