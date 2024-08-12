<?php

namespace App\Application\Services;

use App\Domain\Entities\Message;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\MessageRepositoryPort;
use Exception;

class MessageService
{
    public function __construct(private MessageRepositoryPort $messageRepository, private PasswordHasherPort $passwordHasher)
    {
    }

    public function fetchSecureMessage(string $id, string $secret_key): Message
    {
        $message = $this->messageRepository->fetchMessageByID($id);

        if (empty($message)) {
            throw new Exception('Sorry, message expired or not found');
        }

        if (!$this->passwordHasher->verify($secret_key, $message->secret_key ?? '')) {
            throw new Exception('Sorry, secret key not match');
        }

        $message->secret_key = $secret_key;

        return $message;
    }
}
