<?php

require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM order_table WHERE post_id=$id ";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['delete-post-error'] = "Please check if all orders of the product have been delivered before deleting the product.";
        header('location:http://localhost/petStudio/admin-dashboard.php');
        die();
    } else {


        $query = "SELECT * FROM posts WHERE id=$id";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 1) {
            $post = mysqli_fetch_assoc($result);
            $thumbnail_name = $post['image'];
            $thumbnail_path = './images/' . $thumbnail_name;

            if (file_exists($thumbnail_path)) {
                unlink($thumbnail_path);
            }

            $delete_post_query = "DELETE FROM posts WHERE id=$id";
            $delete_post_result = mysqli_query($connection, $delete_post_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-post-success'] = "Post deleted successfully";
            }
        }
    }
}

header('location:http://localhost/petStudio/admin-dashboard.php');
die();
