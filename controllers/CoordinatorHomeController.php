<?php

require_once 'models/UserInfo.php';
require_once 'models/User.php';
require_once 'core/ReportData.php';
require_once 'enums/Sport.php';
require_once 'core/Widget.php';

class CoordinatorHomeController
{
    private $report;

    public function __construct()
    {
        $this->report = new ReportData();
    }

    public function index()
    {
        $sportList = Sport::fetchList();
        $events = $this->report->getIncomingEvent(3);
        $announcement = $this->report->getLatestAnnouncement();

        // Total athlete claims allowance
        $allowanceClaim = Widget::claimsAllowanceCount();

        // population
        $population = Widget::athletePopulation();

        // Top rated athletes
        $topRatedAthletes = Widget::topRatedAthlete();
        
        // game highlights
        $gameHighlights = Widget::topGameHighlights();

        $_SESSION['menu'] = 'dashboard';
        include "views/coordinator/index.php";
    }

}