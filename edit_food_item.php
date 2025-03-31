<?php
if (isset($_GET['edit_food_item'])) {
    $edit_id = $_GET['edit_food_item'];
    $get_data = "Select * from `food` where food_id=$edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $food_title = $row['food_title'];
    $food_description = $row['food_description'];
    $food_keywords = $row['food_keywords'];
    $category_id = $row['category_id'];
    $cuisine_id = $row['cuisine_id'];
    $food_image = $row['food_image'];
    $food_image2 = $row['food_image2'];
    $food_image3 = $row['food_image3'];
    $food_price = $row['food_price'];
    $food_status = $row['status'];

    //fetching category id
    $select_category = "Select * from `categories` where category_id=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];

    //fetching cuisine id
    $select_cuisine = "Select * from `cuisines` where cuisine_id=$cuisine_id";
    $result_cuisine = mysqli_query($con, $select_cuisine);
    $row_cuisine = mysqli_fetch_assoc($result_cuisine);
    $cuisine_title = $row_cuisine['cuisine_title'];
}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit Food Item!</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_tytle" calss="form-lable">Food Title</label>
            <input type="text" id="food_title" name="food_title" value='<?php echo $food_title ?>' class="form-control">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_desc" class="form-lable">Food Description</label>
            <input type="text" id="food_desc" name="food_desc" value='<?php echo $food_description ?>' class="form-control">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_keywords" class="form-lable">Food Keywords</label>
            <input type="text" id="food_keywords" name="food_keywords" value='<?php echo $food_keywords ?>' class="form-control">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_categories" class="form-lable">Categories</label>
            <select name="food_category" class="form-select">
                <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                <?php
                //fetching categories
                $select_category_all = "Select * from `categories`";
                $result_category_all = mysqli_query($con, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_title = $row_category_all['category_title'];
                    $category_id = $row_category_all['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_cuisines" calss="form-lable">Cuisines</label>
            <select name="food_cuisine" class="form-select">
                <option value="<?php echo $cuisine_title ?>"><?php echo $cuisine_title ?></option>
                <?php
                //fetching cuisines
                $select_cuisine_all = "Select * from `cuisines`";
                $result_cuisine_all = mysqli_query($con, $select_cuisine_all);
                while ($row_cuisine_all = mysqli_fetch_assoc($result_cuisine_all)) {
                    $cuisine_title = $row_cuisine_all['cuisine_title'];
                    $cuisine_id = $row_cuisine_all['cuisine_id'];
                    echo "<option value='$cuisine_id'>$cuisine_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_image1" calss="form-lable">Food Image 1</label>
            <div class="d-flex">
                <input type="file" id="food_image" name="food_image" class="form-control w-90 m-auto">
                <img src="../images/<?php echo $food_image; ?>" alt="" class="food_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_image1" calss="form-lable">Food Image 2</label>
            <div class="d-flex">
                <input type="file" id="food_image2" name="food_image2" class="form-control w-90 m-auto">
                <img src="../images/<?php echo $food_image2; ?>" alt="" class="food_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_image1" calss="form-lable">Food Image 3</label>
            <div class="d-flex">
                <input type="file" id="food_image3" name="food_image3" class="form-control w-90 m-auto">
                <img src="../images/<?php echo $food_image3; ?>" alt="" class="food_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_price" class="form-lable">Food Price</label>
            <input type="text" id="food_price" name="food_price" value='<?php echo $food_price ?>' class="form-control">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="food_status" class="form-lable">Food Status</label>
            <input type="text" id="food_price" name="food_status" value='<?php echo $food_status ?>' class="form-control">
        </div>
        <div class="text-center">
            <input type="submit" name='edit_food_item' value='Update Food Item' class='btn btn-danger px-3 mb-5'>
        </div>
    </form>
</div>
<style>
    .food_img {
        width: 200px;
        object-fit: contain;
    }
</style>

<!-- editing products -->
<?php

if (isset($_POST['edit_food_item'])) {
    $food_title = $_POST['food_title'];
    $food_desc = $_POST['food_desc'];
    $food_keywords = $_POST['food_keywords'];
    $food_category = $_POST['food_category'];
    $food_cuisine = $_POST['food_cuisine'];
    $food_price = $_POST['food_price'];
    $food_status = $_POST['food_status'];


    $food_image = $_FILES['food_image']['name']; //fetching image name
    $food_image2 = $_FILES['food_image2']['name'];
    $food_image3 = $_FILES['food_image3']['name'];

    $temp_food_image = $_FILES['food_image']['tmp_name']; //fetching temporary name
    $temp_food_image2 = $_FILES['food_image2']['tmp_name'];
    $temp_food_image3 = $_FILES['food_image3']['tmp_name'];

    move_uploaded_file($temp_food_image, "food_images/$food_image");
    move_uploaded_file($temp_food_image2, "food_images/$food_image2");
    move_uploaded_file($temp_food_image3, "food_images/$food_image3");

    //query to update food table
    $update_food = "Update `food` set food_title='$food_title', food_description='$food_desc', food_keywords='$food_keywords',
    category_id='$food_category', cuisine_id='$food_cuisine', food_image='$food_image', food_image2='$food_image2', 
    food_image3='$food_image3', food_price='$food_price',status='$food_status', date=NOW() where food_id=$edit_id";
    $result_update=mysqli_query($con,$update_food);
    if($result_update){
        echo "<script>alert('Food Item updated Successfully')</script>";
        echo "<script>windoe.open('./insert_food.php','_self')";
    }
}

?>