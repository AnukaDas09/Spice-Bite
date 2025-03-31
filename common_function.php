<?php
// getting food items
function getfood()
{
    global $con;
    //checking isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['cuisine'])) {
            $select_query = "Select * from `food` WHERE status='true' order by rand() LIMIT 0,16";
            $result_query = mysqli_query($con, $select_query);

            while ($row = mysqli_fetch_assoc($result_query)) //it will continue unless all the products are accessed
            {
                $food_id = $row['food_id'];
                $food_title = $row['food_title'];
                $food_description = $row['food_description'];
                $food_image = $row['food_image'];
                $food_price = $row['food_price'];
                $category_id = $row['category_id'];
                $cuisine_id = $row['cuisine_id'];
                echo "<div class='col-md-3 mb-2'>
                <div class='card'>
                    <img src='../admin_area/food_images/$food_image' class='card-img-top' alt='$food_title'>
                    <div class='card-body shadow'>
                        <h5 class='card-title'>$food_title</h5>
                        <p id='myText' class='card-text'>$food_description</p>
                        <p class='card-text'>Price: ₹$food_price/-</p>
                        <a href='../home_pages/index.php?add_to_cart=$food_id' class='btn btn-danger'>Add to cart</a>
                        <a href='../home_pages/food_details.php?food_id=$food_id' class='btn btn-warning'>View more</a>
                    </div>
                </div>
            </div>
            <style> 
            #myText {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                        line-clamp: 3; 
                -webkit-box-orient: vertical;
              } 
              </style>";
            }
        }
    }
}

//getting all food items
function get_all_food()
{
    global $con;
    //checking isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['cuisine'])) {
            $select_query = "Select * from `food` WHERE status='true'";
            $result_query = mysqli_query($con, $select_query);

            while ($row = mysqli_fetch_assoc($result_query)) //it will continue unless all the products are accessed
            {
                $food_id = $row['food_id'];
                $food_title = $row['food_title'];
                $food_description = $row['food_description'];
                $food_image = $row['food_image'];
                $food_price = $row['food_price'];
                $category_id = $row['category_id'];
                $cuisine_id = $row['cuisine_id'];
                echo "<div class='col-md-3 mb-2'>
                    <div class='card'>
                        <img src='../admin_area/food_images/$food_image' class='card-img-top' alt='$food_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$food_title</h5>
                            <p id='myText' class='card-text'>$food_description</p>
                            <p class='card-text'>Price: ₹$food_price/-</p>
                            <a href='../home_pages/index.php?add_to_cart=$food_id' class='btn btn-danger'>Add to cart</a>
                            <a href='../home_pages/food_details.php?food_id=$food_id' class='btn btn-warning'>View more</a>
                        </div>
                    </div>
                </div>
                <style> 
                #myText {
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 3;
                            line-clamp: 3; 
                    -webkit-box-orient: vertical;
                  } 
                  </style>";
            }
        }
    }
}

//getting unique categories vdo 19
function get_unique_categories()
{
    global $con;
    //condition to check issert or not
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "Select * from `food` where category_id=$category_id AND status='true'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class ='text-center text-danger'>No stock for this category.</h2>";
        } else {
            while ($row = mysqli_fetch_assoc($result_query)) //it will continue unless all the products are accessed
            {
                $food_id = $row['food_id'];
                $food_title = $row['food_title'];
                $food_description = $row['food_description'];
                $food_image = $row['food_image'];
                $food_price = $row['food_price'];
                $category_id = $row['category_id'];
                $cuisine_id = $row['cuisine_id'];
                echo "<div class='col-md-3 mb-2'>
                    <div class='card' style='width: 18rem;'>
                        <img src='../admin_area/food_images/$food_image' class='card-img-top' alt='$food_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$food_title</h5>
                            <p id='myText' class='card-text'>$food_description</p>
                            <p class='card-text'>Price: ₹$food_price/-</p>
                            <a href='../home_pages/index.php?add_to_cart=$food_id' class='btn btn-danger'>Add to cart</a>
                            <a href='../home_pages/food_details.php?food_id=$food_id' class='btn btn-warning'>View more</a>
                        </div>
                    </div>
                </div>
                <style> 
                #myText {
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 3;
                            line-clamp: 3; 
                    -webkit-box-orient: vertical;
                  } 
                  </style>";
            }
        }
    }
}

