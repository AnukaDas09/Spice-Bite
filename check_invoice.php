<!DOCTYPE html>
<html>

<head>
    <title>Update Delivery Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    include('../functions/connect.php');
    include('../functions/common_function.php');
    session_start();

    if (!isset($_SESSION['delivery_email'])) {
        header('location: signin.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $invoice_number = $_POST['invoice_number'];

        // Prepare and execute a query to fetch the order details based on the invoice number
        $query = "SELECT * FROM user_order WHERE invoice_number = '$invoice_number'";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $delivery_status = $row['delivery_status'];

            if ($delivery_status == "Order Received") {
                // Send the invoice number to page1.php.
                echo "<script>alert('Order Found!')</script>";
                echo "<script>window.location.href = 'page1.php?invoice_number=$invoice_number';</script>";
                exit;            
            } else {
                echo "<p class='error-message'>Error: Order Already Accepted.</p>";
            }
        } else {
            echo "<p class='error-message'>Error: Invalid invoice number.</p>";
        }

        $con->close();
    }
    ?>
</body>

</html>