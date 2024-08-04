<?php

namespace App\Adapters\Out\Factories\User;

use App\Adapters\Out\Persistence\DAOs\UserPostgresDAO;
use App\Adapters\Out\Persistence\Repositories\UserPostgresRepository;
use App\Application\UseCases\User\FetchUser\FetchUserUseCase;
use App\Infrastructure\Database\Postgres;

class FetchUserFactory
{
    public function init(): FetchUserUseCase
    {
        $userPostgresDao        = new UserPostgresDAO(Postgres::connect());
        $userPostgresRepository = new UserPostgresRepository($userPostgresDao);
        $fetchUserUseCase       = new FetchUserUseCase($userPostgresRepository);

        return $fetchUserUseCase;
    }
}
