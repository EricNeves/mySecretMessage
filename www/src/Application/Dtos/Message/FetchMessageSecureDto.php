<?php

namespace App\Application\Dtos\Message;

class FetchMessageSecureDto
{
    public function __construct(
        public string $message_id,
        public string $secret_key,
    ) {
    }
}
