<?php
if (isset($_GET['edit_cuisine'])) {
    $edit_cuisine = $_GET['edit_cuisine'];
    echo $edit_cuisine;

    $get_cuisines = "Select * from `cuisines` where cuisine_id=$edit_cuisine";
    $result = mysqli_query($con, $get_cuisines);
    $row = mysqli_fetch_assoc($result);
    $cuisine_title = $row['cuisine_title'];
    echo $cuisine_title;
}
if (isset($_POST['edit_cui'])) {
    $cui_title = $_POST['cuisine_title'];

    $update_query = "Update `cuisines` set cuisine_title='$cui_title' where cuisine_id=$edit_cuisine";
    $result_cui = mysqli_query($con, $update_query);
    if ($result_cui) {
        echo "<script>alert('Cuisine updated Successfully!')</script>";
        echo "<script>window.open('./index.php?view_cuisines','_self')</script>";
    }
}
?>
<div class="container mt-3">
    <h2 class="text-center mb-5">Edit Cuisine!</h2>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="cuisine_title" class="form-label">Cuisine Title</label>
            <input type="text" name="cuisine_title" id="cuisine_title" class="form-control" value='<?php echo $cuisine_title; ?>' 
            required="required">
        </div>
        <input type="submit" value="Update Cuisine" class="btn btn-danger" name="edit_cui">
    </form>
</div>