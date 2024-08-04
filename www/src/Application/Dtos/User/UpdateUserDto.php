<?php

namespace App\Application\Dtos\User;

class UpdateUserDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $password
    ) {
    }
}
