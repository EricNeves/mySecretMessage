<?php

namespace App\Application\Dtos\Message;

class DeleteMessageDto
{
    public function __construct(public string $user_id)
    {
    }
}
