<?php

namespace App\Application\Services;

use App\Adapters\Out\Services\UuidImplementation;

class Uuid
{
    public function __construct(private UuidImplementation $uuid)
    {
    }

    public function generateUuid(): string
    {
        return $this->uuid->generate();
    }
}
