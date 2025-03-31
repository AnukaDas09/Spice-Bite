<?php
// if login is successful, then only the menu page will be accessible
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
  <title>Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="payment.css" type="text/css">

</head>

<body>
  <!-- PHP code to access user id -->
  <?php
  $user_id = getID();
  ?>

  <h2 class="text-center">COD is selected by default, You can pay from ORDERS section too!</h2>

  <div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="row">
      <div class="col-md-4">
        <div class="box text-center">
          <div class="addition-container">

            <?php
            global $con;
            $get_email = getEmail();
            $cart_query = "SELECT * FROM `cart_details` WHERE email='$get_email'";
            $result = mysqli_query($con, $cart_query);

            while ($row = mysqli_fetch_array($result)) {
              $food_id = $row['food_id'];
              $quantity = $row['quantity'];
              $selected_food = "SELECT * FROM `food` WHERE food_id='$food_id'";
              $result_food = mysqli_query($con, $selected_food);

              while ($row_food_price = mysqli_fetch_array($result_food)) {
                $food_price = $row_food_price['food_price'];
                $food_title = $row_food_price['food_title'];

                $food_item = "SELECT food_price FROM `food` WHERE food_id='$food_id'";
                $price_result = mysqli_query($con, $food_item);

                if ($price_result && mysqli_num_rows($price_result) > 0) {
                  $price_row = mysqli_fetch_assoc($price_result);
                  $food_price = $price_row['food_price'];

                  $item_price = $food_price * $quantity;

                  echo "<div class='food-item'><div class='food-title'>&nbsp;&nbsp;$food_title ($quantity) -</div><div class='food-price'>₹$item_price</div></div>";
                }
              }
            }
            ?>
            <div class="horizontal-line"></div>
            <div class="result">₹<?php total_cart_price() ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid d-flex justify-content-center m-3 mh-100">
    <a href="../user/order.php?user_id=<?php echo $user_id; ?>" class="big-button">Place Order</a>
  </div>

  <!-- Footer -->
  <?php
  include("../footer/footer.html");
  ?>
</body>

</html>