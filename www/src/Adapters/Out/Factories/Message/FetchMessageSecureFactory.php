<?php

namespace App\Adapters\Out\Factories\Message;

use App\Adapters\Out\Persistence\DAOs\MessageRedisDAO;
use App\Adapters\Out\Persistence\Repositories\MessageRedisRepository;
use App\Adapters\Out\Services\PasswordHasherImplementation;
use App\Application\Services\MessageService;
use App\Application\UseCases\Message\FetchMessageSecure\FetchMessageSecureUseCase;
use App\Infrastructure\Database\Redis;

class FetchMessageSecureFactory
{
    public function init(): FetchMessageSecureUseCase
    {
        $messageRedisDAO              = new MessageRedisDAO(Redis::connect());
        $messageRedisRepository       = new MessageRedisRepository($messageRedisDAO);
        $passwordHasherImplementation = new PasswordHasherImplementation();
        $messageService               = new MessageService($messageRedisRepository, $passwordHasherImplementation);
        $fetchMessageSecureUseCase    = new FetchMessageSecureUseCase($messageService);

        return $fetchMessageSecureUseCase;
    }
}
