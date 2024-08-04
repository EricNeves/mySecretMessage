<?php

namespace App\Application\UseCases\Message\ShowSharedMessage;

use App\Application\Dtos\Message\ShowSharedMessageDto;

interface IShowSharedMessageUseCase
{
    public function execute(ShowSharedMessageDto $showSharedMessageDto): array;
}
