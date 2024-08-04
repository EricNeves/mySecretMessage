<?php

namespace App\Application\UseCases\Message\DeleteMessage;

use App\Application\Dtos\Message\DeleteMessageDto;

interface IDeleteMessageUseCase
{
    public function execute(DeleteMessageDto $deleteMessageDto): void;
}
