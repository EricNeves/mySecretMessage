<?php

namespace App\Application\UseCases\User\FetchUser;

interface IFetchUserUseCase
{
    public function execute(string $id): array;
}
