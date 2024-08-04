<?php

namespace App\Adapters\Out\Persistence\DAOs;

use App\Domain\Entities\Message;
use Predis\Client;

class MessageRedisDAO
{
    public function __construct(private Client $redis)
    {
    }

    public function set(Message $message): void
    {
        $data = [
            'message_id'  => $message->message_id,
            'secret_key'  => $message->secret_key,
            'message'     => $message->message,
            'user_id'     => $message->user_id,
            'ttl_seconds' => $message->ttl_seconds,
        ];

        $this->redis->set($message->user_id, json_encode($data), 'EX', $message->ttl_seconds);
    }

    public function has(string $key): bool
    {
        return $this->redis->exists($key);
    }

    public function get(string $key): array
    {
        $data = $this->redis->get($key);

        if (is_null($data)) {
            return [];
        }

        return json_decode($data, true);
    }

    public function put(Message $message): void
    {
        $data = [
            'message_id'  => $message->message_id,
            'secret_key'  => $message->secret_key,
            'message'     => $message->message,
            'user_id'     => $message->user_id,
            'ttl_seconds' => $message->ttl_seconds,
        ];

        $this->redis->set($message->user_id, json_encode($data), 'EX', $message->ttl_seconds);
    }

    public function delete(string $key): void
    {
        $this->redis->del($key);
    }
}
