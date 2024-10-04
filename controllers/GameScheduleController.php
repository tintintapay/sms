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

    public function index()
    {
        $gameScheds = $this->gameScheds->fetchAll();

        include 'views/coordinator/game-schedules.php';
    }

    public function create($request)
    {
        $sports = Sport::fetchList();
        $athletes = $this->user->fetchAllApprovedAthleteWithInfo();

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

            return include 'views/coordinator/game_schedules-create.php';
        }

        $gameData = [
            'game_title' => $request['game_title'],
            'schedule' => $request['schedule'],
            'sport' => $request['sport'],
            'status' => isset($request['status']) ? GameStatus::ACTIVE : GameStatus::INACTIVE,
            'created_user' => $_SESSION['user_id']
        ];

        $gameId = $this->gameScheds->insertSchedule($gameData);

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

        Helper::redirect('game-schedules');
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

        return include 'views/coordinator/game-schedule.php';
    }

    public function update($request)
    {
        $game = $this->gameScheds->findById($request['id']);
        $gameId = $request['id'];

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
            'game_title' => $request['game_title'],
            'schedule' => $request['schedule'],
            'sport' => $request['sport']
        ];

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
}