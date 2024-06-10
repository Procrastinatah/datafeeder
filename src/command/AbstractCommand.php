<?php

abstract class AbstractCommand
{
    public abstract function execute(array $args): bool;
    public abstract function getDescription(): string;
}