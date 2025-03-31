<?php 
if(isset($_GET['delete_food_item'])){
    $delete_id=$_GET['delete_food_item'];
    //delete query
    $delete_food="Delete from `food` where food_id=$delete_id";
    $result_delete=mysqli_query($con,$delete_food);
    if($result_delete){
        echo "<script>alert('Food Item deleted Successfully')</script>";
        echo "<script>windoe.open('./insert_food.php','_self')";
    }
}