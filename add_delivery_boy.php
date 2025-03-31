<?php
include('../functions/connect.php');
if (isset($_POST['insert_delivery_boy'])) {
    $delivery_boy_email = $_POST['delivery_boy_email'];
    $delivery_boy_password = $_POST['delivery_boy_password'];

    $select_query = "SELECT * FROM `delivery` WHERE delivery_email = '$delivery_boy_email'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('Delivery boy email already exists!')</script>";
    } else {
        $insert_query = "INSERT INTO `delivery` (delivery_email, password) VALUES ('$delivery_boy_email', '$delivery_boy_password')";
        $result = mysqli_query($con, $insert_query);

        if ($result) {
            echo "<script>alert('Delivery boy has been added successfully!')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h3 class="text-center">Add Delivery Boy</h3>
    <form action="" method="post" class="mb-2">
        <div class="input-group w-90 mb-2">
            <span class="input-group-text bg-warning" id="basic-addon1">
                <i class="fa-solid fa-envelope"></i>
            </span>
            <input type="email" class="form-control" name="delivery_boy_email" placeholder="Delivery Boy Email" aria-label="Delivery Boy Email" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group w-90 mb-2">
            <span class="input-group-text bg-warning" id="basic-addon2">
                <i class="fa-solid fa-key"></i>
            </span>
            <input type="password" class="form-control" name="delivery_boy_password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2" required>
        </div>
        <div class="input-group w-10 mb-2">
            <input type="submit" class="bg-danger border-1 p-2 text-light" name="insert_delivery_boy" value="Add Delivery Boy">
        </div>
    </form>
</body>

</html>
