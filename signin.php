<?php
$login=0;
$invalid=0;
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        include '../functions/connect.php';
        $email=$_POST['email'];
        $password=$_POST['password'];
        
        $sql="Select * from `user` where user_email= '$email' and password= '$password'"; //query to check where username = username.
        $result=mysqli_query($con,$sql);
        if($result)
        {
            $num=mysqli_num_rows($result);
            if($num>0) //number of rows > 0 email and password match.
            {
                $login=1;
                session_start();
                $_SESSION['user_email']=$email;
                header('location:../home_pages/index.php');
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
<head><title>Spice & Bite Sign in</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="signin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <img src="../images/logo.png" id="company_logo">
    <div class="loginbox">
    <img src="../images/ava.png" class="avatar">
        <h1>Sign in</h1>
        <form action="signin.php" method= "post">
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter your Email" autocomplete="off" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter your Password" required>
            <input type="submit" name="" value="Sign in">
            <a href="signup.php">Don't have an account?</a></br>
            <a href="changepassword.php">Forgot Password?</a>
        </form>
        <?php
            if($invalid)
            {
                echo '<p style="color: red">Invalid Details!</p>';
            }
        ?>
    </div>
</body>
</html>