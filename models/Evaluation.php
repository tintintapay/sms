<?php

require_once 'core/Model.php';

class Evaluation extends Model
{
    public function upsertUser($table, $data)
    {
        $columns = [];
        $val = [];
        $update = false;

        foreach ($data as $key => $value) {
            $columns = array_keys($value);
            $val[] = array_values($value);
            if (isset($value['id'])) {
                $update = true;
            }
        }

        $column = implode(", ", $columns);
        $placeholders = [];
        foreach ($val as $key => $value) {
            $placeholders[] = '(' . implode(", ", array_fill(0, count($value), '?')) . ')';
        }
        $placeholders = implode(", ", $placeholders);

        if ($update) {
            // Construct the UPDATE statement
            $updateColumns = [];
            foreach ($columns as $column) {
                if ($column !== 'id') {
                    $updateColumns[] = "$column = ?";
                }
            }
            $sql = "UPDATE $table SET " . implode(", ", $updateColumns) . " WHERE id = ?";
        } else {
            // Construct the INSERT statement with ON DUPLICATE KEY UPDATE
            $sql = "INSERT INTO $table ($column) VALUES $placeholders ON DUPLICATE KEY UPDATE ";
            $updateColumns = [];
            foreach ($columns as $column) {
                $updateColumns[] = "$column = VALUES($column)";
            }
            $sql .= implode(", ", $updateColumns);
        }

        // Flatten the $val array
        $flatValues = [];
        foreach ($val as $subArray) {
            foreach ($subArray as $item) {
                $flatValues[] = $item;
            }
        }

        // Prepare and execute the statement
        $stmt = $this->db->prepare($sql);
        $stmt->execute($flatValues);

        return $stmt->num_rows();
    }


    public function findAllByGameId($gameId, $fetchDeleted = false)
    {
        $sql = "SELECT * FROM evaluations WHERE game_schedules_id = ? AND deleted_at IS NULL";
        // Fetch even deleted.
        if ($fetchDeleted) {
            $sql = "SELECT * FROM evaluations WHERE game_schedules_id = ?";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $gameId);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateDeleteWhereIn($data, $array)
    {
        $columns = array_keys($data);
        $values = array_values($data);

        // Construct the SET part of the UPDATE statement
        $setValues = [];
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $setValues[] = "$key = NULL";
            } else {
                $setValues[] = "$key = ?";
            }
        }

        $whereColumn = $array['column'];
        $ids = $array['athletes'];
        $sql = "UPDATE evaluations SET " . implode(", ", $setValues) . " WHERE $whereColumn IN (" . implode(',', array_fill(0, count($ids), '?')) . ")";

        // Flatten the $values array and add the IDs for the WHERE clause
        $flatValues = [];
        foreach ($values as $value) {
            if (!is_null($value)) {
                $flatValues[] = $value;
            }
        }
        $flatValues = array_merge($flatValues, $ids);

        // Prepare and execute the statement
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(str_repeat('s', count($flatValues)), ...$flatValues);

        return $stmt->execute();
    }

    public function submit_form($data)
    {
        $stmt = $this->db->prepare("UPDATE evaluations SET contract_date = ?, eligibility_form = ?, tryout_form = ?, med_cert = ?, cor = ?, grades = ?, status = ? WHERE athlete_id = ? and game_schedules_id = ?");
        $stmt->bind_param('sssssssii', $data['contract_date'], $data['eligibility_form'], $data['tryout_form'], $data['med_cert'], $data['cor'], $data['grades'], $data['status'], $data['athlete_id'], $data['game_schedules_id']);

        return $stmt->execute();
    }

    public function findByGameIdAndAthleteId($gameId, $userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM evaluations WHERE game_schedules_id = ? AND athlete_id = ?");
        $stmt->bind_param('ii', $gameId, $userId);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_assoc();
    }

    public function findAllByGameIdJoinUsers($gameId, $fetchDeleted = false)
    {
        $sql = "SELECT e.*, CONCAT(ui.first_name, ' ', IFNULL(ui.middle_name, ''), ' ', ui.last_name) AS full_name, ui.age, u.email, ui.year_level, ui.course FROM evaluations e LEFT JOIN user_info ui ON e.athlete_id = ui.user_id LEFT JOIN users u ON u.id = e.athlete_id WHERE e.game_schedules_id = ?";
        // Fetch even deleted.
        if (!$fetchDeleted) {
            $sql .= " AND e.deleted_at IS NULL";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $gameId);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function approve_disapprove($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE evaluations SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);

        return $stmt->execute();
    }

}