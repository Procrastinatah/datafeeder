<?php

include_once 'src/console/Console.php';
class Logger
{
    private const string LOG_FILE_PATH = 'log/log.txt';

    public static function logError(string $shortError, string $errorMessage = null): void {
        Console::output($shortError, Color::Red, Color::Red);
        if($errorMessage === null) {
            $errorMessage = $shortError;
        }
        self::appendStringToLogFile('[' . date('d.m.y H:i:s') . ']' . ' ' . $errorMessage);
    }

    public static function appendStringToLogFile(string $string): bool
    {
        if(!file_exists(self::LOG_FILE_PATH)) {
            if(touch(self::LOG_FILE_PATH) === false){
                Console::output('Could not create logfile', Color::Red, Color::Red);
                return false;
            };
        }
        if (!file_put_contents(self::LOG_FILE_PATH, $string . PHP_EOL, FILE_APPEND)) {
            Console::output('Could not write into logfile', Color::Red, Color::Red);
            return false;
        };

        return true;
    }
}