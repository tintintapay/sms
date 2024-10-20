<?php

require_once 'core/Model.php';
require_once 'enums/UserRole.php';
require_once 'enums/UserStatus.php';
require_once 'enums/GameStatus.php';

class GameSchedules extends Model
{
    public function findById($id)
    {
        // Update Game Sched
        $this->updateGameSched();

        $stmt = $this->db->prepare("SELECT * FROM game_schedules WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function fetchAll()
    {
        // Update Game Sched
        $this->updateGameSched();

        $stmt = $this->db->prepare(
            "SELECT * FROM game_schedules WHERE deleted_at IS NULL ORDER BY schedule DESC"
        );
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertSchedule($data)
    {
        $stmt = $this->db->prepare("INSERT INTO game_schedules (game_title, schedule, sport, venue, status, created_user) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $data['game_title'], $data['schedule'], $data['sport'], $data['venue'], $data['status'], $data['created_user']);

        if (!$stmt->execute()) {
            return null;
        }

        return $this->db->insert_id;
    }

    public function updateSchedule($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE game_schedules SET game_title = ?, schedule = ?, sport = ?, venue = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $data['game_title'], $data['schedule'], $data['sport'], $data['venue'], $data['status'], $id);

        return $stmt->execute();
    }
    public function delete($id)
    {
        $stmt = $this->db->prepare("UPDATE game_schedules SET deleted_at = NOW() WHERE id = ?");
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    public function fetchAthleteSchedule()
    {
        // Update Game Sched
        $this->updateGameSched();

        $stmt = $this->db->prepare(
            "SELECT g.*, e.status,
            (CASE 
                WHEN EXISTS (SELECT 1 
                    FROM evaluations 
                    WHERE game_schedules_id = g.id 
                    AND athlete_id = ?
                )
                THEN 1 
                ELSE 0 
            END) AS is_included
            FROM game_schedules g
            JOIN evaluations e
            ON e.game_schedules_id = g.id
            WHERE g.sport = ?
            AND e.athlete_id = ?
            AND g.deleted_at IS NULL"
        );

        $stmt->bind_param('isi', $_SESSION['user_id'], $_SESSION['sport'], $_SESSION['user_id']);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchAllCompleted()
    {
        // Update Game Sched
        $this->updateGameSched();

        $stmt = $this->db->prepare("SELECT * FROM game_schedules WHERE schedule < CURDATE()");
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateGameSched()
    {
        $completed = GameStatus::COMPLETED;

        $stmt = $this->db->prepare("UPDATE game_schedules SET status = ? WHERE schedule < CURDATE()");
        $stmt->bind_param('s', $completed);

        return $stmt->execute();
    }

    public function fetchGameWhereInByAthlete($data)
    {
        $approveAthlete = EvaluationStatus::APPROVED;
        $limitClause = isset($data['limit']) && is_numeric($data['limit']) ? " LIMIT ?" : "";
        $query = "SELECT * FROM game_schedules WHERE id IN (SELECT game_schedules_id FROM evaluations WHERE athlete_id = ? AND status = ?) AND status = ? ORDER BY schedule DESC $limitClause";

        $stmt = $this->db->prepare($query);

        $completed = GameStatus::COMPLETED;

        $params = [$data['athleteId'], $approveAthlete, $completed];
        $types = 'iss';

        if (!empty($limitClause)) {
            $params[] = $data['limit'];
            $types .= 'i';
        }

        $stmt->bind_param($types, ...$params);

        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPlayedCount($data)
    {
        $approve = EvaluationStatus::APPROVED;
        $completed = GameStatus::COMPLETED;
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM game_schedules WHERE id IN (SELECT game_schedules_id FROM evaluations WHERE athlete_id = ? AND status = ?) AND status = ? ORDER BY schedule DESC");
        $stmt->bind_param('iss', $data['athleteId'], $approve, $completed);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function bestGameHighlight($data = [])
    {
        if (!empty($data['athleteId'])) {
            $sql = "SELECT ar.*, gs.game_title, gs.schedule, gs.sport, gs.venue
                FROM athletes_ratings ar
                JOIN game_schedules gs ON ar.game_id = gs.id
                WHERE ar.athlete_id = ?
                ORDER BY GREATEST(ar.teamwork, ar.sportsmanship, ar.technical_skills, ar.adaptability, ar.game_sense) DESC
                LIMIT 1;";
            $type = "i";
            $params = [$data['athleteId']];
        } else {
            $sql = "SELECT ar.*, gs.game_title, gs.schedule, gs.sport, gs.venue
                FROM athletes_ratings ar
                JOIN game_schedules gs ON ar.game_id = gs.id
                ORDER BY GREATEST(ar.teamwork, ar.sportsmanship, ar.technical_skills, ar.adaptability, ar.game_sense) DESC
                LIMIT 1;";
            $type = "";
            $params = [];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($type, ...$params);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

}