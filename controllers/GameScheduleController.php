<?php

require_once 'models/User.php';
require_once 'models/GameSchedules.php';
require_once 'models/Evaluation.php';
require_once 'requests/GameSchedulesRequest.php';
require_once 'enums/GameStatus.php';
require_once 'core/Helper.php';

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
            $athletes = $this->user->fetchAllApprovedAthleteWithInfo();

            return include 'views/coordinator/game-schedules-create.php';
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
                'athlete_id' => $athlete
            ];
        }

        $res = $this->evaluation->upsertUser('evaluations', $evalData);

        Helper::redirect('game-schedules');
    }
}