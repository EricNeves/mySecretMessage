<?php

namespace App\Adapters\In\Web\Controllers\Message;

use App\Adapters\Out\Factories\Message\DeleteMessageFactory;
use App\Application\Dtos\Message\DeleteMessageDto;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class DeleteMessageController
{
    public function __construct(private DeleteMessageFactory $deleteMessage)
    {
    }

    public function handle(Request $request, Response $response)
    {
        $fields = $request->validate(['secret_key' => 'required|string']);

        $deleteMessageDto = new DeleteMessageDto($request->user()->id, $fields['secret_key']);

        $this->deleteMessage->init()->execute($deleteMessageDto);

        return $response->json([
            "data" => "Message deleted successfully",
        ]);
    }
}
