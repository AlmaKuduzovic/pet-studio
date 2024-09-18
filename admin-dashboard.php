<?php

include 'partials/header.php';
if (!isset($_SESSION['user-id'])) {
    header('location:http://localhost/petStudio/signin.php');
    exit();
}

$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);

$query2 = "SELECT * FROM posts";
$posts = mysqli_query($connection, $query2);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Dashboard</title>
    <link rel="stylesheet" href="http://localhost/petStudio/css/style5.css">
</head>

<body>
    <div class="admin-dashboard">
        <h1>Admin Dashboard</h1>

        <?php if (isset($_SESSION['delete-post-error'])) : ?>
            <div class="success">
                <p id="message"> <?php echo $_SESSION['delete-post-error']; ?> </p>
            </div>
            <?php unset($_SESSION['delete-post-error']); ?>
        <?php endif; ?>

        <h2>Posts</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                <tbody>
                    <tr>
                        <td><?= $post['title'] ?></td>
                        <td>
                            <p> <?= substr($post['body'], 0, 50) ?>...</p>
                        </td>
                        <td><?= $post['price'] ?></td>
                        <td>
                            <a class="btn-edit" href="edit-post.php?id=<?= $post['id'] ?>">Edit</a>
                            <a class="btn-delete" href="delete-post.php?id=<?= $post['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile ?>

                </tbody>
        </table>
        <div class="actions">
            <a class="btn-add" href="http://localhost/petStudio/add-posts.php">Add Post</a>
        </div>

        <h2>Categories</h2>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <tr>
                        <td><?= $category['title'] ?></td>
                        <td>
                            <a class="btn-edit" href="http://localhost/petStudio/edit-category.php?id=<?= $category['id'] ?>">Edit</a>
                            <a class="btn-delete" href="http://localhost/petStudio/delete-category.php?id=<?= $category['id'] ?>">Delete</a>
                        </td>
                    </tr>



                <?php endwhile ?>


            </tbody>
        </table>
        <div class="actions">
            <a class="btn-add" href="http://localhost/petStudio/add-category.php">Add Category</a>
        </div>
    </div>
</body>

</html>