//getting unique cuisine vdo 19.
function get_unique_cuisines()
{
    global $con;
    //condition to check isset or not.
    if (isset($_GET['cuisine'])) {
        $cuisine_id = $_GET['cuisine'];
        $select_query = "Select * from `food` where cuisine_id = $cuisine_id AND status='true'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class ='text-center text-danger'>No stock for this cuisine.</h2>";
        } else {
            while ($row = mysqli_fetch_assoc($result_query)) //It will continue unless all the products are accessed.
            {
                $food_id = $row['food_id'];
                $food_title = $row['food_title'];
                $food_description = $row['food_description'];
                $food_image = $row['food_image'];
                $food_price = $row['food_price'];
                $category_id = $row['category_id'];
                $cuisine_id = $row['cuisine_id'];
                echo "<div class = 'col-md-3 mb-2'>
                    <div class = 'card' style='width: 18rem;'>
                        <img src = '../admin_area/food_images/$food_image' class = 'card-img-top' alt='$food_title'>
                            <div class='card-body'>
                            <h5 class='card-title'> $food_title </h5>
                            <p id='myText' class='card-text'>$food_description</p>
                            <p class='card-text'>Price: ₹$food_price/-</p>
                            <a href='../home_pages/index.php?add_to_cart=$food_id' class='btn btn-danger'>Add to cart</a>
                            <a href='../home_pages/food_details.php?food_id=$food_id' class='btn btn-warning'>View more</a>
                        </div>
                    </div>
                </div>
                <style> 
                #myText {
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 3;
                            line-clamp: 3; 
                    -webkit-box-orient: vertical;
                  } 
                  </style>";
            }
        }
    }
}

//displaying cuisine in side nav 
function getcuisines()
{
    global $con;
    $select_cuisines = "Select * from `cuisines`";
    $res_resturants = mysqli_query($con, $select_cuisines);

    while ($row_data = mysqli_fetch_assoc($res_resturants)) {
        $cuisine_title = $row_data['cuisine_title'];
        $cuisine_id = $row_data['cuisine_id'];
        echo "";
        echo "<li class='nav-item'>
            <a href='../home_pages/index.php?cuisine=$cuisine_id' class='nav-link'>$cuisine_title</a><hr>
        </li>";
    }
}

//displaying categories in side bav
function getcategories()
{
    global $con;
    $select_category = "Select * from `categories`";
    $res_category = mysqli_query($con, $select_category);

    while ($row_data = mysqli_fetch_assoc($res_category)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "";
        echo "<li class='nav-item'>
            <a href='../home_pages/index.php?category=$category_id' class='nav-link'>$category_title</a><hr>
        </li>";
    }
}

//searching food
function search_food()
{
    global $con;
    if (isset($_GET['search_data_food'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "Select * from `food` where food_keywords like '%$search_data_value%' AND status='true'";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class ='text-center text-danger'>No result found!</h2>";
        } else {
            while ($row = mysqli_fetch_assoc($result_query)) //it will continue unless all the products are accessed
            {
                $food_id = $row['food_id'];
                $food_title = $row['food_title'];
                $food_description = $row['food_description'];
                $food_image = $row['food_image'];
                $food_price = $row['food_price'];
                $category_id = $row['category_id'];
                $cuisine_id = $row['cuisine_id'];
                echo "<div class='col-md-3 mb-2'>
                    <div class='card'>
                        <img src='../admin_area/food_images/$food_image' class='card-img-top' alt='$food_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$food_title</h5>
                            <p id='myText' class='card-text'>$food_description</p>
                            <p class='card-text'>Price: ₹$food_price/-</p>
                            <a href='../home_pages/index.php?add_to_cart=$food_id' class='btn btn-danger'>Add to cart</a>
                            <a href='../home_pages/food_details.php?food_id=$food_id' class='btn btn-warning'>View more</a>
                        </div>
                    </div>
                </div>
                <style> 
                #myText {
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 3;
                            line-clamp: 3; 
                    -webkit-box-orient: vertical;
                  } 
                  </style>";
            }
        }
    }
}


