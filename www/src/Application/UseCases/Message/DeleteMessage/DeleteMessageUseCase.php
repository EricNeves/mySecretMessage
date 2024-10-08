<?php

namespace App\Application\UseCases\Message\DeleteMessage;

use App\Application\Dtos\Message\DeleteMessageDto;
use App\Domain\Ports\Out\MessageRepositoryPort;

class DeleteMessageUseCase implements IDeleteMessageUseCase
{
    public function __construct(private MessageRepositoryPort $messageRepository)
    {
    }

    public function execute(DeleteMessageDto $deleteMessageDto): void
    {
        $this->messageRepository->remove($deleteMessageDto->user_id);
    }
}
