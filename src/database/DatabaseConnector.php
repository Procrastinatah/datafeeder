<?php

include_once 'Config.php';
include_once 'src/logger/Logger.php';

class DatabaseConnector {

    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function connect(): PDO|bool
    {
        try {
            $conn = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE,
                Config::USERNAME,
                Config::PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (PDOException $error) {
            Logger::logError('Connection to database failed', $error);
            return false;
        }
    }

    public function disconnect(): void
    {
        $this->conn = null;
    }

    public function execute(string $sql): bool
    {
        if ($this->conn === null) {
            $this->connect();
        }
        $output = $this->conn->prepare($sql);
        $output->execute();
        $this->conn = null;
        return $output;
    }

}