<?php

namespace App\Application\UseCases\Message\RegisterMessage;

use App\Application\Dtos\Message\RegisterMessageDto;
use App\Domain\Entities\Message;

interface IRegisterMessageUseCase
{
    public function execute(RegisterMessageDto $registerMessageDto): Message;
}
