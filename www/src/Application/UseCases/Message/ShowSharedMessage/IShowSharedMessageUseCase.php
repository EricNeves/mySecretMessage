<?php

namespace App\Application\UseCases\Message\ShowSharedMessage;

use App\Application\Dtos\Message\ShowSharedMessageDto;
use App\Domain\Entities\Message;

interface IShowSharedMessageUseCase
{
    public function execute(ShowSharedMessageDto $showSharedMessageDto): Message;
}
