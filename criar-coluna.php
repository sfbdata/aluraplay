<?php

require_once __DIR__ . '/vendor/autoload.php';

$pdo = \aluraplay\Persistence\Connection::connect();

$pdo->exec('ALTER TABLE videos ADD COLUMN image_path VARCHAR(255)');
