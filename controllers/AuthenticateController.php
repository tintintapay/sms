<?php

require_once 'models/User.php';
require_once 'models/UserInfo.php';
require_once 'requests/LoginRequest.php';
require_once 'requests/ResetPasswordRequest.php';

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
        } elseif ($user['status'] === UserStatus::DELETED || $user['status'] === UserStatus::INACTIVE) {
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

    public function forgot_password_index()
    {
        include 'views/forgot-password.php';
    }

    public function forgot_pass_store($request)
    {
        $email = Helper::sanitize($request['email']);

        $user = $this->user->findUserByEmail($email);
        if (!$user) {
            $flash['message'] = "Email doesn't exist.";

            return include 'views/forgot-password.php';
        }

        // set 6 digit code
        $code = mt_rand(100000, 999999);

        // Save code to database
        $codeData = [
            'code' => $code,
            'email' => $email,
        ];
        $saveCode = $this->user->insertResetCode($codeData);

        // Send code to email
        $template = file_get_contents('template/auth/forgot-password.html');
        $body = str_replace('[user_name]', $user['full_name'], $template);
        $body = str_replace('[code]', $code, $body);

        $data = [
            'email' => $user['email'],
            'name' => $user['full_name'],
            'subject' => 'Sportan Password Reset Code',
            'body' => $body,
        ];


        // Send mail
        $send = Helper::sendMail($data);

        $encryptEmail = Helper::encryptEmail($email);

        if ($send) {
            Helper::redirect("password-reset-validate?token=$encryptEmail");
        }
    }

    public function password_reset_validate($params)
    {
        $token = $params['token'];

        $email = Helper::decryptEmail($token);
        $user = $this->user->findUserByEmail($email);

        if (!$user) {
            Helper::redirect('404-not-found');
        }
        $email = "";

        $startDate = $user['updated_at'];

        include 'views/password-reset-validate.php';
    }

    public function password_reset_validate_store($request)
    {
        $token = $request['token'];

        $email = Helper::decryptEmail($token);
        $user = $this->user->findUserByEmail($email);

        $startDate = $user['updated_at'];

        if (!$user) {
            Helper::redirect('404-not-found');
        }

        // Validate request
        $loginRequest = new ResetPasswordRequest();
        $flash = $loginRequest->validate($request);

        if (!$flash['isValid']) {
            return include 'views/password-reset-validate.php';
        }

        // if wrong code
        if ($request['code'] !== $user['code']) {
            $flash['message'] = "Wrong Password Reset code";
            return include 'views/password-reset-validate.php';
        }

        if (Helper::isExpired($user['updated_at'], 5)) {
            $flash['message'] = "Expired Password Reset code";
            return include 'views/password-reset-validate.php';
        }

        $data = [
            'password' => $request['password'],
            'id' => $user['id']
        ];

        $updatePassword = $this->user->updatePassword($data);

        if ($updatePassword) {
            return include 'views/password-reset-complete.php';
        }

        $flash['message'] = "Internal Server Error! Unable to save your password";
        
        return include 'views/password-reset-validate.php';
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
