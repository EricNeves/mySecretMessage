<?php

namespace App\Adapters\Out\Factories\Message;

use App\Adapters\Out\Persistence\DAOs\MessageRedisDAO;
use App\Adapters\Out\Persistence\Repositories\MessageRedisRepository;
use App\Adapters\Out\Services\PasswordHasherImplementation;
use App\Adapters\Out\Services\UuidImplementation;
use App\Application\Services\Uuid;
use App\Application\UseCases\Message\RegisterMessage\RegisterMessageUseCase;
use App\Infrastructure\Database\Redis;

class RegisterMessageFactory
{
    public function init(): RegisterMessageUseCase
    {
        $messageRedisDAO           = new MessageRedisDAO(Redis::connect());
        $messageRedisRepository    = new MessageRedisRepository($messageRedisDAO);
        $uuidServiceImplementation = new UuidImplementation();
        $uuid                      = new Uuid($uuidServiceImplementation);
        $passwordHasher            = new PasswordHasherImplementation();
        $registerMessageUseCase    = new RegisterMessageUseCase($messageRedisRepository, $passwordHasher, $uuid);

        return $registerMessageUseCase;
    }
}
