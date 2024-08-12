<?php

namespace App\Application\UseCases\Message\UpdateMessage;

use App\Application\Dtos\Message\UpdateMessageDto;
use App\Application\Services\MessageService;
use App\Domain\Entities\Message;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\MessageRepositoryPort;

class UpdateMessageUseCase implements IUpdateMessageUseCase
{
    public function __construct(private MessageRepositoryPort $messageRepository, private MessageService $message, private PasswordHasherPort $passwordHasher)
    {
    }

    public function execute(UpdateMessageDto $updateMessageDto): Message
    {
        $messageFromCache = $this->message->fetchSecureMessage($updateMessageDto->user_id, $updateMessageDto->secret_key);

        $passwordHash = $this->passwordHasher->hash($updateMessageDto->new_secret_key);

        $message = new Message(
            $messageFromCache->message_id,
            $updateMessageDto->message,
            $passwordHash,
            $updateMessageDto->user_id,
            $updateMessageDto->ttl_seconds
        );

        $this->messageRepository->update($message);

        unset($message->secret_key);

        return $message;
    }
}
