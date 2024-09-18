<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $title = $_POST['title'];
    $icon = $_POST['icon'];



    $query = "INSERT INTO categories (title, icon) VALUES ('$title', '$icon')";
    $result = mysqli_query($connection, $query);



    header('Location: http://localhost/petStudio/admin-dashboard.php');
    exit;
}
