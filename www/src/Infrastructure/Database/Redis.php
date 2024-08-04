<?php

namespace App\Infrastructure\Database;

use Predis\Client;

class Redis
{
    public static function connect(): Client
    {
        $redis = new Client([
            "scheme"   => "tcp",
            "host"     => $_ENV['DB_REDIS_HOST'],
            "port"     => $_ENV['DB_REDIS_PORT'],
            "password" => $_ENV['DB_REDIS_PASSWORD'],
        ]);

        $redis->connect();

        return $redis;
    }
}
