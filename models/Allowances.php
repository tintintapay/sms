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

        return $stmt->execute();
    }

    public function fetchLatest($athlete_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM allowances WHERE athlete_id = ? AND deleted_at IS NULL ORDER BY id DESC LIMIT 1");
        $stmt->bind_param('s', $athlete_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function updateClaim($data)
    {
        $stmt = $this->db->prepare("UPDATE allowances SET status = ? WHERE athlete_id = ?");
        $stmt->bind_param('si', $data['status'], $data['athlete_id']);
        
        return $stmt->execute();
    }
}