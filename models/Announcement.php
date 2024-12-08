<?php

require_once 'core/Model.php';

class Announcement extends Model
{
    public function fetchAll()
    {
        $stmt = $this->db->prepare("SELECT a.*, CONCAT(u.first_name, ' ', IFNULL(u.middle_name, ''), ' ', u.last_name) AS created FROM announcements a JOIN user_info u ON u.user_id = a.created_user WHERE deleted_at IS NULL ORDER BY id DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("INSERT INTO announcements (title, description, created_user, created_at) VALUES (?,?,?, NOW())");
        $stmt->bind_param('ssi', $data['title'], $data['description'], $data['created_user']);

        if (!$stmt->execute()) {
            $stmt->close();
            
            return null;
        }

        $stmt->close();
        return $this->db->insert_id;
    }

    public function update($data)
    {
        $stmt = $this->db->prepare("UPDATE announcements SET title = ?, description = ? WHERE id = ?");
        $stmt->bind_param('ssi', $data['title'], $data['description'], $data['id']);

        if (!$stmt->execute()) {
            $stmt->close();
            
            return null;
        }

        $stmt->close();
        return true;
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM announcements WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        return $result->fetch_assoc();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("UPDATE announcements SET deleted_at = NOW() WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        $exec = $stmt->execute();
        
        $stmt->close();
        return $exec;
    }
}