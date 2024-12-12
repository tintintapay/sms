<?php

require_once 'models/User.php';
require_once 'models/GameSchedules.php';
require_once 'models/Evaluation.php';
require_once 'requests/GameSchedulesRequest.php';
require_once 'enums/GameStatus.php';
require_once 'core/Helper.php';
require_once 'enums/EvaluationStatus.php';

class GameScheduleController
{
    private $user;
    private $gameScheds;
    private $evaluation;

    public function __construct()
    {
        $this->user = new User();
        $this->gameScheds = new GameSchedules();
        $this->evaluation = new Evaluation();
    }

    public function index($params)
    {
        $data = [];

        if (!empty($params['sport']) && $params['sport'] !== '') {
            $data['sport'] = $params['sport'];
        }

        $gameScheds = $this->gameScheds->fetchAll($data);
        $sports = Sport::fetchList();

        $_SESSION['menu'] = 'game_event';
        include 'views/coordinator/game-schedules.php';
    }

    public function create($request)
    {
        $sports = Sport::fetchList();
        $athletes = $this->user->fetchAllApprovedAthleteWithInfo();

        $scheduleDate = new DateTime(date('Y-m-d'));
        $date = (clone $scheduleDate)->modify('+7 days');
        $minimumDate = $date->format('Y-m-d');

        return include 'views/coordinator/game-schedules-create.php';
    }

