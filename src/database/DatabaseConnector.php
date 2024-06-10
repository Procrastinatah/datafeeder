<?php

include_once 'Config.php';
include_once 'src/logger/Logger.php';

class DatabaseConnector {

    private ?PDO $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): bool
    {
        try {
            $conn = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE,
                Config::USERNAME,
                Config::PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
            return true;

        } catch (PDOException $error) {
            Logger::logError('Connection to database failed', $error);
            return false;
        }
    }

    public function disconnect(): void
    {
        $this->conn = null;
    }

    public function execute(string $sql): PDOStatement|bool
    {
        if ($this->conn === null) {
            $this->connect();
        }
        $output = $this->conn->prepare($sql);

        if($output === false){
            Logger::logError('Could not prepare sql statement', 'could not prepare sql statement: ' . $sql);
            return false;
        }

        try{
            $output->execute();
            return $output;
        }
        catch(PDOException $error){
            Logger::logError('Error while executing sql statement', 'sql error: ' . $error->getMessage());
            return false;
        }
    }

}