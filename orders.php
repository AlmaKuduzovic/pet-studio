<?php
require 'config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];



    $query = "INSERT INTO order_table (post_id, user_id) VALUES ($post_id, $user_id)";
    $result = mysqli_query($connection, $query);



    header('Location: http://localhost/petStudio/shoppingCart.php');
    die();
}
