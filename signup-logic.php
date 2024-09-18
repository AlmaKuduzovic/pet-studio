<?php

require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user_check_query = "SELECT *FROM users WHERE username='$username' OR email='$email'";
    $user_check_result = mysqli_query($connection, $user_check_query);

    if (mysqli_num_rows($user_check_result) > 0) {
        $_SESSION['signup-error'] = 'Username or Email already exist';
    }

    if (isset($_SESSION['signup-error'])) {
        $_SESSION['signup-data'] = $_POST;
        header('location:http://localhost/petStudio/signup.php');
        die();
    } else {


        $insert_user_query = "INSERT INTO users SET name='$name', lastname='$lastname', username='$username', email='$email', password = '$hashed_password', admin=0";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['signup-success'] = 'Registration successful. Please login';
            header('location:http://localhost/petStudio/signin.php');
            die();
        } else {
            header('location:http://localhost/petStudio/signup.php ');
            die();
        }
    }
}
