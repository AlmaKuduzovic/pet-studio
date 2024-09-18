<?php
require 'config/database.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $icon = $_POST['icon'];
    $query = "UPDATE categories SET title='$title', icon='$icon' WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        header('location:http://localhost/petStudio/admin-dashboard.php');
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}
