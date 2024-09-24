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
}