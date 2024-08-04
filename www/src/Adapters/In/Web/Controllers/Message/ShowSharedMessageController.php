<?php

namespace App\Adapters\In\Web\Controllers\Message;

use App\Adapters\Out\Factories\Message\ShowSharedMessageFactory;
use App\Application\Dtos\Message\ShowSharedMessageDto;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class ShowSharedMessageController
{
    public function __construct(private ShowSharedMessageFactory $showSharedMessage)
    {
    }

    public function handle(Request $request, Response $response, array $params)
    {
        $fields = $request->validate(['secret_key' => 'required|string']);

        $user_id    = $params[0];
        $message_id = $params[1];
        $secret_key = $fields['secret_key'];

        $showSharedMessageDto = new ShowSharedMessageDto($user_id, $message_id, $secret_key);

        $message = $this->showSharedMessage->init()->execute($showSharedMessageDto);

        return $response->json([
            "data" => $message,
        ]);
    }
}
