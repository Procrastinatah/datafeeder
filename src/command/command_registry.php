<?php

include_once 'src/command/commands/HelpCommand.php';
include_once 'src/command/commands/ConvertCommand.php';
include_once 'src/command/commands/DbCommand.php';

return [
    'help' => new HelpCommand(),
    'convert' => new ConvertCommand(),
    'db' => new DbCommand(),
];