<?php

require 'config/database.php';

$name = $_SESSION['signup-data']['name'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

unset($_SESSION['signup-data']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/petStudio/css/style4.css">
    <script src="/javascript/javascript.js"></script>
    <title>Sign Up</title>
</head>

<body>
    <form action="/signup-logic.php" method="POST" onsubmit="return validate();">
        <h2>Sign Up</h2>


        <?php if (isset($_SESSION['signup-error'])) : ?>
            <div class="alert__message">
                <p>
                    <?= $_SESSION['signup-error'];

                    unset($_SESSION['signup-error']);
                    ?>
                </p>
            </div>
        <?php endif ?>



        <p id="error"></p>
        <label for=" username">Name:</label>
        <input type="text" id="name" name="name" value="<?= $name ?>">
        <label for="username">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="<?= $lastname ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= $username ?>">
        <label for="username">E-mail:</label>
        <input type="text" id="email" name="email" value="<?= $email ?>">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= $password ?>">
        <label for="password">Confirm Password:</label>
        <input type="password" id="confirmpassword" name="confirmpassword" value="<?= $confirmpassword ?>">
        <button type="submit">Sign Up</button>
        <small id="noAccount">Do you have an account? <a href="http://localhost/petStudio/signin.php" id="signin"> Sign In</a></small>
    </form>
</body>