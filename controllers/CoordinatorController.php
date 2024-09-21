<?php

require_once 'requests/CoordinatorRequest.php';
require_once 'core/Helper.php';
require_once 'models/User.php';
require_once 'models/UserInfo.php';

class CoordinatorController
{
    private $user;
    private $userInfo;

    public function __construct()
    {
        $this->userInfo = new UserInfo();
        $this->user = new User();
    }

    public function index($param)
    {
        $coordinators = $this->user->getCoordinatorsWithInfo();
        $data = Helper::paginate($coordinators, 1);

        include 'views/admin/coordinators.php';
    }

    public function addnew($request)
    {
        include 'views/admin/coordinator-add.php';
    }

    public function create($request)
    {
        $coordinatorRequest = new CoordinatorRequest();
        $flash = $coordinatorRequest->validate($request);

        if (!$flash['isValid']) {
            return include 'views/admin/coordinator-add.php';
        }
        // users data
        $userData = [
            'active' => 1,
            'role' => UserRole::COORDINATOR,
            'email' => Helper::sanitize($request['email']),
            'password' => Helper::sanitize($request['password']),
            'status' => UserStatus::ACTIVE
        ];

        // Insert to users table
        $userId = $this->user->insertUser($userData);

        // File Upload PICTURE
        $pic_fileName = md5(uniqid(date('YmdHis'), true));
        $pic_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/docs/$userId/",
            'filename' => $pic_fileName,
            'file' => $_FILES['picture'],
            'allowed_types' => ['jpg', 'png'],
            'max_size' => 5000  // 5MB in kilobytes
        ]);

        if (!$pic_result['success']) {
            $flash = $pic_result;

            return include 'views/admin/coordinator-add.php';
        }

        $userInfoData = [
            'user_id' => $userId,
            'first_name' => Helper::sanitize($request['first_name']),
            'middle_name' => Helper::sanitize($request['middle_name']),
            'last_name' => Helper::sanitize($request['last_name']),
            'address' => Helper::sanitize($request['address']),
            'gender' => Helper::sanitize($request['gender']),
            'age' => Helper::sanitize($request['age']),
            'phone_number' => Helper::sanitize($request['phone_number']),
            'picture' => $pic_result['file'],
        ];

        $this->userInfo->insertCoordinator($userInfoData);

        Helper::redirect('coordinators');
    }

    public function show($params) {
        if (empty($params['id'])) {
            Helper::redirect('404-not-found');
        }

        $request = $this->user->getUser($params['id']);

        if (empty($request) || $request['role'] !== UserRole::COORDINATOR) {
            Helper::redirect('404-not-found');
        }

        return include 'views/admin/coordinator.php';
    }
}