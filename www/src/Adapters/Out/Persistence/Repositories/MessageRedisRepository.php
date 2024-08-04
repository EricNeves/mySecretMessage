<?php

namespace App\Adapters\Out\Persistence\Repositories;

use App\Adapters\Out\Persistence\DAOs\MessageRedisDAO;
use App\Domain\Entities\Message;
use App\Domain\Ports\Out\MessageRepositoryPort;

class MessageRedisRepository implements MessageRepositoryPort
{
    public function __construct(private MessageRedisDAO $message)
    {
    }

    public function save(Message $message): void
    {
        $this->message->set($message);
    }

    public function exists(string $id): bool
    {
        return $this->message->has($id);
    }

    public function fetchMessageByID(string $id): array
    {
        return $this->message->get($id);
    }

    public function update(Message $message): void
    {
        $this->message->put($message);
    }

    public function remove(string $id): void
    {
        $this->message->delete($id);
    }
}
