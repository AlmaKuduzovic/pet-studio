<?php

require 'config/database.php';

if (isset($_SESSION['user-id'])) {
    $id = $_SESSION['user-id'];
    $query = "SELECT * FROM users WHERE id=$id";
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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel=" stylesheet" href="http://localhost/petStudio/css/style1.css">
    <title>petStudio</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="http://localhost/petStudio/index.php">petStudio<i class='fas fa-paw' style='font-size:48px;color:black'></i></a>
        </div>
        <nav>
            <ul>
                <li><a href="http://localhost/petStudio/index.php">Home</a></li>
                <li><a href="http://localhost/petStudio/about.php">About</a></li>
                <li><a href="http://localhost/petStudio/sevices.php">Services</a></li>
                <li><a href="http://localhost/petStudio/contact.php">Contact</a></li>
                <li>
                    <button id="sbutton" type="button" class="search-btn"><i id="icon" class="fa fa-search"></i></button>
                </li>

                <form class="search-form">
                    <div class="search-container">
                        <input type="text" name="query" id="search" placeholder="Search...">
                        <button type="submit">Search</button>
                    </div>
                </form>

                <?php if (isset($_SESSION['user-id'])) : ?>
                    <li class="nav_profile">
                        <div class="avatar" id="ikona">
                            <i class="fa fa-user"></i>
                        </div>
                        <ul>
                            <li><a href="#"><?= $user['name'] ?></a></li>
                            <li><a href="http://localhost/petStudio/password.php?id=<?= $user['id'] ?>">Password</a></li>
                            <?php if (isset($_SESSION['user_is_admin'])) : ?>

                                <li><a href="http://localhost/petStudio/admin-dashboard.php">Admin Dashboard</a></li>
                                <li><a href="http://localhost/petStudio/allorders.php">Orders</a></li>

                            <?php else : ?>

                                <li><a href="http://localhost/petStudio/shoppingCart.php">My shopping cart</a></li>

                            <?php endif; ?>
                            <li><a href="http://localhost/petStudio/logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>

                    <li><a href="http://localhost/petStudio/signin.php">Sign In</a></li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>
</body>

</html>

<script>
    const searchBtn = document.querySelector('.search-btn');
    const searchForm = document.querySelector('.search-form');
    searchBtn.addEventListener('click', function() {
        searchForm.classList.toggle('show');
    });
</script>