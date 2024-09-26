<?php

require_once 'core/Database.php';

class Evaluation
{
    private $db;
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function upsertUser($table, $data)
    {
        $columns = [];
        $val = [];
        foreach ($data as $key => $value) {
            $columns = array_keys($value);
            $val[] = array_values($value);
        }
        $column = implode(", ", $columns);

        $placeholders = [];
        foreach ($val as $key => $value) {
            $placeholders[] = '(' . implode(", ", array_fill(0, count($value), '?')) . ')';
        }
        $placeholders = implode(", ", $placeholders);

        $sql = "INSERT INTO $table ($column) VALUES $placeholders ON DUPLICATE KEY UPDATE ";
        $updateColumns = [];
        foreach ($columns as $column) {
            $updateColumns[] = "$column = VALUES($column)";
        }
        $sql .= implode(", ", $updateColumns);

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
}