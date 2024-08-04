<?php

namespace App\Adapters\Out\Factories\Message;

use App\Adapters\Out\Persistence\DAOs\MessageRedisDAO;
use App\Adapters\Out\Persistence\Repositories\MessageRedisRepository;
use App\Application\UseCases\Message\FetchMessageWithoutPassword\FetchMessageWithoutPasswordUseCase;
use App\Infrastructure\Database\Redis;

class FetchMessageWithoutPasswordFactory
{
    public function init(): FetchMessageWithoutPasswordUseCase
    {
        $messageRedisDAO                    = new MessageRedisDAO(Redis::connect());
        $messageRedisRepository             = new MessageRedisRepository($messageRedisDAO);
        $fetchMessageWithoutPasswordUseCase = new FetchMessageWithoutPasswordUseCase($messageRedisRepository);

        return $fetchMessageWithoutPasswordUseCase;
    }
}
