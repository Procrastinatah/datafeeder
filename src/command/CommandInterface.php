<?php

interface CommandInterface
{
    public function execute(array $args): bool;
    public function getDescription(): string;
}