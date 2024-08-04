<?php

namespace App\Adapters\In\Web\Controllers\Message;

use App\Adapters\Out\Factories\Message\UpdateMessageFactory;
use App\Application\Dtos\Message\UpdateMessageDto;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class UpdateMessageController
{
    public function __construct(private UpdateMessageFactory $updateMessage)
    {
    }

    public function handle(Request $request, Response $response)
    {
        $fields = $request->validate([
            "message"        => "required|string",
            "old_secret_key" => "required|string",
            'new_secret_key' => 'required|string',
            "ttl_seconds"    => "required|numeric",
        ]);

        $updateMessageDto = new UpdateMessageDto(
            $fields["message"],
            $fields["old_secret_key"],
            $fields["new_secret_key"],
            $request->user()->id,
            $fields["ttl_seconds"]
        );

        return $response->json([
            "data" => $this->updateMessage->init()->execute($updateMessageDto),
        ]);
    }
}
