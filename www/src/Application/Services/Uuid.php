<?php

namespace App\Application\Services;

use App\Domain\Services\UuidGenerator;

class Uuid
{
    public function __construct(private UuidGenerator $uuid)
    {
    }

    public function generateUuid(): string
    {
        return $this->uuid->generate();
    }
}
