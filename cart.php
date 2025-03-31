<?php
include('../functions/connect.php');
include('../functions/common_function.php');
session_start();
if (!isset($_SESSION['user_email'])) {
    header('location:../user/signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file link -->
    <link rel="stylesheet" href="home.css" type="text/css">
    <title>Cart Details</title>
    <style>
        .cart_img {
            width: 120px;
            height: 90px;
            object-fit: contain;
        }

        body,
        html {
            height: 100%;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <!-- Nav bar -->
    <?php
    include("../header/navbar.php");
    ?>

    <!-- calling cart function -->
    <?php
    cart();
    ?>

    <!-- fourth child  -->
    <div class="container mb-5">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center">
                    <!-- php code to display dynamic data  -->
                    <?php
                    global $con;
                    $get_email = getEmail();
                    $total_price = 0;
                    $cart_query = "SELECT * FROM `cart_details` WHERE email='$get_email'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);

                    if ($result_count > 0) {
                        echo "<thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Item Price</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>";

                        while ($row = mysqli_fetch_array($result)) {
                            $food_id = $row['food_id'];
                            $selected_food = "SELECT * FROM `food` WHERE food_id='$food_id'";
                            $result_food = mysqli_query($con, $selected_food);

                            while ($row_food_price = mysqli_fetch_array($result_food)) {
                                $food_price = array($row_food_price['food_price']);
                                $price_table = $row_food_price['food_price'];
                                $food_title = $row_food_price['food_title'];
                                $food_image = $row_food_price['food_image'];
                                $food_values = array_sum($food_price);
                                $total_price += $food_values;

                                $quantity = $row['quantity']; // Retrieve the quantity from the cart_details table
                                ?>

                                <tr>
                                    <td><?php echo $food_title ?></td>
                                    <td><img src="../admin_area/food_images/<?php echo $food_image ?>" class="cart_img" alt=""></td>
                                    <td><input type="text" name="qty[<?php echo $food_id ?>]" class="form-input w-50 text-center" value="<?php echo $quantity ?? 1 ?>"></td>
                                    <?php
                                    if (isset($_POST['update_cart'])) {
                                        $quantities = $_POST['qty'][$food_id];
                                        $update_cart = "UPDATE `cart_details` SET quantity=$quantities WHERE email='$get_email' AND food_id=$food_id";
                                        $result_food_quantity = mysqli_query($con, $update_cart);
                                        $total_price = $total_price * $quantities;
                                    }
                                    ?>
                                    <td><?php echo $price_table ?></td>
                                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $food_id; ?>"></td>
                                </tr>

                            <?php
                            }
                        }
                    } else {
                        echo "<h2 class='text-center mt-4'>Your Cart is Empty!</h2>";
                    }
                    ?>

                    </tbody>
                </table>
                <h4 class='px-3'>Subtotal: <strong>₹<?php total_cart_price() ?> /-</strong></h4>
                <input type='submit' value='Continue Shopping' class='bg-danger px-3 py-2 border-1 mx-3 text-light' name='continue_shopping'>
                <input type='submit' value='Remove Item' class='bg-danger px-3 py-2 border-1 mx-3 text-light' name='remove_cart'>
                <input type='submit' value='Update Cart' class='bg-danger px-3 py-2 border-1 mx-3 text-light' name='update_cart'>
                <button class='bg-danger p-3 py-2 border-1'><a href='payment.php' class='text-light text-decoration-none'>Checkout</a></button>
            </form>
        </div>
        <?php
        function remove_cart_item()
        {
            global $con;
            if (isset($_POST['remove_cart'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    echo $remove_id;
                    $delete_query = "DELETE FROM `cart_details` WHERE food_id=$remove_id";
                    $run_delete = mysqli_query($con, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('../home_pages/cart.php','_self')</script>";
                    }
                }
            }
        }

        echo $remove_item = remove_cart_item();
        ?>
    </div>

    <!--Last Child-->
    <?php
    include("../footer/footer.html");
    ?>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-PwXsXcOK3wRqZGLlFnXNmj+UklC8F9yoAqbQTe3o9jXNRKQW/WOY9p/By6toZFDK" crossorigin="anonymous"></script>
</body>

</html>