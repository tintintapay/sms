<?php

require_once 'core/Database.php';
require_once 'enums/UserRole.php';
require_once 'enums/UserStatus.php';

class GameSchedules
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM game_schedules WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function fetchAll()
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM game_schedules WHERE deleted_at IS NULL"
        );
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertSchedule($data)
    {
        $stmt = $this->db->prepare("INSERT INTO game_schedules (game_title, schedule, sport, status, created_user) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $data['game_title'], $data['schedule'], $data['sport'], $data['status'], $data['created_user']);

        if (!$stmt->execute()) {
            return null;
        }

        return $this->db->insert_id;
    }

    public function updateSchedule($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE game_schedules SET game_title = ?, schedule = ?, sport = ? WHERE id = ?");
        $stmt->bind_param("sssi", $data['game_title'], $data['schedule'], $data['sport'], $id);

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
}