<?php
require 'config/database.php';



session_destroy();

header('location:http://localhost/petStudio/index.php');
die();
