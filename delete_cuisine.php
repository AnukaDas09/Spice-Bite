<?php
if(isset($_GET['delete_cuisine'])){
    $delete_cuisine=$_GET['delete_cuisine'];

    $delete_query="Delete from `cuisines` where cuisine_id=$delete_cuisine";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Cuisine deleted Successfully!')</script>";
        echo "<script>window.open('./index.php?view_cuisines','_self')</script>";
    }
}
?>