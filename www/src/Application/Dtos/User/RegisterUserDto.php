<?php

namespace App\Application\Dtos\User;

class RegisterUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }
}
