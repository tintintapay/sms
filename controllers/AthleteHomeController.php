<?php

require_once 'models/GameSchedules.php';
require_once 'enums/EvaluationStatus.php';
require_once 'models/Announcement.php';
require_once 'models/Allowances.php';
require_once 'enums/AllowanceStatus.php';

class AthleteHomeController
{
    private $gameScheds;
    private $announcement;
    private $allowance;

    public function __construct()
    {
        $this->gameScheds = new GameSchedules();
        $this->announcement = new Announcement();
        $this->allowance = new Allowances();
    }

    public function index()
    {
        $announcements = $this->announcement->fetchAll();
        $schedules = $this->gameScheds->fetchAthleteSchedule();

        $allowance = $this->allowance->fetchLatest($_SESSION['user_id']);

        include 'views/athlete/index.php';
    }
}