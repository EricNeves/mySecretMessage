<?php

namespace App\Application\UseCases\Message\DeleteMessage;

use App\Application\Dtos\Message\DeleteMessageDto;
use App\Application\Services\MessageService;
use App\Domain\Ports\Out\MessageRepositoryPort;

class DeleteMessageUseCase implements IDeleteMessageUseCase
{
    public function __construct(private MessageRepositoryPort $messageRepository, private MessageService $message)
    {
    }

    public function execute(DeleteMessageDto $deleteMessageDto): void
    {
        $this->message->fetchSecureMessage($deleteMessageDto->user_id, $deleteMessageDto->secret_key);

        $this->messageRepository->remove($deleteMessageDto->user_id);
    }
}
