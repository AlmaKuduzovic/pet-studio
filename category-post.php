<?php
include 'partials/header.php';



if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id";
    $result = mysqli_query($connection, $query);
    $query1 = "SELECT * FROM categories WHERE id=$id";
    $result1 = mysqli_query($connection, $query1);
    $category_name = mysqli_fetch_assoc($result1);
} else {
    header('location:http://localhost/petStudio/index.php');
    die();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category-post</title>

    <link rel=" stylesheet" href="http://localhost/petStudio/css/style1.css">
</head>

<body>
    <div class="container_name">
        <h1 class="name"><?= $category_name['title'] ?></h1>
    </div>


    <div class="product-cards">
        <?php while ($post = mysqli_fetch_assoc($result)) : ?>
            <div class="product-card">
                <div class="product-image">
                    <img class="slika" src="./images/<?= $post['image'] ?>">
                </div>
                <div class="product-details">
                    <h3><?= $post['title'] ?></h3>
                    <p><?= substr($post['body'], 0, 150) ?>...</p>
                    <span class="price">$<?= $post['price'] ?></span>
                    <?php if (isset($_SESSION['user_is_user'])) : ?>
                        <button class="add-to-basket" onclick="addToBasket(<?= $post['id'] ?>)">Add to basket</button>


                    <?php elseif (isset($_SESSION['user_is_admin'])) : ?>
                        <button class="add-to-basket" onclick="toDashboard()">Go</button>

                    <?php else : ?>
                        <button class="add-to-basket" onclick="toSignIn()">Add to basket</button>

                    <?php endif; ?>
                </div>
            </div>

        <?php endwhile; ?>
    </div>


</body>

</html>
<script>
    function addToBasket(postId) {
        window.location.href = "http://localhost/petStudio/post.php?id=" + postId;
    }
</script>

<script>
    function toDashboard() {
        window.location.href = "http://localhost/petStudio/admin-dashboard.php";
    }
</script>