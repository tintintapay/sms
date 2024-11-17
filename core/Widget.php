<?php

require_once 'core/ReportData.php';
require_once 'enums/Sport.php';
require_once 'enums/HealthStatus.php';

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

            if ($topRateds) {
                foreach ($topRateds as $row) {
                    $fullName = School::getDescription($row['school']) . "(" . Sport::getDescription($row['sport']) . ")";
                    $topRated['name'][] = $fullName;
                    $topRated['data'][] = $row['avg_overall_rating'];
                }
            }
        }

        if (!$topRated) {
            return '';
        }

        $names = array_map(function ($item) {
            $parts = [];
            while (strlen($item) > 20) {
                $spacePos = strrpos(substr($item, 0, 20), ' ');
                if ($spacePos !== false) {
                    $parts[] = substr($item, 0, $spacePos);
                    $item = trim(substr($item, $spacePos));
                } else {
                    $parts[] = substr($item, 0, 20);
                    $item = substr($item, 20);
                }
            }
            $parts[] = $item; // Add the remaining part
            return $parts;
        }, $topRated['name'] ?? []);

        $categories = json_encode($names);
        $data = json_encode($topRated['data'] ?? '');

        // starts output buffering
        ob_start();
        include 'template/widgets/top-rated-athlete.php';
        // store output buffering
        $html = ob_get_clean();

        return $html;
    }

    public static function athletePopulation($params)
    {
        $report = new ReportData();
        $population = [];
        $totalPopulation = $report->getAthletePopulation($params);
        $sportPopulation = $report->getPopulationBySport($params);

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

    public static function totalHealthRecord($params)
    {
        $report = new ReportData();

        $data = [
            'sport' => $params['hsport'] ?? null,
            'school' => $params['hschool'] ?? null,
            'gender' => $params['hgender'] ?? null
        ];

        $healthStatuses = $report->getTotalHealthStatus($data);

        $totalHealthStatus = [];

        foreach ($healthStatuses as $key => $healthStatus) {
            $totalHealthStatus['status'][] = HealthStatus::getDescription($healthStatus['status']);
            $totalHealthStatus['count'][] = $healthStatus['count'];
            $totalHealthStatus['color'][] = HealthStatus::getColor($healthStatus['status']);
        }

        $status = json_encode($totalHealthStatus['status'] ?? '');
        $count = json_encode($totalHealthStatus['count'] ?? '');
        $colors = json_encode($totalHealthStatus['color'] ?? '');

        // starts output buffering
        ob_start();
        include 'template/widgets/health-status.php';
        // store output buffering
        $html = ob_get_clean();

        return $html;
    }
}