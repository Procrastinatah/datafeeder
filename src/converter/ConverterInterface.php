<?php


interface ConverterInterface
{
    public function convert(string $source): bool;
}