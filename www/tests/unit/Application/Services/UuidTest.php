<?php

use App\Domain\Services\UuidGenerator;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{
    private $uuid;

    public function setUp(): void
    {
        $this->uuid = $this->createMock(UuidGenerator::class);
    }

    /**
     * @test
     */
    public function shouldReturnUuid(): void
    {
        $this->uuid->method('generate')
            ->willReturn('123e4567-e89b-12d3-a456-426614174000');

        $this->assertEquals('123e4567-e89b-12d3-a456-426614174000', $this->uuid->generate());
    }
}
