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
        $stmt->close();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function getLatestAnnouncement($limit = 1)
    {
        $stmt = $this->db->prepare("SELECT * FROM announcements WHERE deleted_at IS NULL LIMIT $limit");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

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
        $stmt->close();

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
        $stmt->close();

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
                user_info.school,
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
        $stmt->close();

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
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function rankings($data)
    {
        $sql = "
            SELECT 
                ar.athlete_id,
                ui.first_name,
                ui.last_name,
                gs.sport,
                AVG((ar.teamwork + ar.sportsmanship + ar.technical_skills + ar.adaptability + ar.game_sense) / 5) AS average_score,
                RANK() OVER (PARTITION BY gs.sport ORDER BY AVG((ar.teamwork + ar.sportsmanship + ar.technical_skills + ar.adaptability + ar.game_sense) / 5) DESC) AS rank_in_sport
            FROM 
                athletes_ratings ar
            JOIN 
                game_schedules gs ON ar.game_id = gs.id
            JOIN 
                user_info ui ON ar.athlete_id = ui.user_id
            WHERE 
                gs.sport = ?
            GROUP BY 
                ar.athlete_id, gs.sport, ui.first_name, ui.last_name
            ORDER BY 
                rank_in_sport;
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $data['sport']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalClaimAllowance($data)
    {
        $stmt = $this->db->prepare("
            SELECT 
                DATE_FORMAT(a.created_at, '%Y-%m-%d %H:%i:%s') AS datetime,
                SUM(CASE WHEN a.status = 'not_yet_claimed' THEN 1 ELSE 0 END) AS not_yet_claimed,
                SUM(CASE WHEN a.status = 'claimed' THEN 1 ELSE 0 END) AS claimed
            FROM 
                allowances a
            JOIN 
                (
                    -- Select the latest distinct datetime
                    SELECT DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') AS latest_datetime
                    FROM allowances
                    ORDER BY created_at DESC
                    LIMIT 1
                ) AS latest_dates
            ON 
                DATE_FORMAT(a.created_at, '%Y-%m-%d %H:%i:%s') = latest_dates.latest_datetime
            GROUP BY 
                datetime;

        ");

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_assoc();
    }

    public function getLatestRemarks($data)
    {
        $stmt = $this->db->prepare("
            SELECT athletes_ratings.remarks, user_info.first_name, user_info.middle_name, user_info.last_name
            FROM athletes_ratings
            JOIN user_info
            ON athletes_ratings.athlete_id = user_info.user_id
            JOIN game_schedules
            ON game_schedules.id = athletes_ratings.game_id
            WHERE athletes_ratings.athlete_id = ?
            ORDER BY game_schedules.schedule DESC LIMIT 1
        ");
        $stmt->bind_param("s", $data["athlete_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_assoc();
    }
}