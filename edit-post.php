<?php include './partials/header.php';

$id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id=$id";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['add-post'] = 'Post not found';
    header('location:http://localhost/petStudio/ admin-dashboard.php');
    die();
}

$post = mysqli_fetch_assoc($result);

$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="http://localhost/petStudio/css/style6.css">
</head>

<body>
    <div class="admin-dashboard">
        <h1>Edit Post</h1>

        <?php if (isset($_SESSION['edit-post'])) : ?>
            <p class="error"><?= $_SESSION['edit-post'] ?></p>
            <?php unset($_SESSION['edit-post']); ?>
        <?php endif; ?>

        <form action="http://localhost/petStudio/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" id="id" name="id" value="<?= $id ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= $post['title'] ?>">
            <br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?= $post['body'] ?></textarea>
            <br>
            <select name="category">
                <option value="" selected disabled>Select category</option>
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <br>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?= $post['price'] ?>">
            <br>
            <label for="thumbnail">Thumbnail:</label>
            <input type="file" id="thumbnail" name="thumbnail">
            <?php if ($post['image']) : ?>
                <img src="./images/<?= $post['image'] ?>" alt="Thumbnail" width="100">
            <?php endif; ?>
            <br><br>
            <button type="submit" class="btn-add">Update</button>
        </form>
    </div>
</body>

</html>