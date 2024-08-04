<?php

namespace App\Adapters\In\Web\Controllers\Message;

use App\Adapters\Out\Factories\Message\FetchMessageWithoutPasswordFactory;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class FetchMessageController
{

    public function __construct(private FetchMessageWithoutPasswordFactory $fetchMessageWithoutPassword)
    {
    }

    public function handle(Request $request, Response $response)
    {
        $user = $request->user();

        return $response->json([
            "data" => $this->fetchMessageWithoutPassword->init()->execute($user->id),
        ]);
    }
}
