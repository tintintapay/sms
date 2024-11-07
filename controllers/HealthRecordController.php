<?php

require_once 'models/User.php';
require_once 'enums/UserStatus.php';
require_once 'models/HealthRecord.php';
require_once 'enums/HealthStatus.php';
require_once 'requests/HealthRecordCreateRequest.php';

class HealthRecordController
{
    private $user;
    private $record;

    public function __construct()
    {
        $this->user = new User();
        $this->record = new HealthRecord();
    }

    public function index($params)
    {
        $_SESSION['menu'] = 'health-records';

        $params['status'] = UserStatus::ACTIVE;

        $athletes = $this->user->fetchAllAthleteWithInfo($params);

        include 'views/coordinator/health-records.php';
    }

    public function details($params)
    {
        $_SESSION['menu'] = 'health-records';

        $params['status'] = UserStatus::ACTIVE;
        $records = $this->record->fetchRecords($params['id']);

        $athlete = $this->user->getUser($params['id']);

        include 'views/coordinator/athlete-health-records.php';
    }

    public function create($params)
    {
        if (!$params) {
            Helper::redirect('404-not-found');
        }

        $_SESSION['menu'] = 'health-records';
        $healthStatus = HealthStatus::fetchList();

        include 'views/coordinator/athlete-health-record-create.php';
    }

    public function store($request)
    {
        $params = $request;

        // Validate request
        $recordRequest = new HealthRecordCreateRequest();
        $flash = $recordRequest->validate($request);

        // Return errors
        if (!$flash['isValid']) {
            $healthStatus = HealthStatus::fetchList();

            return include 'views/coordinator/athlete-health-record-create.php';
        }

        $data = [
            'athlete_id' => $request['athlete_id'],
            'status' => $request['status'],
            'remarks' => $request['remarks']
        ];

        $insert = $this->record->insert($data);

        if (!$insert) {
            $flash['message'] = $insert;

            return include 'views/coordinator/athlete-health-record-create.php';
        }

        Helper::redirect('athlete-health-records?id='.$params['athlete_id']);
    }
}