<?php

namespace App\Domain\Entities;

class Message
{
    public function __construct(
        public string $message_id,
        public string $message,
        public string $secret_key,
        public string $user_id,
        public int $ttl_seconds,
    ) {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
