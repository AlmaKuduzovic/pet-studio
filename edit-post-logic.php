<?php

require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $body = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category'];

    $thumbnail = $_FILES['thumbnail'];

    if (!$title) {
        $_SESSION['edit-post'] = 'Enter post title';
    } elseif (!$category_id) {
        $_SESSION['edit-post'] = "Select post category";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Enter post body";
    } elseif (!$thumbnail['name']) {
        $_SESSION['edit-post'] = "Choose post thumbnail";
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

                $query = "SELECT image FROM posts WHERE id = $id LIMIT 1";
                $result = mysqli_query($connection, $query);
                $post = mysqli_fetch_assoc($result);
                $current_image_name = $post['image'];

                if ($current_image_name && file_exists("./images/$current_image_name")) {
                    unlink("./images/$current_image_name");
                }


                move_uploaded_file($thumbnail_temp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['edit-post'] = 'File size is too big';
            }
        } else {
            $_SESSION['edit-post'] = 'File should be png, jpg, jpeg';
        }
    }

    if (isset($_SESSION['edit-post'])) {
        $_SESSION['edit-post-data'] = $_POST;
        header('location:http://localhost/petStudio/ edit-post.php?id=' . $id);
        die();
    } else {
        $query = "UPDATE posts SET title = '$title', body = '$body', price = $price, image = '$thumbnail_name', category_id = $category_id WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $_SESSION['edit-post-success'] = "Post updated successfully";
            header('location: http://localhost/petStudio/admin-dashboard.php');
            die();
        } else {
            $_SESSION['edit-post'] = "Error updating post: " . mysqli_error($connection);
            $_SESSION['edit-post-data'] = $_POST;
            header('location: http://localhost/petStudio/edit-post.php?id=' . $id);
            die();
        }
    }
}
