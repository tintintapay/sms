<?php

require_once 'core/Helper.php';

if (isset($_SESSION['user_id'])) {
    switch ($_SESSION['user_role']) {
        case UserRole::ADMIN:
            Helper::redirect('admin/home');
            break;
        case UserRole::COORDINATOR:
            Helper::redirect('coordinator/home');
            break;
        default:
            Helper::redirect('athlete/home');
    }
    exit();
}