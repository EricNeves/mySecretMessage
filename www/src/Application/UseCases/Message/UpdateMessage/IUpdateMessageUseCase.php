<?php

namespace App\Application\UseCases\Message\UpdateMessage;

use App\Application\Dtos\Message\UpdateMessageDto;

interface IUpdateMessageUseCase
{
    public function execute(UpdateMessageDto $updateMessageDto): array;
}
