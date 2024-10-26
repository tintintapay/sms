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
    }

    public function closeConnection()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
