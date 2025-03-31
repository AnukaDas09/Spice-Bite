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
  <title>Spice & Bite</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: fill;
    }

    .admin_image {
      width: 100px;
      object-fit: contain;
    }

    body,
    html {
      height: 100%;
    }

    * {
      box-sizing: border-box;
    }

    .logo {
      width: 120px;
      height: 100px;
    }

    .bg-image {
      /* The image used */
      background-image: url(../images/bg10.png);

      /* Add the blur effect */
      filter: blur(5px);
      -webkit-filter: blur(5px);

      /* Full height */
      height: 43%;

      /* Center and scale the image nicely */
      background-position: center;
      background-size: cover;
      margin-bottom: 100px;

    }

    /* Position text in the middle of the page/image */
    .bg-text {
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/opacity/see-through */
      color: white;
      font-weight: bold;
      border: 3px solid #f1f1f1;
      position: absolute;
      top: 31%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 80%;
      padding: 20px;
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- Nav bar -->
  <?php
  include("../header/navbar.php");
  ?>
  <?php
  cart();
  ?>
  <!-- Second child -->
  <div class="bg-image"></div>

  <div class="bg-text">
    <h1>Spice & Bite</h1>
    <p>A fusion of taste and elegance.</p>
  </div>

  <!-- Third Child -->
  <div class="row p-3"> <!-- breaking into 10+2 because 4+4+4=12 -->
    <!-- food items -->
    <div class="row">
      <!-- fetching food items -->
      <?php
      view_details();
      get_unique_categories();
      get_unique_cuisines();
      ?>
      <!-- row end  -->
    </div>
    <!--Last Child-->
    <?php
    include("../footer/footer.html");
    ?>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>