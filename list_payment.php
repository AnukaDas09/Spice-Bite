<h3 class="text-center">All Payments</h3>
<table class="table table-bordered mt-5 text-center">
    <thead>
        <?php
        $get_payments = "SELECT * FROM `user_payments` ORDER BY payment_id DESC";
        $result = mysqli_query($con, $get_payments);
        $row_count = mysqli_num_rows($result);
        if ($row_count == 0) {
            echo "<h3>No Payments Yet</h3>";
        } else {
            echo "<tr>
            <th>Sl.No</th>
            <th>Invoice Number</th>
            <th>Amount</th>
            <th>Payment Mode</th>
            <th>Order Date</th>
            </tr>
            </thead>
            <tbody>";

            $number = $row_count; // Set initial serial number
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $payment_id = $row_data['payment_id'];
                $amount = $row_data['amount'];
                $invoice_number = $row_data['invoice_number'];
                $payment_mode = $row_data['payment_mode'];
                $date = $row_data['date'];
                
                echo "<tr>
                <td>$number</td>
                <td>$invoice_number</td>
                <td>$amount</td>
                <td>$payment_mode</td>
                <td>$date</td>
            </tr>";
            
                $number--; // Decrease the serial number
            }
        }
        ?>
    </tbody>
</table>
