<?php

require_once 'models/GameSchedules.php';
require_once 'models/Evaluation.php';
require_once 'models/AthletesRating.php';
require_once 'core/Helper.php';
require_once 'requests/AthletesRatingRequest.php';

class AthleteRatingController
{
    private $gameScheds;
    private $evaluation;
    private $athletesRating;

    public function __construct()
    {
        $this->gameScheds = new GameSchedules();
        $this->evaluation = new Evaluation();
        $this->athletesRating = new AthletesRating();
    }

    public function index()
    {
        $gameScheds = $this->gameScheds->fetchAllCompleted();

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
}