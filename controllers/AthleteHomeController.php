<?php

require_once 'models/GameSchedules.php';
require_once 'enums/EvaluationStatus.php';

class AthleteHomeController
{
    private $gameScheds;

    public function __construct()
    {
        $this->gameScheds = new GameSchedules();
    }

    public function index()
    {
        $schedules = $this->gameScheds->fetchAthleteSchedule();

        include 'views/athlete/index.php';
    }
}