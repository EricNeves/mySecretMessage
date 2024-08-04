<?php

namespace App\Application\Dtos\Message;

class UpdateMessageDto
{
    public function __construct(
        public string $message,
        public string $secret_key,
        public string $new_secret_key,
        public string $user_id,
        public int $ttl_seconds,
    ) {
    }
}
