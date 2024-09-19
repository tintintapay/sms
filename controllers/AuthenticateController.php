<?php

require_once 'models/User.php';
require_once 'models/UserInfo.php';
require_once 'requests/LoginRequest.php';

class AuthenticateController
{
    private $user;
    private $userInfo;
    private $messages;

    public function __construct()
    {
        $this->messages = require 'messages/messages.php';
        $this->user = new User();
        $this->userInfo = new UserInfo();
    }

    public function index()
    {
        include 'views/login.php';
    }

    public function store($request)
    {
        // Validate request
        $loginRequest = new LoginRequest();
        $flash = $loginRequest->validate($request);

        $email = Helper::sanitize($request['email']);
        $password = Helper::sanitize($request['password']);

        if (!$flash['isValid']) {
            return include 'views/login.php';
        }
        
        // Fetch user
        $user = $this->user->findUserByEmail($email);

        // Handle invalid or non-existent users
        if (!$user || !password_verify($password, $user['password'])) {
            $flash['message'] = $this->messages['invalid_login'];
            return include 'views/login.php';
        }

        // Check user status
        if ($user['status'] === UserStatus::PENDING) {
            $flash['message'] = $this->messages['invalid_pending_account'];
        } elseif ($user['status'] === UserStatus::DELETED || !$user['active']) {
            $flash['message'] = $this->messages['invalid_login'];
        } else {
            // Fetch user info and set session
            $authUser = $this->userInfo->findUserInfoByUserId($user['id']);
            if (!empty($authUser)) {
                $_SESSION = array_merge($user, $authUser);
                $_SESSION['full_name'] = $this->userInfo->getUserFullName($authUser['user_id']);
                $_SESSION['role'] = UserRole::getDescription($user['role']);
                $_SESSION['user_role'] = $user['role'];

                // Redirect based on role
                $this->redirectByRole($user['role']);
            }
        }

        include 'views/login.php';
    }

    // Redirect function based on role
    private function redirectByRole($role)
    {
        switch ($role) {
            case UserRole::ADMIN:
                Helper::redirect('admin/home');
                break;
            case UserRole::COORDINATOR:
                Helper::redirect('coordinator/home');
                break;
            default:
                Helper::redirect('athlete/home');
        }
    }

    public function logout()
    {
        session_destroy();
        Helper::redirect('index');
    }

}
