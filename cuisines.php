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
  <title>Spice & Bite Cuisines</title>
  <style>
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
  <!-- Third Child -->
    <div class="col-md-12 bg-warning p-0"> <!-- second column -->
      <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-danger">
          <a href="#" class="nav-link">
            <h4>Cuisines</h4>
          </a>
        </li>
        <?php
        getcuisines();
        ?>
      </ul>
    </div>
  <!--Last Child-->
  <?php
  include("../footer/footer.html");
  ?>
  </div>
  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </div>
</body>

</html>