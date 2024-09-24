<?php

require_once 'core/Database.php';
require_once 'enums/UserRole.php';
require_once 'enums/UserStatus.php';

class User
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function insertUser($data): int|null
    {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (active, role, email, password, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $data['active'], $data['role'], $data['email'], $hashedPassword, $data['status']);

        if (!$stmt->execute()) {
            return null;
        }

        return $this->db->insert_id;
    }


    public function findUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function findUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getCoordinatorsWithInfo()
    {
        $coor = UserRole::COORDINATOR;
        $stmt = $this->db->prepare(
            "SELECT 
                u.email,
                u.active,
                u.status,
                ui.user_id,
                ui.first_name,
                ui.last_name,
                ui.middle_name,
                CONCAT(ui.first_name, ' ', IFNULL(ui.middle_name, ''), ' ', ui.last_name) AS full_name,
                ui.gender,
                ui.address,
                ui.age,
                ui.sport,
                ui.phone_number
            FROM users u
            LEFT JOIN user_info ui ON u.id = ui.user_id
            WHERE u.role = ?
            ORDER BY u.active ASC"
        );
        $stmt->bind_param("s", $coor);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUser($user_id)
    {
        $stmt = $this->db->prepare(
            "SELECT
                u.*,
                ui.*,
                CONCAT(ui.first_name, ' ', IFNULL(ui.middle_name, ''), ' ', ui.last_name) AS full_name
            FROM users u
            LEFT JOIN user_info ui ON u.id = ui.user_id
            WHERE u.id = ?
            "
        );
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        $result['gender'] = ucfirst($result['gender']);

        return $result;
    }

    public function fetchAllAthleteWithInfo()
    {
        $coor = UserRole::ATHLETE;
        $stmt = $this->db->prepare(
            "SELECT 
                u.email,
                u.active,
                u.status,
                ui.user_id,
                ui.first_name,
                ui.last_name,
                ui.middle_name,
                CONCAT(ui.first_name, ' ', IFNULL(ui.middle_name, ''), ' ', ui.last_name) AS full_name,
                ui.school,
                CASE 
                    WHEN ui.sport = 'base_ball' THEN 'Base Ball'
                    WHEN ui.sport = 'basket_ball' THEN 'Basket Ball'
                    WHEN ui.sport = 'soccer' THEN 'Soccer'
                    WHEN ui.sport = 'swimming' THEN 'Swimming'
                    WHEN ui.sport = 'tennis' THEN 'Tennis'
                    ELSE ''
                END AS sport,
                ui.gender,
                ui.address,
                ui.age,
                ui.phone_number
            FROM users u
            LEFT JOIN user_info ui ON u.id = ui.user_id
            WHERE u.role = ? AND u.status != 'deleted'
            ORDER BY u.status ASC"
        );
        $stmt->bind_param("s", $coor);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchAllApprovedAthleteWithInfo()
    {
        $coor = UserRole::ATHLETE;
        $status = UserStatus::ACTIVE;
        $stmt = $this->db->prepare(
            "SELECT 
                u.email,
                u.active,
                u.status,
                ui.user_id,
                ui.first_name,
                ui.last_name,
                ui.middle_name,
                CONCAT(ui.first_name, ' ', IFNULL(ui.middle_name, ''), ' ', ui.last_name) AS full_name,
                ui.school,
                CASE 
                    WHEN ui.sport = 'base_ball' THEN 'Base Ball'
                    WHEN ui.sport = 'basket_ball' THEN 'Basket Ball'
                    WHEN ui.sport = 'soccer' THEN 'Soccer'
                    WHEN ui.sport = 'swimming' THEN 'Swimming'
                    WHEN ui.sport = 'tennis' THEN 'Tennis'
                    ELSE ''
                END AS sport,
                ui.gender,
                ui.address,
                ui.age,
                ui.phone_number
            FROM users u
            LEFT JOIN user_info ui ON u.id = ui.user_id
            WHERE u.role = ? AND u.status = ?
            ORDER BY u.id DESC"
        );
        $stmt->bind_param("ss", $coor, $status);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateStatus($user_id, $status)
    {
        $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $user_id);
        return $stmt->execute();
    }

    //========================================

    public function readAll()
    {
        $result = $this->db->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $name, $username)
    {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, username = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $username, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
