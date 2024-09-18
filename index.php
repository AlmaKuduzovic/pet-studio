<?php

include 'partials/header.php';


if (isset($_SESSION['user-id'])) {
    $id = $_SESSION['user-id'];
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}


?>

<?php if (isset($_SESSION['user-id'])) : ?>
    <div="welcomeContainer">
        <h2 class="welcome">Welcome, <?= $user['name'] ?> !</h2>
        </div>
    <?php endif ?>

    <?php if (isset($_SESSION['correct'])) : ?>
        <div class="success">
            <p> <?= $_SESSION['correct'] ?></p>
            <?php unset($_SESSION['correct']) ?>
        </div>
    <?php endif ?>

    <?php
    $query = "SELECT *FROM posts";
    $posts = mysqli_query($connection, $query);

    ?>


    <div class="button-container">


        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);

        ?>

        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <?php $icon_class = 'fas fa-' . $category['icon']; ?>
            <a class="button" href="http://localhost/petStudio/category-post.php?id=<?= $category['id'] ?>" class="category_button">
                <i class="<?= $icon_class ?>"></i>
                <?= $category['title'] ?>
            </a>
        <?php endwhile ?>

    </div>


    <div class="product-cards">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <div class="product-card">
                <img src="./images/<?= $post['image'] ?>" alt="Product 1">
                <h3> <a id="title1" href="http://localhost/petStudio/post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?> </a></h3>
                <p> <?= substr($post['body'], 0, 50) ?>...
                </p>
                <span class="price">$<?= $post['price'] ?></span>
                <?php if (isset($_SESSION['user_is_user'])) : ?>
                    <button class="add-to-basket" onclick="addToBasket(<?= $post['id'] ?>)">Add to basket</button>

                <?php elseif (isset($_SESSION['user_is_admin'])) : ?>
                    <button class="add-to-basket" onclick="toDashboard()">Go</button>

                <?php else : ?>
                    <button class="add-to-basket" onclick="toSignIn()">Add to basket</button>

                <?php endif; ?>
            </div>

        <?php endwhile; ?>
    </div>


    <?php

    include 'partials/footer.php';

    ?>

    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".product-cards .product-card").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script>
        function addToBasket(postId) {
            window.location.href = "http://localhost/petStudio/post.php?id=" + postId;
        }
    </script>


    <script>
        function toSignIn() {
            window.location.href = "http://localhost/petStudio/signin.php";
        }
    </script>


    <script>
        function toDashboard() {
            window.location.href = "http://localhost/petStudio/admin-dashboard.php";
        }
    </script>