<?php

include_once 'src/command/commands/InitCommand.php';
include_once 'src/command/commands/HelpCommand.php';
include_once 'src/command/commands/ConvertCommand.php';

return [
    'init' => new InitCommand(),
    'help' => new HelpCommand(),
    'convert' => new ConvertCommand(),
];