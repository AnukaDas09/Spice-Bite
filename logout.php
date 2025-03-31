<?php
    // Start the session
    session_start();

    // Unset the specific session variable
    unset($_SESSION['user_email']);

    // Redirect to the desired location
    header('location:../user/signin.php');
    exit();
?>
