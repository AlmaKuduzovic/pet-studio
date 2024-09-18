<?php
include './partials/header.php';
$query = "SELECT *FROM categories";
$categories = mysqli_query($connection, $query);
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['description'] ?? null;
$price = $_SESSION['add-post-data']['price'] ?? null;
unset($_SESSION['add-post-data']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post </title>
    <link rel=" stylesheet" href="http://localhost/petStudio/css/style6.css">
</head>

<body>

    <div class="admin-dashboard">
        <h1>Add Post</h1>
        <?php if (isset($_SESSION['add-post'])) : ?>
            <div class="error">

                <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post'])
                    ?>
                </p>
            </div>

        <?php endif ?>
        <form action="add-posts-logic.php" enctype="multipart/form-data" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder=" e.g. 2-in-1 Food & Water Dispenser" value="<?= $title ?>">
            <br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Enter a detailed description of your product, including its features, benefits, and any important information customers should know."><?= $body ?></textarea>

            <br>
            <label for="category">Category:</label>
            <select name="category">
                <option value="" selected disabled>Select category</option>
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <br>
            <label for="price">Price: $</label>
            <input type="text" id="price" name="price" placeholder="e.g.19.90" value="<?= $price ?>">
            <br>
            <label for="image">Image:</label>
            <input type="file" id="thumbnail" name="thumbnail">
            <br><br>
            <button type="submit" class="btn-add">Add</button>
        </form>
    </div>


</body>

</html>