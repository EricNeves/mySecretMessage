<?php

namespace App\Domain\Entities;

class User
{
    public function __construct(
        public ?string $id,
        public string $name,
        public ?string $email,
        public string $password,
    ) {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
