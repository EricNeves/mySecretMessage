<?php

namespace App\Application\Dtos\Message;

class ShowSharedMessageDto
{
    public function __construct(public string $user_id, public string $message_id, public string $secret_key)
    {
    }
}
