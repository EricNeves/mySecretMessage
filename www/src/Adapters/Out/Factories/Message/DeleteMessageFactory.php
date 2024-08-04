<?php

namespace App\Adapters\Out\Factories\Message;

use App\Adapters\Out\Persistence\DAOs\MessageRedisDAO;
use App\Adapters\Out\Persistence\Repositories\MessageRedisRepository;
use App\Adapters\Out\Services\PasswordHasherImplementation;
use App\Application\Services\MessageService;
use App\Application\UseCases\Message\DeleteMessage\DeleteMessageUseCase;
use App\Infrastructure\Database\Redis;

class DeleteMessageFactory
{
    public function init(): DeleteMessageUseCase
    {
        $messageRedisDAO              = new MessageRedisDAO(Redis::connect());
        $messageRedisRepository       = new MessageRedisRepository($messageRedisDAO);
        $passwordHasherImplementation = new PasswordHasherImplementation();
        $messageService               = new MessageService($messageRedisRepository, $passwordHasherImplementation);
        $deleteMessageUseCase         = new DeleteMessageUseCase($messageRedisRepository, $messageService);

        return $deleteMessageUseCase;
    }
}
