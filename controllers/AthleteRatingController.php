<?php

require_once 'models/GameSchedules.php';
require_once 'models/Evaluation.php';
require_once 'models/AthletesRating.php';
require_once 'core/Helper.php';
require_once 'requests/AthletesRatingRequest.php';
require_once 'models/User.php';
require_once 'core/ReportData.php';

class AthleteRatingController
{
    private $gameScheds;
    private $evaluation;
    private $athletesRating;
    private $user;
    private $report;

    public function __construct()
    {
        $this->gameScheds = new GameSchedules();
        $this->evaluation = new Evaluation();
        $this->athletesRating = new AthletesRating();
        $this->user = new User();
        $this->report = new ReportData();
    }

    public function index()
    {
        $gameScheds = $this->gameScheds->fetchAllCompleted();

        $_SESSION['menu'] = 'athlete_rating';
        return include "views/coordinator/athlete-ratings.php";
    }

    public function show($params)
    {
        $gameId = $params['game_id'];
        $_GET['game_id'] = $params['game_id'];

        $evaluations = $this->evaluation->findAllToRate($gameId);
        $gameSched = $this->gameScheds->findById($gameId);

        return include "views/coordinator/athlete-rating.php";
    }

    public function store($request)
    {
        header('Content-Type: application/json');

        // Validate request
        $athletesRatingRequest = new AthletesRatingRequest();
        $flash = $athletesRatingRequest->validate($request);

        if (!$flash['isValid']) {
            echo json_encode($flash);
            exit();
        }

        $data = [
            'created_user' => $_SESSION['user_id'],
            'athlete_id' => Helper::sanitize($request['athlete_id']),
            'game_id' => Helper::sanitize($request['game_id']),
            'teamwork' => Helper::sanitize($request['teamwork']),
            'sportsmanship' => Helper::sanitize($request['sportsmanship']),
            'technical_skills' => Helper::sanitize($request['technical_skills']),
            'adaptability' => Helper::sanitize($request['adaptability']),
            'game_sense' => Helper::sanitize($request['game_sense']),
            'remarks' => Helper::sanitize($request['remarks'])
        ];

        // fetch if exist
        $rating = $this->athletesRating->fetchByGameIdAthleteId($request['game_id'], $request['athlete_id']);

        if (!empty($rating)) {
            // Update if existing
            $this->athletesRating->update($data);
        } else {
            // Insert if not exist
            $this->athletesRating->insert($data);
        }

        echo json_encode([
            'success' => true
        ]);
    }

    public function stat($param)
    {
        $athleteId = $param['id'];
        $athlete = $this->user->getUser($athleteId);

        if ($athlete['role'] !== UserRole::ATHLETE) {
            Helper::redirect('404-not-found');
        }

        $athletesRatings = $this->athletesRating->fetchByAthlete($athleteId);

        $rating = [
            'teamwork' => 0,
            'sportsmanship' => 0,
            'technical_skills' => 0,
            'adaptability' => 0,
            'game_sense' => 0
        ];

        // if athlete rating is not empty
        if ($athletesRatings) {
            $count = count($athletesRatings); // Get the count of ratings right from the start
            foreach ($athletesRatings as $athletesRating) {
                $rating['teamwork'] += $athletesRating['teamwork'];
                $rating['sportsmanship'] += $athletesRating['sportsmanship'];
                $rating['technical_skills'] += $athletesRating['technical_skills'];
                $rating['adaptability'] += $athletesRating['adaptability'];
                $rating['game_sense'] += $athletesRating['game_sense'];
            }
            $rating['teamwork'] /= $count;
            $rating['sportsmanship'] /= $count;
            $rating['technical_skills'] /= $count;
            $rating['adaptability'] /= $count;
            $rating['game_sense'] /= $count;
        }

        $data = [
            'athleteId' => $athleteId,
            'limit' => 3,
        ];

        $gameEvents = $this->gameScheds->fetchGameWhereInByAthlete($data);
        $totalPlayed = $this->gameScheds->getPlayedCount($data);

        $bestGame = $this->gameScheds->bestGameHighlight($data);

        // Ranking
        $rankData = [
            'sport' => $athlete['sport']
        ];

        $ranks = $this->report->rankings($rankData);
        $ranking = "";
        foreach ($ranks as $rank) {
            if ($rank['athlete_id'] === $athlete['user_id']) {
                $ranking = $rank['rank_in_sport'];
            }
        }

        include 'views/athlete/player-stats.php';
    }
}