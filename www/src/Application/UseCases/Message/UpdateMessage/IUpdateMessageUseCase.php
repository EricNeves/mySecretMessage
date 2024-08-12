<?php

namespace App\Application\UseCases\Message\UpdateMessage;

use App\Application\Dtos\Message\UpdateMessageDto;
use App\Domain\Entities\Message;

interface IUpdateMessageUseCase
{
    public function execute(UpdateMessageDto $updateMessageDto): Message;
}
