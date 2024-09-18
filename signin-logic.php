<?php

require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_email = $_POST['username'];
    $password = $_POST['password'];

    if (!$username_email) {
        $_SESSION['signin'] = "Username or Email required";
    } else if (!$password) {
        $_SESSION['signin'] = "Password is required";
    } else {

        $fetch_user_query = "SELECT *FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {

            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            if (password_verify($password, $db_password)) {

                $_SESSION['user-id'] = $user_record['id'];

                if ($user_record['admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }

                if ($user_record['admin'] == 0) {
                    $_SESSION['user_is_user'] = true;
                    header("Location:http://localhost/petStudio/shoppingCart.php");
                    die();
                } else {
                    header("Location:http://localhost/petStudio/admin-dashboard.php");
                    die();
                }
            } else {
                $_SESSION['signin'] = 'Please check your input';
            }
        } else {
            $_SESSION['signin'] = "User not found";
        }
    }

    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('Location:http://localhost/petStudio/signin.php');
        die();
    }
}
