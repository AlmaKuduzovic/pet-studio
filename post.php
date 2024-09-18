<?php

include 'partials/header.php';



if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $query = "SELECT * FROM posts WHERE  id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location:http://localhost/petStudio/index.php ');
    die();
}
if (isset($_SESSION['user-id'])) {
    $user_id = $_SESSION['user-id'];
    $query = "SELECT * FROM users WHERE id=$user_id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post</title>
    <link rel=" stylesheet" href="http://localhost/petStudio/css/style8.css">
</head>

<body>



    <section class="singlepost">
        <div class="container singlepost_container">
            <h2><?= $post['title'] ?></h2>
            <div class="singlepost_content">
                <div class="singlepost_image">
                    <img src="./images/<?= $post['image'] ?>">
                </div>
                <div class="singlepost_body">
                    <p><?= $post['body'] ?></p>
                    <p class="price">$ <?= $post['price'] ?></p>
                    <br>

                    <form method="POST" action="http://localhost/petStudio/shopping-cart-logic.php">
                        <?php if (isset($_SESSION['user_is_user'])) : ?>
                            <label id="quntity" for="quantity"><strong>Quantity:</strong></label>

                            <td><input type="number" min="1" value="1" class="quantity-input" name="quantity"></td>

                        <?php elseif (isset($_SESSION['user_is_admin'])) : ?>


                        <?php else : ?>


                        <?php endif; ?>
                </div>



                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id ?>">
                <input type="hidden" id="post_id" name="post_id" value="<?= $id ?>">
                <br>
                <br>

                <?php if (isset($_SESSION['user_is_user'])) : ?>
                    <button class="add-to-basket">Add to basket</button>




                <?php else : ?>


                <?php endif; ?>
                </form>
            </div>
        </div>
        </div>
    </section>
</body>

</html>

<script>
    function toDashboard() {
        window.location.href = "http://localhost/petStudio/admin-dashboard.php";
    }
</script>