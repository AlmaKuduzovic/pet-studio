<?php
require 'config/database.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $hashed_new_password = password_hash($newpassword, PASSWORD_DEFAULT);

    $fetch_user_query = "SELECT * FROM users WHERE id=$id";
    $fetch_user_result = mysqli_query($connection, $fetch_user_query);

    $user_record = mysqli_fetch_assoc($fetch_user_result);
    $db_password = $user_record['password'];

    if (password_verify($oldpassword, $db_password)) {
        $query = "UPDATE users SET password='$hashed_new_password' WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $_SESSION['correct'] = "Password is changed successfully!";
        header('Location: http://localhost/petStudio/index.php');
        die();
    } else {
        $_SESSION['wrong'] = 'Old password is incorrect';
        $_SESSION['edit-pass-data'] = $_POST;
        header('Location:http://localhost/petStudio/password.php?id=' . $id);

        die();
    }
}
