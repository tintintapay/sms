<?php
session_start();
require_once '../core/Helper.php';
require_once '../models/User.php';
require_once '../core/Database.php';

$config = require '../config.php';
$db = new Database($config);
$userModel = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = Helper::sanitize($_POST['username']);
    $password = Helper::sanitize($_POST['password']);

    $user = $userModel->findUserByUserName($username);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        $authUser = $userModel->findUserById($user['id']);
        if (!empty($authUser)) {
            $_SESSION['full_name'] = $authUser['full_name'];
            $_SESSION['role'] = $authUser['role'];
        }

        Helper::redirect('../home');
    } else {
        echo "Invalid login details";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['logout'])) {
        session_start();
        session_destroy();

        Helper::redirect('../login');

        exit();
    }
}
