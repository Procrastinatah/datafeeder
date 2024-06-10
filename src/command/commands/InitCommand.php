<?php

include_once ('src/command/AbstractCommand.php');
include_once ('src/console/Console.php');
include_once ('src/logger/Logger.php');
include_once ('src/database/DatabaseConnector.php');

class InitCommand extends AbstractCommand
{
    const string PROJECT_SQL_PATH = 'sql/project.sql';
    public function execute(array $args): bool
    {
        Console::output('Connecting to database...');
        $databaseConnector = new DatabaseConnector();
        if($databaseConnector->connect() === false){
            return false;
        };
        Console::output('Connected to database', Color::Green);

        Console::output('Searching for project.sql...');
        $projectSqlFile = file_get_contents(self::PROJECT_SQL_PATH);
        if($projectSqlFile === false){
            Logger::logError('could not find project.sql file at ' . self::PROJECT_SQL_PATH);
            return false;
        }
        Console::output('project.sql found', Color::Green);

        Console::output('executing sql');
        if($databaseConnector->execute($projectSqlFile) === false){
            return false;
        }

        Console::output('project.sql executed', Color::Green);
        return true;
    }

    public function getDescription(): string
    {
        return 'Initializes the project and creates necessary database tables';
    }
}