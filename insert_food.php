<?php
include('../functions/connect.php');
if (isset($_POST['insert_food'])) //if submit button is clicked
{
  $food_title = $_POST['food_title'];
  $food_description = $_POST['food_description'];
  $food_keywords = $_POST['food_keywords'];
  $category_id = $_POST['category_id'];
  $cuisine_id = $_POST['cuisine_id'];
  $food_price = $_POST['food_price'];
  $food_status = 'true';
  //accessing image
  $food_image = $_FILES['food_image']['name'];
  $food_image2 = $_FILES['food_image2']['name'];
  $food_image3 = $_FILES['food_image3']['name'];

  //accessing image temporary name
  $temp_image = $_FILES['food_image']['tmp_name'];
  $temp_image2 = $_FILES['food_image2']['tmp_name'];
  $temp_image3 = $_FILES['food_image3']['tmp_name'];

  move_uploaded_file($temp_image, "./food_images/$food_image"); //moving the uploaded image
  move_uploaded_file($temp_image2, "./food_images/$food_image2"); //moving the uploaded image
  move_uploaded_file($temp_image3, "./food_images/$food_image3"); //moving the uploaded image

  //insert query
  $insert_food_item = "insert into `food` (food_title,food_description,food_keywords,category_id,cuisine_id,food_image,food_image2,
    food_image3,food_price,date,status) value('$food_title','$food_description','$food_keywords','$category_id','$cuisine_id',
    '$food_image','$food_image2','$food_image3','$food_price',NOW(),'$food_status')";
  $result_query = mysqli_query($con, $insert_food_item);
  if ($result_query) {
    echo "<script>alert('Successfully inserted food item')</script>";
  }
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
  <title>Insert Products-Admin Dashboard</title>
</head>

<body class="bg-light">
  <div class="container">
    <h1 class="text-center">Insert Food</h1>
    <!-- form  -->
    <form action="" method="post" enctype="multipart/form-data">
      <!-- this is required to insert image  -->
      <div class="form-outline mb-4 w-50 m-auto">
        <lable for="food_title" class="form-label">
          Food title</lable>
        <input type="text" name="food_title" id="food_title" class="form-control" placeholder="Enter food title" autocomplete="off" required>
      </div>
      <!-- description -->
      <div class="form-outline mb-4 w-50 m-auto">
        <lable for="food_description" class="form-label">
          Food description</lable>
        <input type="text" name="food_description" id="food_description" class="form-control" placeholder="Enter food description" autocomplete="off" required>
      </div>
      <!-- keywords -->
      <div class="form-outline mb-4 w-50 m-auto">
        <lable for="food_keywords" class="form-label">
          Food keywords</lable>
        <input type="text" name="food_keywords" id="food_keywords" class="form-control" placeholder="Enter food keywords" autocomplete="off" required>
      </div>
      <!-- categories -->
      <div class="form-outline mb-4 w-50 m-auto">
        <select name="category_id" id="" class="form-select">
          <option value="">Select a Category</option>
          <?php
          $select_query = "Select * from `categories`";
          $result_query = mysqli_query($con, $select_query);
          while ($row = mysqli_fetch_assoc($result_query)) {
            $category_title = $row['category_title'];
            $category_id = $row['category_id'];
            echo "<option value='$category_id'>$category_title</option>";
          }
          ?>
        </select>
      </div>
      <!-- cuisine_name -->
      <div class="form-outline mb-4 w-50 m-auto">
        <select name="cuisine_id" id="cuisine_id" class="form-select">
          <option value="">Select a cuisine</option>
          <?php
          $select_query = "Select * from `cuisines`";
          $result_query = mysqli_query($con, $select_query);
          while ($row = mysqli_fetch_assoc($result_query)) {
            $cuisine_title = $row['cuisine_title'];
            $cuisine_id = $row['cuisine_id'];
            echo "<option value='$cuisine_id'>$cuisine_title</option>";
          }
          ?>
        </select>
      </div>
      <!-- images -->
      <div class="form-outline mb-4 w-50 m-auto">
        <lable for="food_image" class="form-label">
          Food image 1</lable>
        <input type="file" name="food_image" id="food_image" class="form-control" placeholder="Enter food image" required>
      </div>
      <div class="form-outline mb-4 w-50 m-auto">
        <lable for="food_image" class="form-label">
          Food image 2</lable>
        <input type="file" name="food_image2" id="food_image2" class="form-control" placeholder="Enter food image" required>
      </div>
      <div class="form-outline mb-4 w-50 m-auto">
        <lable for="food_image" class="form-label">
          Food image 3</lable>
        <input type="file" name="food_image3" id="food_image3" class="form-control" placeholder="Enter food image" required>
      </div>
      <!-- price -->
      <div class="form-outline mb-4 w-50 m-auto">
        <lable for="food_price" class="form-label">
          Food Price</lable>
        <input type="text" name="food_price" id="food_price" class="form-control" placeholder="Enter food price" autocomplete="off" required>
      </div>
      <!-- submit button -->
      <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" name="insert_food" value="Add food item">
      </div>
    </form>
  </div>
</body>

</html>