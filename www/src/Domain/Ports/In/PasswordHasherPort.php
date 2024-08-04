<?php

namespace App\Domain\Ports\In;

interface PasswordHasherPort
{
    public function hash(string $password): string;
    public function verify(string $password, string $hash): bool;
}
