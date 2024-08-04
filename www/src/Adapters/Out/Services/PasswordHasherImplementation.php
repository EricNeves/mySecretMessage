<?php

namespace App\Adapters\Out\Services;

use App\Domain\Ports\In\PasswordHasherPort;

class PasswordHasherImplementation implements PasswordHasherPort
{
    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
