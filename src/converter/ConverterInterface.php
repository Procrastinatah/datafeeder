<?php

include_once 'Table.php';

interface ConverterInterface
{
    public function convert(string $source): Table|bool;
}