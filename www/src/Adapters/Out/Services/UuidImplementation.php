<?php

namespace App\Adapters\Out\Services;

use Ramsey\Uuid\Uuid;

class UuidImplementation
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
