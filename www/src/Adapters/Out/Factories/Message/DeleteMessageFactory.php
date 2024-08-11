<?php

namespace App\Adapters\Out\Factories\Message;

use App\Adapters\Out\Persistence\DAOs\MessageRedisDAO;
use App\Adapters\Out\Persistence\Repositories\MessageRedisRepository;
use App\Application\UseCases\Message\DeleteMessage\DeleteMessageUseCase;
use App\Infrastructure\Database\Redis;

class DeleteMessageFactory
{
    public function init(): DeleteMessageUseCase
    {
        $messageRedisDAO        = new MessageRedisDAO(Redis::connect());
        $messageRedisRepository = new MessageRedisRepository($messageRedisDAO);
        $deleteMessageUseCase   = new DeleteMessageUseCase($messageRedisRepository);

        return $deleteMessageUseCase;
    }
}
