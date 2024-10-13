<?php

require_once 'core/Model.php';

class UserInfo extends Model
{
    public function insertUserInfo($data)
    {
        $stmt = $this->db->prepare("INSERT INTO user_info (
            user_id,
            first_name,
            last_name,
            middle_name,
            gender,
            year_level,
            course,
            address,
            school,
            guardian,
            age,
            birthday,
            sport,
            phone_number,
            cor,
            psa,
            medical_cert,
            picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "isssssssssisssssss",
            $data['user_id'],
            $data['first_name'],
            $data['last_name'],
            $data['middle_name'],
            $data['gender'],
            $data['year_level'],
            $data['course'],
            $data['address'],
            $data['school'],
            $data['guardian'],
            $data['age'],
            $data['birthday'],
            $data['sport'],
            $data['phone_number'],
            $data['cor'],
            $data['psa'],
            $data['medical_cert'],
            $data['picture']
        );

        return $stmt->execute();
    }

    public function insertCoordinator($data)
    {
        $stmt = $this->db->prepare("INSERT INTO user_info (user_id, first_name, last_name, middle_name, gender, address, age, phone_number, picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssiss", $data['user_id'], $data['first_name'], $data['last_name'], $data['middle_name'], $data['gender'], $data['address'], $data['age'], $data['phone_number'], $data['picture']);

        return $stmt->execute();
    }

    public function findUserInfoById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM user_info WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function findUserInfoByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM user_info WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUserFullName($userId)
    {
        $stmt = $this->db->prepare("SELECT first_name, middle_name, last_name FROM user_info WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        return $result['first_name'] . ' ' . $result['middle_name'] . ' ' . $result['last_name'];
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
