<?php

include 'config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location:http://localhost/petStudio/signin.php');
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('location:http://localhost/petStudio/allorders.php');
    exit();
}


include 'partials/db.php';

$order_id = $_GET['id'];


$query = "DELETE FROM order_table WHERE id=$order_id";
$result = mysqli_query($connection, $query);


if ($result) {
    header('location:http://localhost/petStudio/allorders.php');
    exit();
} else {

    echo "Error deleting order. Please try again.";
}
