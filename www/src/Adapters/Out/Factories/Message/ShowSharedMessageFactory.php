<?php

namespace App\Adapters\Out\Factories\Message;

use App\Adapters\Out\Persistence\DAOs\MessageRedisDAO;
use App\Adapters\Out\Persistence\Repositories\MessageRedisRepository;
use App\Adapters\Out\Services\PasswordHasherImplementation;
use App\Application\Services\MessageService;
use App\Application\UseCases\Message\ShowSharedMessage\ShowSharedMessageUseCase;
use App\Infrastructure\Database\Redis;

class ShowSharedMessageFactory
{
    public function init(): ShowSharedMessageUseCase
    {
        $messageRedisDAO              = new MessageRedisDAO(Redis::connect());
        $messageRedisRepository       = new MessageRedisRepository($messageRedisDAO);
        $passwordHasherImplementation = new PasswordHasherImplementation();
        $messageService               = new MessageService($messageRedisRepository, $passwordHasherImplementation);
        $showSharedMessageUseCase     = new ShowSharedMessageUseCase($messageService);

        return $showSharedMessageUseCase;
    }
}
