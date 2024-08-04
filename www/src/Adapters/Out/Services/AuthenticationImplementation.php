<?php

namespace App\Adapters\Out\Services;

use App\Adapters\Out\Persistence\Repositories\UserPostgresRepository;
use App\Domain\Ports\In\AuthenticationPort;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Infrastructure\Http\Jwt;
use Exception;

class AuthenticationImplementation implements AuthenticationPort
{
    public function __construct(
        private UserPostgresRepository $userRepository,
        private Jwt $jwt,
        private PasswordHasherPort $passwordHasher
    ) {
    }

    public function authenticate(string $email, string $password): mixed
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !$this->passwordHasher->verify($password, $user['password'])) {
            throw new Exception("Sorry, email/password is incorrect", 401);
        }

        unset($user['password']);

        return $this->jwt->generate($user);
    }
}
