<?php
include 'partials/header.php';



$user_id = filter_var($_SESSION['user-id']);

$query = "SELECT * FROM shopping_cart WHERE user_id=$user_id";
$result = mysqli_query($connection, $query);
$shoppingCart = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_id = $row['id'];
        $post_id = $row['post_id'];
        $quantity = $row['quantity'];
        $query2 = "SELECT *FROM posts WHERE id=$post_id";
        $result2 = mysqli_query($connection, $query2);
        $post = mysqli_fetch_assoc($result2);
        $post['cart_id'] = $cart_id;
        $post['quantity'] = $quantity;
        $shoppingCart[] = $post;
        $query1 = "INSERT INTO order_table (user_id, post_id, quantity, total) VALUES ($user_id, $post_id, {$post['quantity']}, {$post['price']} * {$post['quantity']})";
        $result1 = mysqli_query($connection, $query1);
    }
}



$query7 = "DELETE FROM shopping_cart WHERE user_id=$user_id";
mysqli_query($connection, $query7);

$_SESSION['order-success'] = 'Your order has been placed successfully!';


header('location:http://localhost/petStudio/shoppingcart.php');
die();
