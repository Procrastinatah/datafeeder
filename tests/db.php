<?php

include_once 'src/database/DatabaseConnector.php';

testDatabaseConnection();
testDatabaseDisconnect();
function testDatabaseConnection() {
    $databaseConnector = new DatabaseConnector();
    echo (string)$databaseConnector->connect(). PHP_EOL;
}

function testDatabaseDisconnect() {
    $databaseConnector = new DatabaseConnector();
    $databaseConnector->disconnect();
    $databaseConnector->execute('SELECT * FROM test');
}