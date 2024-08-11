<?php

namespace App\Adapters\Out\Services;

use App\Domain\Services\UuidGenerator;
use Ramsey\Uuid\Uuid;

class UuidImplementation implements UuidGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
