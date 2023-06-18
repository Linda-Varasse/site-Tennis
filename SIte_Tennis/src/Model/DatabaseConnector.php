<?php

namespace App\Model;

abstract class DatabaseConnector
{
    private \PDO $connection;

    public function __construct()
    {
        $this->initConnection();
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    private function initConnection(): void
    {
        $this->connection = new \PDO(
            'mysql:host=localhost;port=3306;dbname=aceprotennis',
            'root',
            '',
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]
        );
    }
}
