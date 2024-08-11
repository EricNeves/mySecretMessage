<?php

use App\Infrastructure\Database\Postgres;
use PHPUnit\Framework\TestCase;

class PostgresTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConnectToPostgresWithPDO()
    {
        $postgres = Postgres::connect();

        $this->assertInstanceOf(PDO::class, $postgres);
    }
}
