<?php

include_once ('src/command/CommandInterface.php');
include_once ('src/console/Console.php');

class HelpCommand implements CommandInterface
{
    public function execute(array $args): bool
    {
        $commandRegistry = require 'src/command/command_registry.php';
        foreach ($commandRegistry as $commandKey => $command) {
            Console::output('"' . $commandKey . '"' . ' ' . $command->getDescription());
        }

        return true;
    }

    public function getDescription(): string
    {
        return 'shows a list of all available commands';
    }
}