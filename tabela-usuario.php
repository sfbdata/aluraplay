<?php

require_once __DIR__ . '/vendor/autoload.php';

use aluraplay\Persistence\Connection;

$pdo = Connection::connect();

$pdo->exec(
    'CREATE TABLE aluraplay.users(
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`));'
);