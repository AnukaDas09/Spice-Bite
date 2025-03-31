<?php
    // Delete a specific session variable
    unset($_SESSION['admin_username']);
    // Redirect or perform any other actions
    header('location:admin_signin_page.php')
?>
