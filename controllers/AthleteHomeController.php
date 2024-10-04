<?php

require_once 'models/GameSchedules.php';
require_once 'enums/EvaluationStatus.php';
require_once 'models/Announcement.php';

class AthleteHomeController
{
    private $gameScheds;
    private $announcement;

    public function __construct()
    {
        $this->gameScheds = new GameSchedules();
        $this->announcement = new Announcement();
    }

    public function index()
    {
        $announcements = $this->announcement->fetchAllAnnouncement();
        $schedules = $this->gameScheds->fetchAthleteSchedule();

        include 'views/athlete/index.php';
    }
}