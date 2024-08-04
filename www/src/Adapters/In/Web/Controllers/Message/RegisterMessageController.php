<?php

namespace App\Adapters\In\Web\Controllers\Message;

use App\Adapters\Out\Factories\Message\RegisterMessageFactory;
use App\Application\Dtos\Message\RegisterMessageDto;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class RegisterMessageController
{
    public function __construct(private RegisterMessageFactory $registerMessage)
    {
    }

    public function handle(Request $request, Response $response)
    {
        $user = $request->user();

        $fields = $request->validate([
            "message"     => "required|string",
            "secret_key"  => "required|string",
            "ttl_seconds" => "required|numeric",
        ]);

        $registerMessageDTO = new RegisterMessageDto($fields['message'], $user->id, $fields['secret_key'], $fields['ttl_seconds']);

        return $response->json([
            'data' => $this->registerMessage->init()->execute($registerMessageDTO),
        ], 201);
    }
}
