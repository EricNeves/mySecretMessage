<?php

namespace App\Application\UseCases\User\FetchUser;

use App\Domain\Entities\User;

interface IFetchUserUseCase
{
    public function execute(string $id): User;
}
