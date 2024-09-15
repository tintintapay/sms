<?php
class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findUserByUserName($username)
    {
        $result = $this->db->query("SELECT * FROM users WHERE username = ?", [$username]);
        return $result->fetch();
    }

    public function findUserById($id)
    {
        $result = $this->db->query("SELECT * FROM users WHERE id = ?", [$id]);
        return $result->fetch();
    }
}
