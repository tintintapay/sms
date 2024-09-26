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

    public function fetchAll()
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM game_schedules WHERE deleted_at IS NOT NULL"
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

}