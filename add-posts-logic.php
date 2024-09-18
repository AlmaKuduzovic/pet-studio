<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category'];

    $thumbnail = $_FILES['thumbnail'];

    if (!$title) {
        $_SESSION['add-post'] = 'Enter post title!';
    } elseif (!$body) {
        $_SESSION['add-post'] = "Enter post description!";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select post category!";
    } elseif (!$price) {
        $_SESSION['add-post'] = "Select post price!";
    } else if (!is_numeric($price)) {
        $_SESSION['add-post'] = "Post price must be a number!";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choose post thumbnail!";
    } else {
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_temp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = './images/' . $thumbnail_name;

        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);

        if (in_array($extension, $allowed_files)) {
            if ($thumbnail['size'] < 2_000_000) {
                move_uploaded_file($thumbnail_temp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = 'File size is too big!';
            }
        } else {
            $_SESSION['add-post'] = 'File should be png, jpg, jpeg!';
        }
    }

    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location: http://localhost/petStudio/add-posts.php');
        die();
    } else {
        $query = "INSERT INTO posts (title, body, price, image, category_id) VALUES ('$title', '$body',$price, '$thumbnail_name', $category_id)";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $_SESSION['add-post-success'] = "New post added successfully";
            header('location: http://localhost/petStudio/admin-dashboard.php');
            die();
        } else {
            $_SESSION['add-post'] = "Error adding post: " . mysqli_error($connection);
            $_SESSION['add-post-data'] = $_POST;
            header('location:http://localhost/petStudio/add-posts.php');
            die();
        }
    }
}
