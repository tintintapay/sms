<?php

abstract class Datatable
{
    public function fetchRecords($table, $joinTable, $joinCondition, $columns, $conditions, $start, $length, $search)
    {
        // Construct the SELECT clause
        $selectColumns = implode(", ", $columns);

        // Construct the WHERE clause
        $where = "WHERE " . implode(" AND ", array_map(function ($col) {
            return "$col = ?";
        }, array_keys($conditions)));

        // Add search conditions
        $searchConditions = [];
        $params = array_values($conditions);
        if (!empty($search)) {
            foreach ($columns as $col) {
                $searchConditions[] = "$col LIKE ?";
                $params[] = "%$search%";
            }
            $where .= " AND (" . implode(" OR ", $searchConditions) . ")";
        }

        // Query to count total records
        $countSql = "SELECT COUNT(*) as total
                 FROM $table t
                 LEFT JOIN $joinTable jt ON $joinCondition
                 $where";

        $countQuery = $this->db->prepare($countSql);
        $countQuery->execute($params);
        $countQuery->store_result();
        $countQuery->bind_result($totalRecords);
        $countQuery->fetch();

        // Query to fetch data with limit
        $dataSql = "SELECT $selectColumns
                FROM $table t
                LEFT JOIN $joinTable jt ON $joinCondition
                $where
                LIMIT ?, ?";
        $params[] = (int) $start;
        $params[] = (int) $length;

        $dataQuery = $this->db->prepare($dataSql);
        $dataQuery->execute($params);
        $data = $dataQuery->get_result()->fetch_all(MYSQLI_ASSOC);

        return [
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data,
        ];
    }
}