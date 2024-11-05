<?php

require_once 'core/ReportData.php';
require_once 'enums/Sport.php';

class Widget
{

    public static function topGameHighlights()
    {
        $report = new ReportData();

        $sportList = Sport::fetchList();
        $topGames = [];
        foreach ($sportList as $key => $value) {
            $data = [
                'sport' => $key,
                'limit' => 1
            ];

            $gameHightLights = $report->getTopGameHighlights($data);
            foreach ($gameHightLights as $row) {
                $topGames[] = [
                    'user_id' => $row['user_id'],
                    'athlete' => $row['first_name'] . " " . $row['last_name'],
                    'sport' => $row['sport'],
                    'game_title' => $row['game_title'],
                    'schedule' => $row['schedule'],
                    'venue' => $row['venue'],
                    'avg_teamwork' => $row['avg_teamwork'],
                    'avg_sportsmanship' => $row['avg_sportsmanship'],
                    'avg_technical_skills' => $row['avg_technical_skills'],
                    'avg_adaptability' => $row['avg_adaptability'],
                    'avg_game_sense' => $row['avg_game_sense'],
                    'avg_overall_rating' => $row['avg_overall_rating']
                ];
            }

        }
        // starts output buffering
        ob_start();
        include 'template/widgets/game-highlights.php';
        // store output buffering
        $html = ob_get_clean();

        return $html;
    }

    public static function topRatedAthlete()
    {
        $report = new ReportData();

        $sportList = Sport::fetchList();

        $topRated = [];
        foreach ($sportList as $key => $value) {
            $data = [
                'sport' => $key,
                'limit' => 1
            ];

            $topRateds = $report->getTopRatedAthlete($data);

            // dd($topRateds);

            foreach ($topRateds as $row) {
                // $topRated['name'][] = $row['first_name'] . " " . $row['last_name'] . "(" . Sport::getDescription($row['sport']) . ")";
                $topRated['name'][] = School::getDescription($row['school']) . "(" . Sport::getDescription($row['sport']) . ")";
                $topRated['data'][] = $row['avg_overall_rating'];
            }
        }
        $names = json_encode($topRated['name'] ?? '');
        $data = json_encode($topRated['data'] ?? '');

        $name = array_map(function ($item) {
            return [$item];
        }, $topRated['name'] ?? []);

        $categories = json_encode($name);

        // starts output buffering
        ob_start();
        include 'template/widgets/top-rated-athlete.php';
        // store output buffering
        $html = ob_get_clean();

        return $html;
    }

    public static function athletePopulation()
    {
        $report = new ReportData();
        $population = [];
        $totalPopulation = $report->getAthletePopulation();
        $sportPopulation = $report->getPopulationBySport();

        foreach ($sportPopulation as $row) {
            $population['sport'][] = Sport::getDescription($row['sport']);
            $population['data'][] = $row['total'];
        }

        $sport = json_encode($population['sport'] ?? '');
        $data = json_encode($population['data'] ?? '');
        // starts output buffering
        ob_start();
        include 'template/widgets/athlete-population.php';
        // store output buffering
        $html = ob_get_clean();

        return $html;
    }

    public static function claimsAllowanceCount()
    {
        $report = new ReportData();

        $allowances = $report->getTotalClaimAllowance([]);
        $remainingClaim = $allowances['not_yet_claimed'] ?? 0;
        $totalClaim = $allowances['claimed'] ?? 0;

        // starts output buffering
        ob_start();
        include 'template/widgets/allowance-claim.php';
        // store output buffering
        $html = ob_get_clean();

        return $html;
    }
}