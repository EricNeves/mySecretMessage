<?php

namespace App\Adapters\Out\Factories\User;

use App\Adapters\Out\Persistence\DAOs\UserPostgresDAO;
use App\Adapters\Out\Persistence\Repositories\UserPostgresRepository;
use App\Adapters\Out\Services\AuthenticationImplementation;
use App\Adapters\Out\Services\PasswordHasherImplementation;
use App\Application\UseCases\User\AuthenticateUser\AuthenticateUserUseCase;
use App\Infrastructure\Database\Postgres;
use App\Infrastructure\Http\Jwt;

class AuthenticateUserFactory
{
    public function init(): AuthenticateUserUseCase
    {
        $userPostgresDao           = new UserPostgresDAO(Postgres::connect());
        $userPostgresRepository    = new UserPostgresRepository($userPostgresDao);
        $jwt                       = new Jwt();
        $passwordHasher            = new PasswordHasherImplementation();
        $authenticationService     = new AuthenticationImplementation($userPostgresRepository, $jwt, $passwordHasher);
        $authenticationUserUseCase = new AuthenticateUserUseCase($authenticationService);

        return $authenticationUserUseCase;
    }
}
