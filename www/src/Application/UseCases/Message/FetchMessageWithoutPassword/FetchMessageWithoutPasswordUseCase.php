<?php

namespace App\Application\UseCases\Message\FetchMessageWithoutPassword;

use App\Domain\Ports\Out\MessageRepositoryPort;

class FetchMessageWithoutPasswordUseCase implements IFetchMessageWithoutPasswordUseCase
{
    public function __construct(private MessageRepositoryPort $messageRepository)
    {
    }

    public function execute(string $user_id): array
    {
        $message = $this->messageRepository->fetchMessageByID($user_id);

        unset($message["secret_key"]);

        return $message;
    }
}
