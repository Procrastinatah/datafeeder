<?php

include_once 'src/console/Console.php';

testEmptyArguments();
testInvalidArguments();
function testEmptyArguments(){
    $console = new Console([]);
    $console->run();
}

function testInvalidArguments(){
    $console = new Console(['lorem','ipsum', 'dolor', 'sin']);
    $console->run();
}