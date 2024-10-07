<?php

require_once 'core/Model.php';

class Announcement extends Model
{
    public function fetchAll()
    {
        $stmt = $this->db->prepare("SELECT a.*, CONCAT(u.first_name, ' ', IFNULL(u.middle_name, ''), ' ', u.last_name) AS created FROM announcements a JOIN user_info u ON u.user_id = a.created_user WHERE deleted_at IS NULL ORDER BY id DESC");
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO announcements (title, description, created_user, created_at) VALUES (?,?,?, NOW())");
        $stmt->bind_param('ssi', $data['title'], $data['description'], $data['created_user']);

        if (!$stmt->execute()) {
            return null;
        }

        return $this->db->insert_id;
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM announcements WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("UPDATE announcements SET deleted_at = NOW() WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}