<?php

require_once 'models/User.php';
require_once 'models/GameSchedules.php';

class GameScheduleController
{
    private $user;
    private $gameScheds;

    public function __construct()
    {
        $this->user = new User();
        $this->gameScheds = new GameSchedules();
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
}