<?php

namespace App\Application\UseCases\Message\FetchMessageSecure;

use App\Application\Dtos\Message\FetchMessageSecureDto;
use App\Application\Services\MessageService;
use App\Domain\Entities\Message;

class FetchMessageSecureUseCase implements IFetchMessageSecureUseCase
{
    public function __construct(private MessageService $message)
    {
    }

    public function execute(FetchMessageSecureDto $fetchMessageSecureDto): Message
    {
        return $this->message->fetchSecureMessage($fetchMessageSecureDto->message_id, $fetchMessageSecureDto->secret_key);
    }
}
