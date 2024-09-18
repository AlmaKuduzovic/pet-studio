
<?php


require './config/database.php';

$id = $_GET['id'];


$delete_user_query = "DELETE FROM categories WHERE id=$id";
$delete_user_result = mysqli_query($connection, $delete_user_query);

header('location:http://localhost/petStudio/admin-dashboard.php');
die();
