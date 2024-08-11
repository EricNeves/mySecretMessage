<?php

use App\Infrastructure\Database\Redis;
use PHPUnit\Framework\TestCase;
use Predis\Client;

class RedisTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConnectToRedisWithPredis()
    {
        $redis = Redis::connect();

        $this->assertInstanceOf(Client::class, $redis);
    }
}
