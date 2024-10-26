<?php

require_once 'requests/CoordinatorRequest.php';
require_once 'requests/CoordinatorUpdateRequest.php';
require_once 'core/Helper.php';
require_once 'models/User.php';
require_once 'models/UserInfo.php';
require_once 'core/Validation.php';

class CoordinatorController
{
    private $user;
    private $userInfo;

    public function __construct()
    {
        $this->userInfo = new UserInfo();
        $this->user = new User();
    }

    /**
     * List of coordinator
     * @param mixed $param
     * @return void
     */
    public function index($param)
    {
        $coordinators = $this->user->getCoordinatorsWithInfo();

        $_SESSION['menu'] = 'coordinators';
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

    public function show($params)
    {
        if (empty($params['id'])) {
            Helper::redirect('404-not-found');
        }

        $request = $this->user->getUser($params['id']);

        if (empty($request) || $request['role'] !== UserRole::COORDINATOR) {
            Helper::redirect('404-not-found');
        }

        return include 'views/admin/coordinator.php';
    }

    public function update($request)
    {
        $coordinator = $this->user->getUser($request['id']);
        $request['user_id'] = $coordinator['user_id'];
        $request['full_name'] = $coordinator['full_name'];

        $coordinatorRequest = new CoordinatorUpdateRequest();
        $flash = $coordinatorRequest->validate($request);

        if (!$flash['isValid']) {
            return include 'views/admin/coordinator.php';
        }

        // users data
        $userData = [
            'id' => $request['id'],
            'active' => 1,
            'role' => UserRole::COORDINATOR,
            'email' => Helper::sanitize($request['email']),
            'password' => Helper::sanitize($request['password']),
            'status' => isset($request['status']) ? UserStatus::ACTIVE : UserStatus::INACTIVE,
        ];

        if (!empty($request['password'])) {
            $userData['password'] = Helper::sanitize($request['password']);
        }

        // update to users table
        $this->user->update($userData);

        if ($_FILES['picture']['size'] !== 0) {

            $file = "./assets/uploads/docs/" . $coordinator['user_id'] . "/" . $coordinator['picture'];

            if (file_exists($file)) {
                unlink($file);
            }

            // File Upload PICTURE
            $pic_fileName = md5(uniqid(date('YmdHis'), true));
            $pic_result = Helper::fileUpload([
                'target_dir' => "assets/uploads/docs/". $coordinator['user_id'] ."/",
                'filename' => $pic_fileName,
                'file' => $_FILES['picture'],
                'allowed_types' => ['jpg', 'png'],
                'max_size' => 5000  // 5MB in kilobytes
            ]);

            if (!$pic_result['success']) {
                $flash = $pic_result;

                return include 'views/admin/coordinator.php';
            }
        }

        $userInfoData = [
            'user_id' => $coordinator['user_id'],
            'first_name' => Helper::sanitize($request['first_name']),
            'middle_name' => Helper::sanitize($request['middle_name']),
            'last_name' => Helper::sanitize($request['last_name']),
            'address' => Helper::sanitize($request['address']),
            'gender' => Helper::sanitize($request['gender']),
            'age' => Helper::sanitize($request['age']),
            'phone_number' => Helper::sanitize($request['phone_number']),
        ];

        if ($_FILES['picture']['size'] !== 0) {
            $userInfoData['picture'] = $pic_result['file'];
        }
        
        $this->userInfo->updateCoordinator($userInfoData);
        $coordinator = $this->user->getUser($request['id']);
        $request['status'] = $coordinator['status'];
        return include 'views/admin/coordinator.php';
    }
}