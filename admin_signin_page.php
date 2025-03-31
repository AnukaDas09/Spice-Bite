<?php
$login=0;
$invalid=0;
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        include '../functions/connect.php';
        $username=$_POST['admin_username'];
        $password=$_POST['password'];

        $sql="Select * from `admin` where admin_username= '$username' and password= '$password'"; //query to check where username = username.
        $result=mysqli_query($con,$sql);
        if($result)
        {
            $num=mysqli_num_rows($result);
            if($num>0) //number of rows > 0 i.e. username and password match.
            {
                $login=1;
                session_start();
                $_SESSION['admin_username']=$username;
                header('location:index.php');
            }
            else //if username or password is incorrect.
            {
                $invalid=1;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Sign-in Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../user/signin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <img src="../images/logo.png" id="company_logo">
    <div class="loginbox">
    <img src="../images/ava.png" class="avatar">
        <h1>Welcome Admin</h1>
        <form action="admin_signin_page.php" method= "post">
            <p>Username</p>
            <input type="text" name="admin_username" placeholder="Enter your Username" autocomplete="off" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter your Password" required>
            <input type="submit" name="" value="Sign in">
            <a href="#">Forgot Password?</a>
        </form>
        <?php
            if($invalid)
            {
                echo '<p style="color: red">Invalid Details.</p>';
            }
        ?>
    </div>
</body>
</html>