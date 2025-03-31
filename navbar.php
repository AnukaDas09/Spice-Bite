<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>rough</title>
  <style>
    .nav-bar {
      height: 60px;
    }

    .nav-bar ul {
      display: flex;
    }

    .nav-bar ul li a {
      display: block;
      padding: 10px 20px;
      margin: 0 5px;
      transition: 0.50s ease;
      color: red;
    }

    .nav-bar ul li a:hover {
      color: white;
      background: red;
    }

    .nav-bar ul li a:hover i {
      color: white;
    }

    .nav-bar ul li a.active {
      color: white;
      background: red;
    }

    .nav-bar ul li a.active i {
      color: white;
    }
  </style>
</head>

<body>
  <nav class="nav-bar sticky-top navbar-expand-lg navbar-warning bg-warning bg-warning">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="ms-1 mt-2">
          <a href="index.php" class="nav-link p-2 rounded-3"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="nav-item mt-2 rounded-3">
          <a href="../home_pages/display_all.php" class="nav-link fs-6 p-2 rounded-3">All Items</a>
        </li>
        <li class="nav-item mt-2 rounded-3">
          <a href="../home_pages/cuisines.php" class="nav-link fs-6 p-2 rounded-3">Cuisines</a>
        </li>
        <li class="nav-item mt-2 rounded-3">
          <a href="../home_pages/categories.php" class="nav-link fs-6 p-2 rounded-3">Categories</a>
        </li>
        <li class="nav-item mt-2">
          <div class="dropdown">
            <a class="dropdown-toggle nav-link fs-6 p-2 rounded-3" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Profile</a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="../user/user_profile.php">My Profile</a>
              <a class="dropdown-item" href="../user/user_profile.php?my_orders">My Orders</a>
              <a class="dropdown-item" href="../functions/logout.php">Logout</a>
            </div>
          </div>
        </li>
        <li class="nav-item mt-2">
          <a href="../home_pages/cart.php" class="nav-link fs-6 p-2 rounded-3"><i class="fa-solid fa-cart-shopping">
            </i><sup><?php cart_item_number(); ?></sup></a>
          <!-- used cart icon and used super-script to display the number of cart items. -->
        </li>

        <li class="nav-item">
          <a class="nav-link fs-6 mt-2 disabled text-danger rounded-3">Total Price: ₹<?php total_cart_price(); ?>/-</a>
        </li>
        <form class="d-flex mt-2 position-absolute top-0 end-0" action="search_food.php" method="get">
          <input class="form-control me-2 align-middle" type="search" placeholder="Search" aria-label="Search" name="search_data">
          <input type="submit" class="btn btn-outline-danger align-middle" value="Search" name="search_data_food">
        </form>
      </ul>
    </div>
  </nav>

  <script>
  const currentLocation = location.href;
  const menuItem = document.querySelectorAll(".nav-bar ul a");
  const menuLength = menuItem.length;

  for (var i = 0; i < menuLength; i++) {
    if (menuItem[i].href === currentLocation) {
      menuItem[i].className = "active rounded-3 text-decoration-none";
    }
  }
</script>

</body>

</html>