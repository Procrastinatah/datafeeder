<?php

include_once ('Color.php');
include_once ('src/logger/Logger.php');
include_once ('src/command/CommandInterface.php');

class Console {
    private array $args;
    public function __construct($args)
    {
        $this->args = $args;
    }

    public function run(): void
    {
        if (array_key_exists(1, $this->args) === false) {
            Console::output('No command provided', Color::Red, Color::Red);
            Console::output('Type "help" to see all existing commands');
            return;
        }

        $commandRegistry = require 'src/command/command_registry.php';
        if(array_key_exists($this->args[1], $commandRegistry) === false) {
            Console::output('Command not found', Color::Red, Color::Red);
            Console::output('Type "help" to see all existing commands');
            return;
        }

        $command = $commandRegistry[$this->args[1]];
        Console::output('###### Running command "'.$this->args[1].'"', Color::Green, Color::Green);
        Console::outputEmptyLine();
        $commandSuccess = $command->execute($this->args);

        if($commandSuccess) {
            Console::outputEmptyLine();
            Console::output('###### Command successfully executed', Color::Green, Color::Green);
            return;
        }
        Console::output('There was an error while executing the command, please check your logfile', Color::Red, Color::Red);
    }

    public static function output(string $output, Color $color = Color::Base, Color $timeColor = Color::Base): void {
        echo self::getCurrentOutputTime($timeColor)  . ' '. self::colorize($output, $color) . PHP_EOL;
    }

    public static function outputEmptyLine(): void {
        echo PHP_EOL;
    }

    public static function getCurrentOutputTime(Color $color): string {
        return self::colorize('[' . date('H:i:s') . ']', $color);
    }

    public static function colorize(string $string, Color $color): string {
        return "\033[" . $color->value . "m" . $string . "\033[0m";
    }

}