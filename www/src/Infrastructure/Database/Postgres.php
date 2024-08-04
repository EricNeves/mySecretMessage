<?php

namespace App\Infrastructure\Database;

use PDO;

class Postgres
{
    public static function connect()
    {
        $dns      = 'pgsql:host=' . $_ENV['DB_POSTGRES_HOST'] . ';port=' . $_ENV['DB_POSTGRES_PORT'] . ';dbname=' . $_ENV['DB_POSTGRES_DB'];
        $user     = $_ENV['DB_POSTGRES_USER'];
        $password = $_ENV['DB_POSTGRES_PASSWORD'];

        $pdo = new PDO($dns, $user, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
