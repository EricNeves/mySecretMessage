<?php

namespace App\Domain\Entities;

use JsonSerializable;

class User implements JsonSerializable
{
    public function __construct(
        public ?string $id,
        public string $name,
        public ?string $email,
        public ?string $password,
    ) {
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
