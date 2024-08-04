<?php

namespace App\Application\UseCases\Message\RegisterMessage;

use App\Application\Dtos\Message\RegisterMessageDto;

interface IRegisterMessageUseCase
{
    public function execute(RegisterMessageDto $registerMessageDto): array;
}