    public function store($request)
    {
        // Validate request
        $loginRequest = new GameSchedulesRequest();
        $flash = $loginRequest->validate($request);

        // Return errors
        if (!$flash['isValid']) {
            $sports = Sport::fetchList();
            // $athletes = $this->user->fetchAllApprovedAthleteWithInfo();

            return include 'views/coordinator/game-schedules-create.php';
        }

        // schedule file name 
        $pic_fileName = md5(uniqid());
        $fileType = strtolower(pathinfo($_FILES["schedule_picture"]["name"], PATHINFO_EXTENSION));
        $fileName = "$pic_fileName.$fileType";

        $gameData = [
            'game_title' => Helper::sanitize($request['game_title']),
            'schedule' => Helper::sanitize($request['schedule']),
            'sport' => Helper::sanitize($request['sport']),
            'venue' => Helper::sanitize($request['venue']),
            'status' => isset($request['status']) ? GameStatus::ACTIVE : GameStatus::INACTIVE,
            'created_user' => $_SESSION['user_id'],
            'schedule_picture' => $fileName,
        ];

        $gameId = $this->gameScheds->insertSchedule($gameData);

        // File Upload PICTURE
        $pic_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/game_sched/$gameId/",
            'filename' => $pic_fileName,
            'file' => $_FILES['schedule_picture'],
            'allowed_types' => ['jpg', 'png'],
            'max_size' => 5000  // 5MB in kilobytes
        ]);

        $evalData = [];
        $athletes = array_map('intval', $request['athletes']);
        foreach ($athletes as $athlete) {
            $evalData[] = [
                'game_schedules_id' => $gameId,
                'athlete_id' => $athlete,
                'status' => EvaluationStatus::PENDING
            ];
        }

        $res = $this->evaluation->upsertUser('evaluations', $evalData);

        Helper::redirect('game-schedules?saved=1');
    }

    public function show($params)
    {
        $sports = Sport::fetchList();
        $game = $this->gameScheds->findById($params['id']);

        if (empty($game) || $game['deleted_at'] !== null) {
            Helper::redirect('404-not-found');
        }

        $selectedAthlete = $this->evaluation->findAllByGameId($params['id']);
        $athletes = [];
        foreach ($selectedAthlete as $selected) {
            array_push($athletes, $selected['athlete_id']);
        }

        $scheduleDate = new DateTime(date('Y-m-d'));
        $date = (clone $scheduleDate)->modify('+7 days');
        $minimumDate = $date->format('Y-m-d');

        return include 'views/coordinator/game-schedule.php';
    }

    public function update($request)
    {
        $gameId = $request['id'];

        $gameData = $this->gameScheds->findById($gameId);

        // Validate request
        $loginRequest = new GameSchedulesRequest();
        $flash = $loginRequest->validate($request);

        // athlete from array
        $athletes = array_map('intval', $request['athletes'] ?? []);

        // page data
        $sports = Sport::fetchList();
        $_GET['id'] = $gameId;

        // Return errors
        if (!$flash['isValid']) {
            return include 'views/coordinator/game-schedule.php';
        }

        // athlete from database
        $evaluationAthlete = $this->evaluation->findAllByGameId($gameId, true);
        $savedAthlete = [];
        $savedEvalId = [];
        foreach ($evaluationAthlete as $selected) {
            array_push($savedAthlete, $selected['athlete_id']);
            array_push($savedEvalId, $selected['id']);
        }

        $gameSchedData = [
            'game_title' => Helper::sanitize($request['game_title']),
            'schedule' => Helper::sanitize($request['schedule']),
            'sport' => Helper::sanitize($request['sport']),
            'venue' => Helper::sanitize($request['venue']),
            'status' => isset($request['status']) ? GameStatus::ACTIVE : GameStatus::INACTIVE,
        ];

        if ($_FILES['schedule_picture']['size'] !== 0) {

            if ($gameData['schedule_picture'] !== '') {
                $file = "./assets/uploads/game_sched/$gameId/" . $gameData['schedule_picture'];

                if (file_exists($file)) {
                    unlink($file);
                }
            }

            // schedule file name 
            $pic_fileName = md5(uniqid());
            $fileType = strtolower(pathinfo($_FILES["schedule_picture"]["name"], PATHINFO_EXTENSION));
            $fileName = "$pic_fileName.$fileType";

            // File Upload PICTURE
            $pic_result = Helper::fileUpload([
                'target_dir' => "assets/uploads/game_sched/$gameId/",
                'filename' => $pic_fileName,
                'file' => $_FILES['schedule_picture'],
                'allowed_types' => ['jpg', 'png'],
                'max_size' => 5000  // 5MB in kilobytes
            ]);

            if ($_FILES['schedule_picture']['size'] !== 0) {
                $gameSchedData['schedule_picture'] = $fileName;
            }

            if (!$pic_result['success']) {
                $flash = $pic_result;

                return include 'views/coordinator/game-schedule.php';
            }
        }

        $updateGameSched = $this->gameScheds->updateSchedule($gameId, $gameSchedData);

        // Remove athlete
        $removed = array_diff($savedAthlete, $request['athletes']);
        $removedAthlete = array_map('intval', $removed);

        if (!empty($removedAthlete)) {
            $evalData = [
                'deleted_at' => date('Y-m-d H:i:s')
            ];

            $this->evaluation->updateDeleteWhereIn($evalData, ['column' => 'athlete_id', 'athletes' => $removedAthlete]);
        }

        // Added athlete
        $added = array_diff($request['athletes'], $savedAthlete);
        $addedAthlete = array_map('intval', $added);

        if (!empty($addedAthlete)) {
            $evalData = [];
            foreach ($addedAthlete as $athlete) {
                $evalData[] = [
                    'game_schedules_id' => $gameId,
                    'athlete_id' => $athlete,
                    'deleted_at' => null
                ];
            }

            $insert = $this->evaluation->upsertUser('evaluations', $evalData);
        }

        // Update Athlete
        $evalData = [
            'deleted_at' => null
        ];

        $this->evaluation->updateDeleteWhereIn($evalData, ['column' => 'athlete_id', 'athletes' => $athletes]);

        $game = $this->gameScheds->findById($request['id']);
        // return to view page
        return include 'views/coordinator/game-schedule.php';
    }

    public function delete($request)
    {
        header('Content-Type: application/json');
        $res = $this->gameScheds->delete($request['id']);

        if (!$res) {
            echo json_encode(['success' => false]);
            exit();
        }

        echo json_encode(['success' => true]);
    }

    public function schedule($params)
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        ;
        $gameId = $params['id'];
        $file = $params['file'];
        $img = "$url/assets/uploads/game_sched/$gameId/$file";

        include 'views/athlete/game_schedule.php';
    }
}