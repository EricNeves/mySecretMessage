<?php

namespace App\Application\UseCases\Message\RegisterMessage;

use App\Application\Dtos\Message\RegisterMessageDto;
use App\Application\Services\Uuid;
use App\Domain\Entities\Message;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\MessageRepositoryPort;
use Exception;

class RegisterMessageUseCase implements IRegisterMessageUseCase
{
    public function __construct(
        private MessageRepositoryPort $messageRepository,
        private PasswordHasherPort $passwordHasher,
        private Uuid $uuid
    ) {
    }

    public function execute(RegisterMessageDto $registerMessageDto): array
    {
        $uuid      = $this->uuid->generateUuid();
        $secretKey = $this->passwordHasher->hash($registerMessageDto->secret_key);

        $message = new Message($uuid, $registerMessageDto->message, $secretKey, $registerMessageDto->user_id, $registerMessageDto->ttl_seconds);

        $hasMessage = $this->messageRepository->exists($message->user_id);

        if ($hasMessage) {
            throw new Exception("Sorry, user already has a message");
        }

        $this->messageRepository->save($message);

        unset($message->secret_key);

        return $message->toArray();
    }
}
