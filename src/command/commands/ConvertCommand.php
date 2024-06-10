<?php

include_once ('src/command/CommandInterface.php');
include_once ('src/console/Console.php');
include_once('src/converter/converters/CatalogConverter.php');

class ConvertCommand implements CommandInterface
{
    public function execute(array $args): bool
    {
        if(array_key_exists(2, $args) === false){
            $this->listConverters();
            return true;
        }

        $converters = $this->getConverters();
        if(array_key_exists($args[2], $converters) === false){
            Console::output('Unknown converter: '.$args[2]);
            return true;
        }

        if(array_key_exists(3,$args) === false){
            Console::output('missing parameter: '. '$file_path');
            return true;
        }

        $converter = $converters[$args[2]];
        $converter->convert($args[3]);
        return true;
    }

    public function getConverters(): array {
        return [
            'catalog' => new CatalogConverter()
        ];
    }

    public function listConverters(): void {
        Console::output('These are the following possible convert commands:');
        foreach ($this->getConverters() as $converterKey => $converter) {
            Console::output($converterKey . ' ' . '$file_path: starting from project root');
        }
    }

    public function getDescription(): string
    {
        return 'Convert commands for pushing different data storages to the database';
    }
}