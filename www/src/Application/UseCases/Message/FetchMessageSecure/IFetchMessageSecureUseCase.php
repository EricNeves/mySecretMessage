<?php

namespace App\Application\UseCases\Message\FetchMessageSecure;

use App\Application\Dtos\Message\FetchMessageSecureDto;
use App\Domain\Entities\Message;

interface IFetchMessageSecureUseCase
{
    public function execute(FetchMessageSecureDto $fetchMessageSecureDto): Message;
}
