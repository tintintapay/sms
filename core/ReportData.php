<?php

require_once 'Model.php';
require_once 'enums/UserRole.php';
require_once 'enums/UserStatus.php';
require_once 'enums/GameStatus.php';
require_once 'enums/Sport.php';

class ReportData extends Model
{
    public function getAthletePopulation()
    {
        $active = UserStatus::ACTIVE;
        $athlete = UserRole::ATHLETE;

        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM users WHERE status = ? AND role = ?");
        $stmt->bind_param("ss", $active, $athlete);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function getLatestAnnouncement($limit = 1)
    {
        $stmt = $this->db->prepare("SELECT * FROM announcements WHERE deleted_at IS NULL LIMIT $limit");
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $limit === 1
            ? $result->fetch_assoc()
            : $result->fetch_all(MYSQLI_ASSOC);

        return $row;
    }

    public function getIncomingEvent($limit = 1)
    {
        $active = GameStatus::ACTIVE;
        $stmt = $this->db->prepare("SELECT * FROM game_schedules WHERE deleted_at IS NULL AND status = ? AND schedule > CURDATE() ORDER BY schedule ASC LIMIT $limit");
        $stmt->bind_param("s", $active);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $limit === 1
            ? $result->fetch_assoc()
            : $result->fetch_all(MYSQLI_ASSOC);

        return $row;
    }

    public function getPopulationBySport()
    {
        $athlete = UserRole::ATHLETE;
        $active = UserStatus::ACTIVE;
        $stmt = $this->db->prepare("SELECT ui.sport, COUNT(*) as total FROM users u JOIN user_info ui ON u.id = ui.user_id WHERE u.role = ? AND u.status = ? GROUP BY ui.sport; ");
        $stmt->bind_param("ss", $athlete, $active);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopRatedAthlete($data)
    {
        $sport = $data['sport'] ?? "";
        $limit = $data['limit'] ?? 9999;
        $date['from'] = $data['date_from'] ?? date('Y-m-01');
        $date['to'] = $data['date_to'] ?? date('Y-m-t');

        $athlete = UserRole::ATHLETE;
        $active = UserStatus::ACTIVE;

        $params = [];
        $sql = "
            SELECT 
                user_info.user_id,
                user_info.first_name,
                user_info.last_name,
                user_info.sport,
                ROUND(AVG(athletes_ratings.teamwork), 2) AS avg_teamwork,
                ROUND(AVG(athletes_ratings.sportsmanship), 2) AS avg_sportsmanship,
                ROUND(AVG(athletes_ratings.technical_skills), 2) AS avg_technical_skills,
                ROUND(AVG(athletes_ratings.adaptability), 2) AS avg_adaptability,
                ROUND(AVG(athletes_ratings.game_sense), 2) AS avg_game_sense,
                ROUND((AVG(athletes_ratings.teamwork) + AVG(athletes_ratings.sportsmanship) + AVG(athletes_ratings.technical_skills) + AVG(athletes_ratings.adaptability) + AVG(athletes_ratings.game_sense)) / 5, 2) AS avg_overall_rating
            FROM 
                athletes_ratings
            JOIN 
                user_info ON athletes_ratings.athlete_id = user_info.user_id
            JOIN
                users ON user_info.user_id = users.id
            WHERE users.status = ? 
            AND users.role = ?
        ";
        $type = "ss";
        $params[] = $active;
        $params[] = $athlete;

        // Check if sport is provided
        if (!empty($sport)) {
            $sql .= " AND user_info.sport = ?"; // Add sport filter if sport is specified
            $type .= "s";
            $params[] = $sport;
        }

        $sql .= "
            AND game_id IN (SELECT id from game_schedules WHERE schedule between ? AND ?)
            GROUP BY 
                user_info.user_id
            ORDER BY 
                avg_overall_rating DESC
            LIMIT ?;
        ";
        $type .= "ssi";
        $params[] = $date['from'];
        $params[] = $date['to'];
        $params[] = $limit;

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($type, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopGameHighlights($data)
    {
        $sport = $data['sport'] ?? "";
        $limit = $data['limit'] ?? 9999;
        $date['from'] = $data['date_from'] ?? date('Y-m-01');
        $date['to'] = $data['date_to'] ?? date('Y-m-t');

        $athlete = UserRole::ATHLETE;
        $active = UserStatus::ACTIVE;

        $type = "";
        $params = [];

        $sql = "
            SELECT 
                user_info.user_id,
                user_info.first_name,
                user_info.last_name,
                user_info.sport,
                game_schedules.game_title,
                game_schedules.schedule,
                game_schedules.venue,
                ROUND(AVG(athletes_ratings.teamwork), 2) AS avg_teamwork,
                ROUND(AVG(athletes_ratings.sportsmanship), 2) AS avg_sportsmanship,
                ROUND(AVG(athletes_ratings.technical_skills), 2) AS avg_technical_skills,
                ROUND(AVG(athletes_ratings.adaptability), 2) AS avg_adaptability,
                ROUND(AVG(athletes_ratings.game_sense), 2) AS avg_game_sense,
                ROUND(
                    (
                        AVG(athletes_ratings.teamwork) +
                        AVG(athletes_ratings.sportsmanship) +
                        AVG(athletes_ratings.technical_skills) +
                        AVG(athletes_ratings.adaptability) +
                        AVG(athletes_ratings.game_sense)
                    ) / 5, 2
                ) AS avg_overall_rating
            FROM 
                athletes_ratings
            JOIN 
                user_info ON athletes_ratings.athlete_id = user_info.user_id
            JOIN 
                users ON user_info.user_id = users.id
            JOIN 
                game_schedules ON athletes_ratings.game_id = game_schedules.id
            WHERE 
                users.status = ?
                AND users.role = ?
            ";

        $type .= "ss";
        $params[] = $active;
        $params[] = $athlete;

        if (!empty($sport)) {
            $sql .= " AND user_info.sport = ?";
            $type .= "s";
            $params[] = $sport;
        }
        $sql .= " AND game_schedules.schedule BETWEEN ? AND ?
            GROUP BY 
                user_info.user_id
            ORDER BY 
                avg_overall_rating DESC
            LIMIT ?;";

        $type .= "ssi";
        $params[] = $date['from'];
        $params[] = $date['to'];
        $params[] = $limit;

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($type, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}