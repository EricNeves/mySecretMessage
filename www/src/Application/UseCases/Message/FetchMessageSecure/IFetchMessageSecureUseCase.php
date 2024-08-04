<?php

namespace App\Application\UseCases\Message\FetchMessageSecure;

use App\Application\Dtos\Message\FetchMessageSecureDto;

interface IFetchMessageSecureUseCase
{
    public function execute(FetchMessageSecureDto $fetchMessageSecureDto): array;
}
