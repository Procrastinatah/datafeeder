<?php

include_once ('src/command/CommandInterface.php');
include_once ('src/console/Console.php');
class DbCommand implements CommandInterface
{

    public function execute(array $args): bool
    {
        Console::output("db");
        return true;
    }

    public function getDescription(): string
    {
        return 'Commands to handle the database';
    }
}