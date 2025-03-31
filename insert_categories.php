<?php
include('../functions/connect.php');
if(isset($_POST['insert_cat'])) //if this button is clicked
{
    $category_title=$_POST['cat_title']; //accessing data inserted into the from and storing it in a variable.
    //selecting data from database
    $select_query="Select * from `categories` where category_title='$category_title'"; //matching inserted data with rows in database
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select); //counting the number of rows with same data
    if($number > 0) //if data is already present in the database
    {
        echo "<script>alert('category is already present')</script>"; //alert will be displayed
    }
    else //if data is not present in the database data will be entered
    {
        $insert_query="insert into `categories`(category_title) value('$category_title')";
        $result=mysqli_query($con,$insert_query);
        if($result)
        {
            echo "<script>alert('category has been inserted successfully')</script>"; //showing popup
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catagories</title>
</head>
<body>
    <h3 class="text-center">Insert Categories</h3>
    <form action="" method="post" class="mb-2">
        <div class="input-group w-90 mb-2">
            <span class="input-group-text bg-warning" id="basic-addon1">
                <i class="fa-solid fa-receipt"></i></span>
            <input type="text" class="form-control" name="cat_title" placeholder="Insert Catagories" 
            aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group w-10 mb-2">
            <input type="submit" class="bg-danger border-1 p-2" name="insert_cat" value="Insert Category">
        </div>
    </form>
</body>
</html>