<?php

require_once 'core/Model.php';
require_once 'enums/AllowanceStatus.php';

class Allowances extends Model
{
    public function insertMultiple($data)
    {
        if (empty($data)) {
            return false;
        }

        $available = AllowanceStatus::AVAILABLE;

        $values = [];
        $types = "";
        $placeholders = [];

        foreach ($data as $item) {
            $values[] = $item['athlete_id'];
            $values[] = $item['message'];
            $values[] = $item['created_user'];
            $values[] = $available;
            $types .= "ssss";
            $placeholders[] = "(?, ?, ?, ?)";
        }

        $sql = "INSERT INTO allowances (athlete_id, message, created_user, status) VALUES " . implode(", ", $placeholders);
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($types, ...$values);

        $exec = $stmt->execute();
        $stmt->close();

        return $exec;
    }

    public function fetchLatest($athlete_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM allowances WHERE athlete_id = ? AND deleted_at IS NULL ORDER BY id DESC LIMIT 1");
        $stmt->bind_param('s', $athlete_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        return $result->fetch_assoc();
    }

    public function updateClaim($data)
    {
        $stmt = $this->db->prepare("UPDATE allowances SET status = ? WHERE athlete_id = ?");
        $stmt->bind_param('si', $data['status'], $data['athlete_id']);
        $exec = $stmt->execute();
        $stmt->close();
        return $exec;
    }

    public function getAllowances($data)
    {
        $where = [];
        $types = "";
        $params = [];

        if (!empty($data['date_from']) && !empty($data['date_to'])) {
            $where[] = "allowances.created_at BETWEEN ? AND ?";
            $types .= "ss";
            $params[] = $data['date_from'];
            $params[] = $data['date_to'];
        }

        if (!empty($data['school'])) {
            $where[] = "user_info.school = ?";
            $types .= "s";
            $params[] = $data['school'];
        }

        if (!empty($data['sport'])) {
            $where[] = "user_info.sport = ?";
            $types .= "s";
            $params[] = $data['sport'];
        }

        if (!empty($data['status'])) {
            $where[] = "allowances.status = ?";
            $types .= "s";
            $params[] = $data['status'];
        }

        $whereClause = count($where) ? " WHERE " . implode(" AND ", $where) : "";
        $sql = "
            SELECT
                allowances.athlete_id,
                allowances.status,
                allowances.created_at,
                CONCAT(user_info.first_name, ' ', IFNULL(user_info.middle_name, ''), ' ', user_info.last_name) AS full_name,
                users.email,
                user_info.phone_number
            FROM allowances
            JOIN user_info ON user_info.user_id = allowances.athlete_id
            JOIN users ON users.id = allowances.athlete_id
            $whereClause
            ORDER BY allowances.created_at DESC
        ";
        
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}