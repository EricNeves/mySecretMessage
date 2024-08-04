<?php

namespace App\Domain\Ports\In;

interface AuthenticationPort
{
    public function authenticate(string $email, string $password): mixed;
}
