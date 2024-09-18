<?php
require 'config/database.php';


if (!isset($_SESSION['user-id'])) {
    header('location:http://localhost/petStudio/signin.php');
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT *FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}

$oldpassword = $_SESSION['edit-pass-data']['oldpassword'] ?? null;
$newpassword = $_SESSION['edit-pass-data']['newpassword'] ?? null;
unset($_SESSION['edit-pass-data']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/petStudio/css/style4.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="/javascript/javascript2.js"></script>
    <title>Change Password</title>
</head>

<body>


    <header>
        <div class="logo">
            <a href="/index.php">petStudio<i class='fas fa-paw' style='font-size:48px;color:black'></i></a>
        </div>
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/about.php">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="contact.php">Contact</a></li>

                <ul>

                    <nav>
    </header>


    <form action="http://localhost/petStudio/password-logic.php" method="POST" onsubmit="return validate()">
        <h2>Change Password</h2>
        <?php if (isset($_SESSION['wrong'])) : ?>
            <div class="alert__message" id="error">
                <p>
                    <?= $_SESSION['wrong'];
                    unset($_SESSION['wrong'])
                    ?>
                </p>
            </div>
        <?php endif ?>
        <p id="error"></p>
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <label for="password">Old Password:</label>
        <input type="password" id="oldpassword" name="oldpassword" value="<?= $oldpassword ?>" required>
        <label for="password">New Password:</label>
        <input type="password" id="newpassword" name="newpassword" value="<?= $newpassword ?>" required>
        <label for="password">Repeat New Password:</label>
        <input type="password" id="rnewpassword" name="rnewpassword" required>
        <button type="submit">Change Password</button>
    </form>
</body>

</html>