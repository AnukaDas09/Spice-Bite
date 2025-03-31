<?php
// Assuming database connection is already established
$cc = 0;

if (isset($_POST['submit'])) {
    include '../functions/connect.php';
    $user_email = $_POST['user_email'];
    $newPassword = $_POST['new_password'];

    // Check if the username exists in the database
    $query = "SELECT * FROM user WHERE user_email = '$user_email'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // Update the user's password in the database
        $updateQuery = "UPDATE user SET password = '$newPassword' WHERE user_email = '$user_email'";
        mysqli_query($con, $updateQuery);

        echo "<script>
        alert('Password Changed. Redirecting to Sign-in Page!');
        window.location.href = 'signin.php';</script>
        } else {
        echo 'Invalid username.';";
    } else {
        $cc = 1;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link href="changepass.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Forgot Password</h1>
        <form method="POST" action="">
            <label>Username:</label>
            <input type="text" name="username" required><br><br>
            <label>New Password:</label>
            <input type="password" name="new_password" required><br><br>
            <input type="submit" name="submit" value="Reset Password">
        </form>
        <a href="signin.php">Remember Password?</a><br>
        <?php if ($cc == 1) {
            echo '<span style="color:red;">Username did not match!</span>';
        }
        ?>
    </div>
</body>

</html>