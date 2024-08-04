<?php

namespace App\Adapters\Out\Factories\User;

use App\Adapters\Out\Persistence\DAOs\UserPostgresDAO;
use App\Adapters\Out\Persistence\Repositories\UserPostgresRepository;
use App\Adapters\Out\Services\PasswordHasherImplementation;
use App\Application\UseCases\User\RegisterUser\RegisterUserUseCase;
use App\Infrastructure\Database\Postgres;

class RegisterUserFactory
{
    public function init(): RegisterUserUseCase
    {
        $userPostgresDao        = new UserPostgresDAO(Postgres::connect());
        $userPostgresRepository = new UserPostgresRepository($userPostgresDao);
        $passwordHasher         = new PasswordHasherImplementation();
        $registerUserUseCase    = new RegisterUserUseCase($userPostgresRepository, $passwordHasher);

        return $registerUserUseCase;
    }
}
