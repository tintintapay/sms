<?php

require_once 'models/User.php';
require_once 'core/Database.php';
require_once 'core/Helper.php';
require_once 'enums/Sport.php';
require_once 'models/UserInfo.php';
require_once 'enums/School.php';

class AthleteController
{
    private $user;
    private $userInfo;

    public function __construct()
    {
        $this->user = new User();
        $this->userInfo = new UserInfo();
    }
    public function index($params)
    {
        $athletes = $this->user->fetchAllAthleteWithInfo($params);

        $schools = School::fetchList();
        $sports = Sport::fetchList();

        $_SESSION['menu'] = 'manage_athlete';
        return include 'views/coordinator/manage-athlete.php';
    }

    public function show($params)
    {
        if (empty($params['id'])) {
            Helper::redirect('404-not-found');
        }

        $request = $this->user->getUser($params['id']);

        if (empty($request) || $request['role'] !== UserRole::ATHLETE) {
            Helper::redirect('404-not-found');
        }

        if ($request['status'] === UserStatus::DELETED) {
            Helper::redirect('404-not-found');
        }

        $athlete = $request;

        return include 'views/coordinator/athlete.php';
    }

    /**
     * Update athlete status to active or approve
     * 
     * @param mixed $request
     * @return void
     */
    public function store($request)
    {
        header('Content-Type: application/json');
        $res = $this->user->updateStatus($request['id'], UserStatus::ACTIVE);

        $user = $this->user->getUser($request['id']);

        $template = file_get_contents('template/account/approve.html');
        $body = str_replace('[Athlete_Name]', $user['full_name'], $template);
        $data = [
            'email' => $user['email'],
            'name' => $user['full_name'],
            'subject' => 'Account Notice',
            'body' => $body,
        ];

        Helper::sendMail($data);

        if (!$res) {
            echo json_encode(['success' => false]);
            exit();
        }

        echo json_encode(['success' => true]);
    }

    /**
     * Update athlete status to active or approve
     * 
     * @param mixed $request
     * @return void
     */
    public function delete($request)
    {
        header('Content-Type: application/json');
        $res = $this->user->updateStatus($request['id'], UserStatus::DELETED);

        $user = $this->user->getUser($request['id']);

        $template = file_get_contents('template/account/disapprove.html');
        $body = str_replace('[Athlete_Name]', $user['full_name'], $template);
        $data = [
            'email' => $user['email'],
            'name' => $user['full_name'],
            'subject' => 'Account Notice',
            'body' => $body,
        ];

        Helper::sendMail($data);

        if (!$res) {
            echo json_encode(['success' => false]);
            exit();
        }

        echo json_encode(['success' => true]);
    }

    public function target_athlete($request)
    {
        // Fetching data
        $sport = $request['sport'] ?? '';
        $start = $request['start'];
        $length = $request['length'];
        $search = $request['search']['value'] ?? $request['search'];


        $responseData = $this->user->fetchAthletesBySport($sport, $start, $length, $search);

        $response = [
            "draw" => intval($request['draw']),
            "recordsTotal" => $responseData['recordsTotal'],
            "recordsFiltered" => $responseData['recordsFiltered'],
            "data" => $responseData['data'],
        ];
        
        echo json_encode($response);

    }

    // Admin
    public function admin_index($params)
    {
        $athletes = $this->user->fetchAllAthleteWithInfo($params);

        $schools = School::fetchList();
        $sports = Sport::fetchList();

        $_SESSION['menu'] = 'manage_athlete';
        return include 'views/admin/manage-athlete.php';
    }
}