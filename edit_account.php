<?php
// displaying database data in the fields
if (isset($_GET['edit_account'])) {
    $user_session_email = $_SESSION['user_email'];
    $select_query = "SELECT * FROM `user` WHERE user_email='$user_session_email'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['id'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['address'];
    $user_mobile = $row_fetch['user_mobile'];
    $user_name = $row_fetch['name'];
    $user_image = $row_fetch['user_image'];
}
if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_name = $_POST['user_name'];

    // check if an image has been selected
    if (!empty($_FILES['user_image']['name'])) {
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp, "user_image/$user_image");
    } else {
        $user_image = $row_fetch['user_image']; // use the existing image from the database
    }

    // updating the database
    $update_data = "UPDATE `user` SET name='$user_name',user_email='$user_email', user_image='$user_image', 
    address='$user_address',user_mobile='$user_mobile' WHERE id='$user_id'";
    $result_query_update = mysqli_query($con, $update_data);
    if ($result_query_update) {
        echo "<script>alert('Update Successful!')</script>";
    }
}
?>
<h3 class="mb-4">Edit Account</h3>
<form action="" method="post" enctype="multipart/form-data">
    <p>
        Email Id
    <div class="form-outline mb-4">
        <input type="email" class="form-control w-50 m-auto border-5" value="<?php echo $user_email; ?>" readonly name="user_email" autocomplete="off">
    </div>
    </p>
    <p>
        Name
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto border-5" value="<?php echo $user_name; ?>" name="user_name" autocomplete="off">
    </div>
    </p>
    <p>
        Profile Picture
    <div class="form-outline mb-4 d-flex w-50 m-auto border-0">
        <input type="file" class="form-control" name="user_image">
        <img src="user_image/<?php echo $user_image; ?>" class="profile_image">
    </div>
    </p>
    <p>
        Address
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto border-5" name="user_address" value="<?php echo $user_address; ?>" autocomplete="off">
    </div>
    </p>
    <p>
        Mobile No
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto border-5" name="user_mobile" value="<?php echo $user_mobile; ?>" autocomplete="off">
    </div>
    </p>
    <p>
    <div class="form-outline mb-4">
        <input type="submit" value="update" class="bg-danger py-2 px-5 border-1 text-light" name="user_update">
    </div>
    </p>
</form>