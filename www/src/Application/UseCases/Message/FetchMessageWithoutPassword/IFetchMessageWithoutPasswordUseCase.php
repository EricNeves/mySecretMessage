<?php

namespace App\Application\UseCases\Message\FetchMessageWithoutPassword;

interface IFetchMessageWithoutPasswordUseCase
{
    public function execute(string $user_id): array;
}
