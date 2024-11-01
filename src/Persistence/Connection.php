<?php

namespace aluraplay\Persistence;
class Connection
{
    public static function connect(): \PDO
    {
        $config = require_once __DIR__ . '/config.php';
        try {

            $pdo = new \PDO(sprintf('mysql:host=%s;dbname=%s', $config['database']['host'], $config['database']['dbname']), $config['database']['user'], $config['database']['pass']);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            return $pdo;

        } catch (\PDOException $e) {
            die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
        }
    }

}