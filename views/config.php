<?php

require_once __DIR__ . '/core/Helper.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    Helper::redirect('login.php');
    exit();
}