<?php

class Database
{
    private static $connection = null;

    public function __construct()
    {
        // $config = require 'config.php';

        // $this->connection = new mysqli(
        //     'p:' . $config['db']['host'],  // 'p:' prefix for persistent connection
        //     $config['db']['username'],
        //     $config['db']['password'],
        //     $config['db']['database']
        // );
        // if ($this->connection->connect_error) {
        //     die("Connection failed: " . $this->connection->connect_error);
        // }
    }

    // public function getConnection()
    // {
    //     return $this->connection;
    // }

    // public function closeConnection()
    // {
    //     if ($this->connection) {
    //         $this->connection->close();
    //     }
    // }

    public static function getConnection()
    {
        if (self::$connection === null) {
            $config = require 'config.php';
            self::$connection = new mysqli(
                $config['db']['host'],
                $config['db']['username'],
                $config['db']['password'],
                $config['db']['database']
            );

            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }

    public static function closeConnection()
    {
        if (self::$connection !== null) {
            self::$connection->close();
            self::$connection = null;
        }
    }
}
