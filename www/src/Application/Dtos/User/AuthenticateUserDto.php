<?php

namespace App\Application\Dtos\User;

class AuthenticateUserDto
{
    public function __construct(public string $email, public string $password)
    {
    }
}