//view details function
function view_details()
{
    global $con;
    // checking isset or not
    if (isset($_GET['food_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['cuisine'])) {
                $food_id = $_GET['food_id'];
                $select_query = "SELECT * FROM `food` WHERE food_id = $food_id";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $food_id = $row['food_id'];
                    $food_title = $row['food_title'];
                    $food_description = $row['food_description'];
                    $food_image = $row['food_image'];
                    $food_image2 = $row['food_image2'];
                    $food_image3 = $row['food_image3'];
                    $food_price = $row['food_price'];
                    $category_id = $row['category_id'];
                    $cuisine_id = $row['cuisine_id'];

                    echo "<div class='col-md-3 mb-2'>
                            <div class='card'>
                                <img src='../admin_area/food_images/$food_image' class='card-img-top' alt='$food_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$food_title</h5>
                                    <p class='card-text'>$food_description</p>
                                    <p class='card-text'>Price: ₹$food_price/-</p>
                                    <a href='../home_pages/index.php?add_to_cart=$food_id' class='btn btn-danger'>Add to cart</a>
                                    <a href='../home_pages/index.php' class='btn btn-warning'>Go Back</a>
                                </div>
                            </div>
                        </div> 
                        <div class='col-md-8'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <h4 class='text-center mb-5'>More Food Images.</h4>
                                </div>
                                <div class='col-md-4'>
                                    <div class='col-md-3 mb-2'>
                                        <div class='card' style='width: 20rem;'>
                                            <img src='../admin_area/food_images/$food_image2' class='card-img-top' alt='$food_title'>
                                            <div class='card-body'></div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='col-md-3 mb-2'>
                                        <div class='card' style='width: 20rem;'>
                                            <img src='../admin_area/food_images/$food_image3' class='card-img-top' alt='$food_title'>
                                            <div class='card-body'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                }

                $select_review = "SELECT * FROM `review` WHERE food_id = $food_id LIMIT 5";
                $review_query = mysqli_query($con, $select_review);
                if (mysqli_num_rows($review_query) > 0) {
                    echo "<div class='review-container'>
                        <div class='review-header'>
                            <h2>Customer Reviews</h2>
                        </div>
                        <div class='review-body'>";

                    while ($row = mysqli_fetch_assoc($review_query)) {
                        $user_name = $row['user_name'];
                        $food_review_title = $row['food_review_title'];
                        $food_review_desc = $row['food_review_desc'];
                        $food_image = $row['review_image'];

                        echo "<hr> <div class='review-item'>
                            <div class='review-image'>
                                <img src='../images/$food_image' alt='Reviewer Image'>
                            </div>
                            <div class='review-content'>
                                <p class='review-username'>$user_name</p>
                                <p>$food_review_title</p>
                                <p>$food_review_desc</p>
                            </div>
                          </div>";
                    }

                    echo "</div></div>";

                    echo "<style>
                    .review-container {
                        border: 1px solid #ccc;
                        padding: 20px;
                        margin-bottom: 20px;
                    }
                    
                    .review-header {
                        text-align: center;
                        margin-bottom: 10px;
                    }
                    
                    .review-body {
                        display: flex;
                        flex-direction: column;
                    }
                    
                    .review-item {
                        display: flex;
                        align-items: center;
                        margin-bottom: 20px;
                    }
                    
                    .review-image img {
                        width: 100px;
                        height: 100px;
                        border-radius: 50%;
                        object-fit: cover;
                        margin-right: 20px;
                    }
                    
                    .review-content {
                        font-size: 16px;
                    }
                    
                    .review-username {
                        font-weight: bold;
                        font-size: 16px;
                        margin-bottom: 5px;
                    }
                    
                    .review-rating {
                        font-weight: bold;
                        color: #ff9800;
                    }
                </style>";
                } else {
                    echo "<div class='review-container'>
                    <div class='review-header'>
                        <h2>Customer Review</h2>
                    </div>
                    <div class='review-body'>
                    Be the first to Add Review.<a href='../user/user_profile.php?add_review'>Click Here.</a>
                    </div>";

                    echo "<style>
                    body{
                        overflow-x: hidden;
                    }
                    .review-container {
                        border: 1px solid #ccc;
                        padding: 20px;
                        margin-bottom: 20px;
                    }
                    .review-body {
                        display: flex;
                        flex-direction: column;
                    }";
                }
            }
        }
    }
}


