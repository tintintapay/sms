<?php
//Sample code

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
echo $_SESSION['user_id'];
echo $_SESSION['full_name'];
echo "Welcome to your home page!";
