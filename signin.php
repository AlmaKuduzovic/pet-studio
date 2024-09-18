<?php

require 'config/database.php';

$username_email = $_SESSION['signin-data']['username'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data'])
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/petStudio/css/style4.css">
    <script src="/javascript/javascript.js"></script>
    <title>Sign In</title>
</head>

<body>
    <form action="http://localhost/petStudio/signin-logic.php" method="POST">
        <h2>Sign In</h2>
        <?php if (isset($_SESSION['signup-success'])) : ?>
            <div class="success">
                <p>

                    <?= $_SESSION['signup-success'];
                    unset($_SESSION['signup-success'])
                    ?>

                </p>
            </div>
        <?php elseif (isset($_SESSION['signin'])) : ?>
            <div class="alert__message">
                <p>

                    <?= $_SESSION['signin'];
                    unset($_SESSION['signin']) ?>

                </p>
            </div>
        <?php endif ?>





        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= $username_email ?>">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= $password ?>">

        <button type="submit">Sign in</button>
        <small id="noAccount">Do you do not have an account? <a href="http://localhost/petStudio/signup.php " id="signin"> Sign Up</a></small>
    </form>
</body>