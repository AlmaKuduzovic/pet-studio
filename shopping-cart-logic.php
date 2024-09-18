<?php
require 'config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $quantity = $_POST['quantity'];



    $query = "INSERT INTO shopping_cart (post_id, user_id, quantity) VALUES ($post_id, $user_id, $quantity)";
    $result = mysqli_query($connection, $query);




    header('Location: http://localhost/petStudio/shoppingCart.php');
    die();
}
