<?php

namespace App\Application\Dtos\Message;

class RegisterMessageDto
{
    public function __construct(
        public string $message,
        public string $user_id,
        public string $secret_key,
        public int $ttl_seconds,
    ) {
    }
}
