<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pet_studio');

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306);

if (mysqli_errno($connection)) {

    die(mysqli_error($connection));
}
