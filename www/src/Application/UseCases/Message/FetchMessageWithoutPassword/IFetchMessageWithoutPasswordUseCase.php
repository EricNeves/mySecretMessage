<?php

namespace App\Application\UseCases\Message\FetchMessageWithoutPassword;

use App\Domain\Entities\Message;

interface IFetchMessageWithoutPasswordUseCase
{
    public function execute(string $user_id): array | Message;
}
