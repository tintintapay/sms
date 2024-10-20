<?php

require_once 'core/ReportData.php';
require_once 'enums/Sport.php';
require_once 'core/Widget.php';

class AdminHomeController
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

        // population
        $population = Widget::athletePopulation();

        // Top rated athletes
        $topRatedAthletes = Widget::topRatedAthlete(); 
        

        //game highlights
        $gameHighlights = Widget::topGameHighlights();

        include 'views/admin/index.php';
    }
}