function getEmail()
{
    $uemail = $_SESSION['user_email'];
    return $uemail;
}

function getID()
{
    global $con;
    $uemail = getEmail();
    $hh = "SELECT id FROM `user` WHERE user_email = '$uemail'"; // Add single quotes around $uemail
    $res_id = mysqli_query($con, $hh);
    $row = mysqli_fetch_assoc($res_id); // Fetch the row from the result set
    $user_id = $row['id']; // Retrieve the user_id from the row
    return $user_id; // Return the user_id
}

//cart function
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_email = getEmail();
        $get_food_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM `cart_details` WHERE email='$get_email' AND food_id=$get_food_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already present in cart!')</script>";
            echo "<script>window.history.back();</script>"; // Go back to previous page
        } else {
            $insert_query = "INSERT INTO `cart_details` (food_id, email, quantity) VALUES ($get_food_id, '$get_email', 1)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>alert('Item is added to cart!')</script>";
            echo "<script>window.history.back();</script>"; // Go back to previous page
        }
    }
}

//function to get the cart item numbers
function cart_item_number()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_email = getEmail();
        $select_query = "Select * from `cart_details` where email='$get_email'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        global $con;
        $get_email = getEmail();
        $select_query = "Select * from `cart_details` where email='$get_email'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}

//total price function
function total_cart_price()
{
    global $con;
    $get_email = getEmail();
    $total_price = 0;
    $cart_query = "SELECT * FROM `cart_details` WHERE email='$get_email'";
    $result = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $food_id = $row['food_id'];
        $selected_food = "SELECT * FROM `food` WHERE food_id='$food_id'";
        $result_food = mysqli_query($con, $selected_food);
        while ($row_food_price = mysqli_fetch_array($result_food)) {
            $food_price = $row_food_price['food_price'];
            $quantity = $row['quantity'];
            $food_total_price = $food_price * $quantity;
            $total_price += $food_total_price;
        }
    }
    echo $total_price;
}


//get user order details
function get_user_order_details()
{
    global $con;
    $user_email = $_SESSION['user_email'];
    $get_details = "Select * from `user` where user_email='$user_email'";
    $result_query = mysqli_query($con, $get_details);
    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['add_review'])) {
                    $get_orders = "Select * from `user_order` where user_id=$user_id and order_status='pending'";
                    $result_order_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($result_order_query);
                    if ($row_count > 0) {
                        echo "<h3 class='text-center'>You have <span class='text-danger'> $row_count </span>Pending orders!</h3><br>
                    <p class='text-center'><a href='../user/user_profile.php?my_orders'>Order details.</a></p>";
                    } else {
                        echo "<h3 class='text-center'>You have No pending orders!</h3><br>
                    <p class='text-center'><a href='../home_pages/index.php'>Explore Food Items!</a></p>";
                    }
                }
            }
        }
    }
}
function cart_items()
{
    global $con;
    $get_email = getEmail(); // storing email address
    $food_names = array(); // array to store food names
    $cart_query = "SELECT * FROM `cart_details` WHERE email='$get_email'";
    $result = mysqli_query($con, $cart_query);

    while ($row = mysqli_fetch_array($result)) {
        $food_id = $row['food_id'];
        $selected_food = "SELECT * FROM `food` WHERE food_id='$food_id'";
        $result_food = mysqli_query($con, $selected_food);

        while ($row_food_price = mysqli_fetch_array($result_food)) {
            $food_names[] = $row_food_price['food_title']; // store food names in array
        }
    }
    echo "Food Names: " . implode(", ", $food_names);
}

function final_cart_price()
{
    global $con;
    $get_email = getEmail();
    $total_price = 0;
    $cart_query = "SELECT * FROM `cart_details` WHERE email='$get_email'";
    $result = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $food_id = $row['food_id'];
        $selected_food = "SELECT * FROM `food` WHERE food_id='$food_id'";
        $result_food = mysqli_query($con, $selected_food);
        while ($row_food_price = mysqli_fetch_array($result_food)) {
            $food_price = $row_food_price['food_price'];
            $quantity = $row['quantity'];
            $food_total_price = $food_price * $quantity;
            $total_price += $food_total_price;
        }
    }
    return $total_price;
}
?>