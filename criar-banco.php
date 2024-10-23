<?php

require_once 'Connection.php';

$pdo = Connection::connect();

$pdo->exec(
    'CREATE TABLE aluraplay.videos(
    id INT NOT NULL AUTO_INCREMENT,
    url VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`));'
);
