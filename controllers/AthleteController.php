<?php

require_once 'models/User.php';

class AthleteController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function index()
    {
        $athletes = $this->user->getAthleteWithInfo();

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

        $athlete = $request;

        return include 'views/coordinator/athlete.php';
    }

    public function store($request)
    {
        header('Content-Type: application/json');
        $res = $this->user->updateStatus($request['id'], UserStatus::ACTIVE);

        if (!$res) {
            echo json_encode(['success' => false]);
            exit();
        }

        echo json_encode(['success' => true]);
    }
}