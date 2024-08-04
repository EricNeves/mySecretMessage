<?php

namespace App\Adapters\Out\Factories\User;

use App\Adapters\Out\Persistence\DAOs\UserPostgresDAO;
use App\Adapters\Out\Persistence\Repositories\UserPostgresRepository;
use App\Adapters\Out\Services\PasswordHasherImplementation;
use App\Application\UseCases\User\UpdateUser\UpdateUserUseCase;
use App\Infrastructure\Database\Postgres;

class UpdateUserFactory
{
    public function init(): UpdateUserUseCase
    {
        $userPostgresDao        = new UserPostgresDAO(Postgres::connect());
        $userPostgresRepository = new UserPostgresRepository($userPostgresDao);
        $passwordHasher         = new PasswordHasherImplementation();
        $updateUserUseCase      = new UpdateUserUseCase($userPostgresRepository, $passwordHasher);

        return $updateUserUseCase;
    }
}
