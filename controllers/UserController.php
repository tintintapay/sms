<?php

require_once 'core/Helper.php';
require_once 'enums/UserRole.php';
require_once 'enums/UserStatus.php';
require_once 'enums/Sport.php';
require_once 'models/User.php';
require_once 'models/UserInfo.php';
require_once 'requests/RegisterRequest.php';
require_once 'enums/School.php';

class UserController
{
    private $user;
    private $userInfo;

    public function __construct()
    {
        $this->user = new User();
        $this->userInfo = new UserInfo();
    }

    public function index()
    {
        $sports = Sport::fetchList();
        $schools = School::fetchList();

        include 'views/register.php';
    }

    public function create($request)
    {
        $registerRequest = new RegisterRequest();
        $registerRequest->validate($request);

        // users data
        $userRequest = [
            'active' => 1,
            'role' => UserRole::ATHLETE,
            'email' => Helper::sanitize($request['email']),
            'password' => Helper::sanitize($request['password']),
            'status' => UserStatus::PENDING,
            'confirm_password' => Helper::sanitize($request['confirm_password']),
        ];

        // Insert to users table
        $userId = $this->user->insertUser($userRequest);


        // File Upload COR
        $cor_fileName = md5(uniqid(date('YmdHis'), true));
        $cor_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/docs/$userId/",
            'filename' => $cor_fileName,
            'file' => $_FILES['cor'],
            'allowed_types' => ['pdf', 'jpg', 'png'],
            'max_size' => 5000  // 5MB in kilobytes
        ]);

        // File Upload PSA
        $psa_fileName = md5(uniqid(date('YmdHis'), true));
        $psa_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/docs/$userId/",
            'filename' => $psa_fileName,
            'file' => $_FILES['psa'],
            'allowed_types' => ['pdf', 'jpg', 'png'],
            'max_size' => 5000  // 5MB in kilobytes
        ]);

        // File Upload MEDICAL CERTIFICATE
        $medc_fileName = md5(uniqid(date('YmdHis'), true));
        $medc_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/docs/$userId/",
            'filename' => $medc_fileName,
            'file' => $_FILES['medical_cert'],
            'allowed_types' => ['pdf', 'jpg', 'png'],
            'max_size' => 5000  // 5MB in kilobytes
        ]);

        // File Upload PICTURE
        $pic_fileName = md5(uniqid(date('YmdHis'), true));
        $pic_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/docs/$userId/",
            'filename' => $pic_fileName,
            'file' => $_FILES['picture'],
            'allowed_types' => ['pdf', 'jpg', 'png'],
            'max_size' => 5000  // 5MB in kilobytes
        ]);

        // user_info data
        $userInfoRequest = [
            'user_id' => $userId,
            'first_name' => Helper::sanitize($request['first_name']),
            'last_name' => Helper::sanitize($request['last_name']),
            'middle_name' => Helper::sanitize($request['middle_name']),
            'gender' => Helper::sanitize($request['gender']),
            'year_level' => Helper::sanitize($request['year_level']),
            'course' => Helper::sanitize($request['course']),
            'address' => Helper::sanitize($request['address']),
            'school' => Helper::sanitize($request['school']),
            'guardian' => Helper::sanitize($request['guardian']),
            'age' => Helper::getAge($request['birthday']),
            'birthday' => Helper::sanitize($request['birthday']),
            'sport' => Helper::sanitize($request['sport']),
            'phone_number' => Helper::sanitize($request['phone_number']),
            'cor' => $cor_result['file'],
            'psa' => $psa_result['file'],
            'medical_cert' => $medc_result['file'],
            'picture' => $pic_result['file'],
        ];

        // Insert to user_info table
        $this->userInfo->insertUserInfo($userInfoRequest);

        // Return to home page
        Helper::redirect('../index');
    }
}
