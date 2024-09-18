
<?php


require './config/database.php';

$id = $_GET['id'];


$delete_item_query = "DELETE FROM shopping_cart WHERE id=$id";
$delete_item_result = mysqli_query($connection, $delete_item_query);

header('location:http://localhost/petStudio/shoppingCart.php');
die();
