<?php //if login is successful then-only menu page will be accessible
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
  <title>All Items</title>
</head>

<body>
  <!-- Second child -->
  <!-- Nav bar -->
  <?php
  include("../header/navbar.php");
  ?>
  <!-- calling cart function -->
  <?php
  cart();
  ?>
  <!-- Third Child -->
  <div class="row p-3"> <!-- breaking into 10+2 because 4+4+4=12 -->
    <!-- food items -->
    <div class="row">
      <!-- fetching food items -->
      <?php
      get_all_food();
      get_unique_categories();
      get_unique_cuisines();
      ?>
    </div>
  </div>
  <!--Last Child-->
  <?php
  include("../footer/footer.html");
  ?>
  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>