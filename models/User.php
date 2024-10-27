<?php

require_once 'core/Model.php';
require_once 'enums/UserRole.php';
require_once 'enums/UserStatus.php';

class User extends Model
{
    public function insertUser($data): int|null
    {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (active, role, email, password, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $data['active'], $data['role'], $data['email'], $hashedPassword, $data['status']);

        if (!$stmt->execute()) {
            $stmt->close();

            return null;
        }
        $stmt->close();

        return $this->db->insert_id;
    }

    public function update($data)
    {
        $params = [$data['status'], $data['email'], $data['id']];
        $types = "ssi";

        if (!empty($data['password'])) {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE users SET status = ?, email = ?, password = ? WHERE id = ?";
            $params = [$data['status'], $data['email'], $hashedPassword, $data['id']];
            $types = "sssi";
        } else {
            $sql = "UPDATE users SET status = ?, email = ? WHERE id = ?";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $exec = $stmt->execute();
        $stmt->close();

        return $exec;
    }


    public function findUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT users.*, CONCAT(user_info.first_name, ' ', user_info.last_name) AS full_name FROM users JOIN user_info ON users.id = user_info.user_id WHERE users.email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $return = $result->fetch_assoc();

        $stmt->close();

        return $return;
    }

    public function findUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

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
        
        $stmt->close();
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
        
        $stmt->close();
        $result['gender'] = ucfirst($result['gender']);

        return $result;
    }

    public function fetchAllAthleteWithInfo($data = [])
    {
        $where = "";
        $types = "";
        $params = [];

        if (!empty($data['school']) && $data['school'] !== 'all') {
            $where .= " AND ui.school = ?";
            $types .= "s";
            $params[] = $data['school'];
        }

        if (!empty($data['sport']) && $data['sport'] !== 'all') {
            $where .= " AND ui.sport = ?";
            $types .= "s";
            $params[] = $data['sport'];
        }

        $coor = UserRole::ATHLETE;
        $sql = "
            SELECT 
                u.email, u.active, u.status,
                ui.user_id, ui.first_name, ui.last_name, ui.middle_name,
                CONCAT(ui.first_name, ' ', IFNULL(ui.middle_name, ''), ' ', ui.last_name) AS full_name,
                ui.school,
                ui.sport,
                ui.gender, ui.address, ui.age, ui.phone_number, ui.birthday
            FROM users u
            LEFT JOIN user_info ui ON u.id = ui.user_id
            WHERE u.role = ? AND u.status != 'deleted' $where
            ORDER BY u.status ASC,
            u.id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s" . $types, $coor, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
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
        
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateStatus($user_id, $status)
    {
        $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $user_id);
        $exec = $stmt->execute();
        $stmt->close();

        return $exec;
    }

    public function updatePassword($data)
    {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $active = UserStatus::ACTIVE;
        $stmt = $this->db->prepare("UPDATE users SET password = ?, code = '' WHERE id = ? AND status = ?");
        $stmt->bind_param("sis", $hashedPassword, $data['id'], $active);
        $exec = $stmt->execute();
        $stmt->close();

        return $exec;
    }

    public function fetchAthletesBySport($sport, $start, $length, $search)
    {
        if ($sport === '') {
            return [
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            ];
        }


        $status = UserStatus::ACTIVE;
        $role = UserRole::ATHLETE;

        // Query to count total records
        $countSql = "SELECT COUNT(*) as total
             FROM users u
             LEFT JOIN user_info ui ON u.id = ui.user_id
             WHERE ui.sport = ? AND u.status = ? AND u.role = ?";
        $params = [$sport, $status, $role];

        if (!empty($search)) {
            $countSql .= " AND (ui.sport LIKE ? OR ui.first_name LIKE ? OR ui.middle_name LIKE ? OR ui.last_name LIKE ? OR ui.phone_number LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        $countQuery = $this->db->prepare($countSql);
        $countQuery->execute($params);
        $countQuery->store_result();
        $countQuery->bind_result($totalRecords);
        $countQuery->fetch();

        // Query to fetch data with limit
        $dataSql = "SELECT
            ui.user_id,
            ui.first_name, ui.middle_name, ui.last_name,
            u.email,
            ui.school
            FROM users u
            LEFT JOIN user_info ui ON u.id = ui.user_id
            WHERE ui.sport = ? AND u.status = ? AND u.role = ?";
        $params = [$sport, $status, $role];

        if (!empty($search)) {
            $dataSql .= " AND (ui.sport LIKE ? OR ui.first_name LIKE ? OR ui.middle_name LIKE ? OR ui.last_name LIKE ? OR ui.phone_number LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        $dataSql .= " LIMIT ?, ?";
        $params[] = (int) $start;
        $params[] = (int) $length;

        $dataQuery = $this->db->prepare($dataSql);
        $dataQuery->execute($params);
        $data = $dataQuery->get_result()->fetch_all(MYSQLI_ASSOC);

        $returnData = [];
        foreach ($data as $d) {
            $returnData[] = [
                $d['user_id'],
                $d['first_name'] . ' ' . $d['middle_name'] . ' ' . $d['last_name'],
                $d['email'],
                $d['school']
            ];
        }

        $countQuery->close();
        $dataQuery->close();

        return [
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $returnData,
        ];

    }

    public function insertResetCode($data)
    {
        $active = UserStatus::ACTIVE;
        $stmt = $this->db->prepare("UPDATE users SET code = ? WHERE email = ? AND status = ?");
        $stmt->bind_param("sss", $data['code'], $data['email'], $active);
        $exec = $stmt->execute();
        $stmt->close();
        
        return $exec;
    }
}
