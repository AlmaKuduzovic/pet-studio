<?php

include 'partials/header.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-KrqoYJtELEOgRJClQx0mKphqP3mDdXb/+vpsCkIZZ8d2L4AXb4sItvzfaWb1F+RRzCTT9TfttJhZgIBi8tEYw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="http://localhost/petStudio/css/style7.css">
</head>

<body>
    <div class="admin-dashboard">
        <h1>Add Category</h1>
        <form action="http://localhost/petStudio/add-category-logic.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="e.g. Cat" required>
            <br><br>
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
            <button type="submit" class="btn-add">Add</button>
        </form>
    </div>
</body>

</html>