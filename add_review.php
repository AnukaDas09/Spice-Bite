<!DOCTYPE html>
<html>

<head>
    <title>Food Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .review-container {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        .review-title {
            font-size: 24px;
        }

        .review-content {
            margin-top: 10px;
        }

        .review-form input[type="text"],
        .review-form textarea,
        .review-form select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        .review-form button:hover {
            background-color: #FF0000;
            color: white;
        }
    </style>
</head>

<body>
    <div class="review-container">
        <h2 class="review-title">Submit Your Review</h2>
        <form class="review-form" action="" method="post" enctype="multipart/form-data">
            <select name="food_id">
                <?php
                include('../functions/connect.php');
                $get_review = "SELECT food_id, food_title FROM `food` ORDER BY food_title ASC";
                $result = mysqli_query($con, $get_review);

                while ($row_data = mysqli_fetch_assoc($result)) {
                    $food_id = $row_data['food_id'];
                    $food_title = $row_data['food_title'];
                    echo "<option value='$food_id'>$food_title</option>";
                }
                ?>
            </select>
            <input type="text" name="title" placeholder="Review Title" required>
            <textarea name="content" placeholder="Your Review" rows="4" required></textarea>
            <input type="file" name="image" accept="image/*"> <!-- Added input for image upload -->
            <button type="submit" name="insert_review" class="btn btn-warning my-1">Submit Review</button>
        </form>
    </div>
</body>

</html>

<?php
include('../functions/connect.php');
if (isset($_POST['insert_review'])) {
    $rev_food = $_POST['food_id'];
    $rev_title = $_POST['title'];
    $rev_content = $_POST['content'];
    $rev_image = $_FILES['image']['name']; // Retrieve the uploaded image file name

    // Escape special characters in the input
    $rev_title = mysqli_real_escape_string($con, $rev_title);
    $rev_content = mysqli_real_escape_string($con, $rev_content);

    $user_id = getID();
    $name = "SELECT name FROM `user` WHERE id=$user_id";
    $res_name = mysqli_query($con, $name);
    $row = mysqli_fetch_assoc($res_name);
    $user_name = $row['name'];

    // Move the uploaded image file to the desired directory
    $target_dir = "../admin_area/review_images/"; // Updated directory path
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $insert_review = "INSERT INTO `review` (user_id, user_name, food_id, food_review_title, food_review_desc, review_image) 
    VALUES ('$user_id', '$user_name', '$rev_food', '$rev_title', '$rev_content', '$rev_image')";
    $result_query = mysqli_query($con, $insert_review);
    if ($result_query) {
        echo "<script>alert('Review Added!')</script>";
    } else {
        echo "Error: " . mysqli_error($con); // Display the actual error message for debugging purposes
    }
}
?>
