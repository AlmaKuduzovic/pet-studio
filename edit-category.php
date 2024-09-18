<?php
include './partials/header.php';
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category </title>
    <link rel=" stylesheet" href="http://localhost/petStudio/css/style7.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



</head>

<body>

    <div class="admin-dashboard">
        <h1>Edit Category</h1>
        <form action="http://localhost/petStudio/edit-category-logic.php" method="POST">
            <input type="hidden" id="id" name="id" value="<?= $id ?>">
            <label for=" title">New title:</label>
            <input type="text" id="title" name="title" required>

            <label for="icon">Please verify the icon that matches your title.</label>
            <label><input type="checkbox" name="icon" value="cat"><i class="fas fa-cat"></i> Cat</label>
            <br>
            <label><input type="checkbox" name="icon" value="dog"><i class="fas fa-dog"></i> Dog</label>
            <br>
            <label><input type="checkbox" name="icon" value="dove"><i class="fas fa-dove"></i> Dove</label>
            <br>
            <label><input type="checkbox" name="icon" value="fish"><i class="fas fa-fish"></i> Fish</label>
            <br>
            <label><input type="checkbox" name="icon" value="frog"><i class="fas fa-frog"></i> Frog</label>
            <br>
            <label><input type="checkbox" name="icon" value="horse"><i class="fas fa-horse"></i> Horse</label>
            <br>

            <label><input type="checkbox" name="icon" value="otter"><i class="fas fa-otter"></i> Reptile</label>
            <br><br>
            <button type="submit" name="submit" class="btn-add">Update</button>
        </form>
    </div>


</body>

</html>