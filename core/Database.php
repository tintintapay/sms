<?php

class Database
{
    private $connection;

    public function __construct()
    {
        $config = require 'config.php';

        $this->connection = new mysqli(
            $config['db']['host'],
            $config['db']['username'],
            $config['db']['password'],
            $config['db']['database']
        );
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
        $this->connection->close();
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function selectNative($query)
    {
        $config = require 'config.php';
        $conn = new mysqli(
            $config['db']['host'],
            $config['db']['username'],
            $config['db']['password'],
            $config['db']['database']
        );

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        return $conn->query($query);
    }

    public function __destruct()
    {
        
    }
}
