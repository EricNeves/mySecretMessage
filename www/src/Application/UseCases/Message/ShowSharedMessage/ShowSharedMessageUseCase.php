<?php

namespace App\Application\UseCases\Message\ShowSharedMessage;

use App\Application\Dtos\Message\ShowSharedMessageDto;
use App\Application\Services\MessageService;
use App\Domain\Entities\Message;
use Exception;

class ShowSharedMessageUseCase implements IShowSharedMessageUseCase
{
    public function __construct(private MessageService $message)
    {
    }

    public function execute(ShowSharedMessageDto $showSharedMessageDto): Message
    {
        $message = $this->message->fetchSecureMessage($showSharedMessageDto->user_id, $showSharedMessageDto->secret_key);

        if ($showSharedMessageDto->message_id !== $message->message_id) {
            throw new Exception('Sorry, message expired or not found');
        }

        unset($message->secret_key);

        return $message;
    }
}
