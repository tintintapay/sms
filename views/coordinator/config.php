<?php

require_once 'core/Helper.php';

if (!isset($_SESSION['user_id'])) {
    Helper::redirect('http://localhost/sms/logout');
    exit();
}

if ($_SESSION['user_role'] !== UserRole::COORDINATOR) {
    Helper::redirect('http://localhost/sms/404-not-found');
}
