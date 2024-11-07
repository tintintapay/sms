<?php

require_once 'core/Model.php';
require_once 'enums/AllowanceStatus.php';

class HealthRecord extends Model
{
    public function fetchRecords($athlete_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM health_records WHERE athlete_id = ? AND deleted_at IS NULL ORDER BY id DESC");
        $stmt->bind_param('i', $athlete_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatest($athlete_id)
    {
        $stmt = $this->db->prepare("SELECT status FROM health_records WHERE athlete_id = ? AND deleted_at IS NULL ORDER BY id DESC LIMIT 1");
        $stmt->bind_param('i', $athlete_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result->fetch_assoc();
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO health_records (athlete_id, status, remarks) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $data['athlete_id'], $data['status'], $data['remarks']);
        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }
}